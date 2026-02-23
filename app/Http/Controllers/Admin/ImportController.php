<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Imports\InstansiImport;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Log;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.import.index');
    }

    public function importSiswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ], [
            'file.required' => 'File Excel wajib dipilih',
            'file.mimes' => 'File harus berformat .xlsx, .xls, atau .csv',
            'file.max' => 'Ukuran file maksimal 5MB',
        ]);

        try {
            $file = $request->file('file');
            $import = new SiswaImport();
            
            Excel::import($import, $file);

            $imported = $import->getImportedCount();
            $skipped = $import->getSkippedCount();
            $errors = $import->getErrors();
            
            if ($imported > 0 && $skipped == 0) {
                return redirect()->back()->with('success', "Berhasil import {$imported} data siswa.");
            } elseif ($imported > 0 && $skipped > 0) {
                $errorMessage = "Berhasil import {$imported} data siswa. {$skipped} data dilewati.";
                if (!empty($errors)) {
                    $errorMessage .= " Detail error: " . implode(' | ', array_slice($errors, 0, 3));
                    if (count($errors) > 3) {
                        $errorMessage .= " ... dan " . (count($errors) - 3) . " error lainnya.";
                    }
                }
                return redirect()->back()->with('warning', $errorMessage);
            } else {
                $errorMessage = "Tidak ada data yang berhasil diimport. {$skipped} data dilewati.";
                if (!empty($errors)) {
                    $errorMessage .= " Detail error: " . implode(' | ', array_slice($errors, 0, 5));
                }
                return redirect()->back()->with('error', $errorMessage);
            }

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            
            foreach ($failures as $failure) {
                $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
                if (count($errorMessages) >= 5) {
                    $errorMessages[] = "... dan error lainnya";
                    break;
                }
            }
            
            return redirect()->back()
                ->with('error', 'Validasi gagal! ' . implode(' | ', $errorMessages));
            
        } catch (\Exception $e) {
            Log::error('Import Siswa Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    public function importInstansi(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ], [
            'file.required' => 'File Excel wajib dipilih',
            'file.mimes' => 'File harus berformat .xlsx, .xls, atau .csv',
            'file.max' => 'Ukuran file maksimal 5MB',
        ]);

        try {
            $file = $request->file('file');
            $import = new InstansiImport();
            
            Excel::import($import, $file);

            $imported = $import->getImportedCount();
            $skipped = $import->getSkippedCount();
            $errors = $import->getErrors();
            
            if ($imported > 0 && $skipped == 0) {
                return redirect()->back()->with('success', "Berhasil import {$imported} data instansi. User mentor telah dibuat otomatis.");
            } elseif ($imported > 0 && $skipped > 0) {
                $errorMessage = "Berhasil import {$imported} data instansi. {$skipped} data dilewati.";
                if (!empty($errors)) {
                    $errorMessage .= " Detail error: " . implode(' | ', array_slice($errors, 0, 3));
                    if (count($errors) > 3) {
                        $errorMessage .= " ... dan " . (count($errors) - 3) . " error lainnya.";
                    }
                }
                return redirect()->back()->with('warning', $errorMessage);
            } else {
                $errorMessage = "Tidak ada data yang berhasil diimport. {$skipped} data dilewati.";
                if (!empty($errors)) {
                    $errorMessage .= " Detail error: " . implode(' | ', array_slice($errors, 0, 5));
                }
                return redirect()->back()->with('error', $errorMessage);
            }

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            
            foreach ($failures as $failure) {
                $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
                if (count($errorMessages) >= 5) {
                    $errorMessages[] = "... dan error lainnya";
                    break;
                }
            }
            
            return redirect()->back()->with('error', 'Validasi gagal: ' . implode(' | ', $errorMessages));
            
        } catch (\Exception $e) {
            Log::error('Import Instansi Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function importGuru(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ], [
            'file.required' => 'File Excel wajib dipilih',
            'file.mimes' => 'File harus berformat .xlsx, .xls, atau .csv',
            'file.max' => 'Ukuran file maksimal 5MB',
        ]);

        try {
            $file = $request->file('file');
            $import = new GuruImport();
            
            Excel::import($import, $file);

            $imported = $import->getImportedCount();
            $skipped = $import->getSkippedCount();
            $errors = $import->getErrors();
            
            if ($imported > 0 && $skipped == 0) {
                return redirect()->back()->with('success', "Berhasil import {$imported} data guru.");
            } elseif ($imported > 0 && $skipped > 0) {
                $errorMessage = "Berhasil import {$imported} data guru. {$skipped} data dilewati.";
                if (!empty($errors)) {
                    $errorMessage .= " Detail error: " . implode(' | ', array_slice($errors, 0, 3));
                    if (count($errors) > 3) {
                        $errorMessage .= " ... dan " . (count($errors) - 3) . " error lainnya.";
                    }
                }
                return redirect()->back()->with('warning', $errorMessage);
            } else {
                $errorMessage = "Tidak ada data yang berhasil diimport. {$skipped} data dilewati.";
                if (!empty($errors)) {
                    $errorMessage .= " Detail error: " . implode(' | ', array_slice($errors, 0, 5));
                }
                return redirect()->back()->with('error', $errorMessage);
            }

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            
            foreach ($failures as $failure) {
                $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
                if (count($errorMessages) >= 5) {
                    $errorMessages[] = "... dan error lainnya";
                    break;
                }
            }
            
            return redirect()->back()->with('error', 'Validasi gagal: ' . implode(' | ', $errorMessages));
            
        } catch (\Exception $e) {
            Log::error('Import Guru Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function downloadTemplateSiswa()
    {
        $filePath = public_path('templates/template_siswa.xlsx');
        
        if (file_exists($filePath)) {
            return response()->download($filePath, 'Template_Import_Siswa.xlsx');
        }
        
        return redirect()->back()->with('error', 'Template tidak ditemukan.');
    }

    public function downloadTemplateInstansi()
    {
        $filePath = public_path('templates/template_instansi.xlsx');
        
        if (file_exists($filePath)) {
            return response()->download($filePath, 'Template_Import_Instansi.xlsx');
        }
        
        return redirect()->back()->with('error', 'Template tidak ditemukan.');
    }

    public function downloadTemplateGuru()
    {
        $filePath = public_path('templates/template_guru.xlsx');
        
        if (file_exists($filePath)) {
            return response()->download($filePath, 'Template_Import_Guru.xlsx');
        }
        
        return redirect()->back()->with('error', 'Template tidak ditemukan.');
    }
}