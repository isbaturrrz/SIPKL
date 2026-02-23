<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Instansi;
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

class SiswaImport implements 
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
            $existingSiswa = Siswa::where('nipd', $row['nipd'])->first();
            if ($existingSiswa) {
                $this->skippedCount++;
                $this->errorMessages[] = "NIPD {$row['nipd']} sudah ada di database";
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
                'username' => $row['nipd'],
                'password' => Hash::make($tglLahir ? $tglLahir->format('Y-m-d') : '12345678'),
                'role' => 'siswa',
                'is_active' => 1,
            ]);

            $tanggalMulai = null;
            $tanggalSelesai = null;

            if (isset($row['tanggal_mulai']) && !empty($row['tanggal_mulai'])) {
                if (is_numeric($row['tanggal_mulai'])) {
                    $tanggalMulai = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_mulai']);
                } else {
                    $tanggalMulai = \Carbon\Carbon::parse($row['tanggal_mulai']);
                }
            }

            if (isset($row['tanggal_selesai']) && !empty($row['tanggal_selesai'])) {
                if (is_numeric($row['tanggal_selesai'])) {
                    $tanggalSelesai = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_selesai']);
                } else {
                    $tanggalSelesai = \Carbon\Carbon::parse($row['tanggal_selesai']);
                }
            }

            $siswa = Siswa::create([
                'id' => $user->id,
                'nipd' => $row['nipd'],
                'nama' => $row['nama'],
                'tempat_lahir' => $row['tempat_lahir'] ?? null,
                'tgl_lahir' => $tglLahir,
                'no_hp' => $row['no_hp'] ?? null,
                'alamat' => $row['alamat'] ?? null,
                'kelas' => strtoupper($row['kelas']),
                'rombel' => $row['rombel'] ?? null,
                'jurusan' => strtoupper($row['jurusan']),
                'id_guru' => null,
                'id_instansi' => null,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'status_penempatan' => 'belum',
            ]);

            DB::commit();
            $this->importedCount++;

            return $siswa;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error importing siswa row: ' . json_encode($row));
            Log::error('Error message: ' . $e->getMessage());
            $this->skippedCount++;
            $this->errorMessages[] = "Error pada baris {$row['nama']}: " . $e->getMessage();
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nipd' => 'required|max:9',
            'nama' => 'required|max:50',
            'tempat_lahir' => 'nullable|max:50',
            'tgl_lahir' => 'required',
            'no_hp' => 'nullable|max:13',
            'alamat' => 'nullable|max:100',
            'kelas' => 'required|in:X,XI,XII,x,xi,xii',
            'rombel' => 'nullable|numeric',
            'jurusan' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nipd.required' => 'NIPD wajib diisi',
            'nipd.max' => 'NIPD maksimal 9 karakter',
            'nama.required' => 'Nama wajib diisi',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'kelas.in' => 'Kelas harus X, XI, atau XII',
            'jurusan.required' => 'Jurusan wajib diisi',
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