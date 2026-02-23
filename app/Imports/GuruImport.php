<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class GuruImport implements 
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
            $existingUser = User::where('email', $row['email'])->first();
            if ($existingUser) {
                $this->skippedCount++;
                $this->errorMessages[] = "Email '{$row['email']}' sudah terdaftar";
                DB::rollback();
                return null;
            }

            $existingGuru = Guru::where('email', $row['email'])->first();
            if ($existingGuru) {
                $this->skippedCount++;
                $this->errorMessages[] = "Guru dengan email '{$row['email']}' sudah ada di database";
                DB::rollback();
                return null;
            }

            $tglLahir = null;
            if (isset($row['tgl_lahir'])) {
                if (is_numeric($row['tgl_lahir'])) {
                    $tglLahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir']);
                } else {
                    $tglLahir = \Carbon\Carbon::parse($row['tgl_lahir']);
                }
            }

            $user = User::create([
                'name' => $row['nama'],
                'username' => $row['email'],
                'email' => $row['email'],
                'password' => Hash::make($tglLahir ? $tglLahir->format('Y-m-d') : '12345678'),
                'role' => 'guru',
                'is_active' => 1,
            ]);

            $guru = Guru::create([
                'id' => $user->id,
                'id_instansi' => null,
                'nama' => $row['nama'],
                'email' => $row['email'],
                'tempat_lahir' => $row['tempat_lahir'] ?? null,
                'tgl_lahir' => $tglLahir,
                'no_hp' => $row['no_hp'] ?? null,
            ]);

            DB::commit();
            $this->importedCount++;

            return $guru;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error importing guru row: ' . json_encode($row));
            Log::error('Error message: ' . $e->getMessage());
            $this->skippedCount++;
            $this->errorMessages[] = "Error pada guru '{$row['nama']}': " . $e->getMessage();
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|max:50',
            'email' => 'required|email|max:50',
            'tempat_lahir' => 'nullable|max:50',
            'tgl_lahir' => 'required',
            'no_hp' => 'nullable|max:13',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Nama guru wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
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