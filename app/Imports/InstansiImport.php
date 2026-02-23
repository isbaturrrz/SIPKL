<?php

namespace App\Imports;

use App\Models\Instansi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class InstansiImport implements 
    ToModel, 
    WithHeadingRow, 
    WithValidation, 
    SkipsOnError, 
    SkipsOnFailure,
    WithBatchInserts,
    WithChunkReading
{
    use SkipsErrors, SkipsFailures;

    private $importedCount = 0;
    private $skippedCount = 0;
    private $errorMessages = [];

    public function model(array $row)
    {
        DB::beginTransaction();
        
        try {
            $existingInstansi = Instansi::where('nama_instansi', $row['nama_instansi'])->first();
            if ($existingInstansi) {
                $this->skippedCount++;
                $this->errorMessages[] = "Instansi '{$row['nama_instansi']}' sudah ada di database";
                DB::rollback();
                return null;
            }

            $baseUsername = Str::slug($row['nama_instansi'], '');
            $baseUsername = strtolower(substr($baseUsername, 0, 20));
            
            $username = $baseUsername;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            $instansi = Instansi::create([
                'nama_instansi' => $row['nama_instansi'],
                'alamat' => $row['alamat'] ?? null,
                'latitude' => $row['latitude'] ?? null,
                'longitude' => $row['longitude'] ?? null,
                'no_hp' => $row['no_hp'] ?? null,
                'pemilik' => $row['pemilik'] ?? null,
                'kuota_siswa' => $row['kuota_siswa'] ?? 0,
                'kuota_terpakai' => 0,
                'jurusan_diterima' => 'PPLG-BRP-DKV',
                'is_from_submission' => 0,
            ]);

            $mentor = User::create([
                'name' => 'Mentor ' . $row['nama_instansi'],
                'username' => $username,
                'email' => $username . '@sipkl.com',
                'password' => Hash::make('@mentor123'),
                'role' => 'mentor',
                'id_instansi' => $instansi->id_instansi,
                'is_active' => 1,
            ]);

            DB::commit();
            $this->importedCount++;

            return $instansi;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error importing instansi row: ' . json_encode($row));
            Log::error('Error message: ' . $e->getMessage());
            $this->skippedCount++;
            $this->errorMessages[] = "Error pada instansi '{$row['nama_instansi']}': " . $e->getMessage();
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nama_instansi' => 'required|max:255',
            'alamat' => 'nullable|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'no_hp' => 'nullable|max:13',
            'pemilik' => 'nullable|max:50',
            'kuota_siswa' => 'nullable|integer|min:0',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_instansi.required' => 'Nama instansi wajib diisi',
            'nama_instansi.max' => 'Nama instansi maksimal 255 karakter',
            'kuota_siswa.integer' => 'Kuota siswa harus berupa angka',
            'kuota_siswa.min' => 'Kuota siswa minimal 0',
        ];
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 50;
    }

    public function getImportedCount()
    {
        return $this->importedCount;
    }

    public function getSkippedCount()
    {
        return $this->skippedCount;
    }

    public function getErrors()
    {
        return $this->errorMessages;
    }
}