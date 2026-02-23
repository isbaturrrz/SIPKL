<?php

echo "===================================\n";
echo "MEMBUAT TEMPLATE EXCEL\n";
echo "===================================\n\n";

if (!file_exists('public/templates')) {
    mkdir('public/templates', 0777, true);
    echo "[✓] Folder templates berhasil dibuat!\n\n";
} else {
    echo "[✓] Folder templates sudah ada!\n\n";
}

if (!file_exists('vendor/autoload.php')) {
    echo "[✗] ERROR: Composer belum diinstall!\n";
    echo "    Jalankan: composer install\n";
    exit;
}

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

echo "Membuat template...\n\n";

echo "1. Membuat template_siswa.xlsx... ";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Siswa');

$headers = ['nipd', 'nama', 'tempat_lahir', 'tgl_lahir', 'no_hp', 'alamat', 'kelas', 'rombel', 'jurusan', 'tanggal_mulai', 'tanggal_selesai'];

$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $sheet->getStyle($col . '1')->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4472C4']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    ]);
    $sheet->getColumnDimension($col)->setWidth(15);
    $col++;
}

$sheet->setCellValue('A2', '23240532');
$sheet->setCellValue('B2', 'Rio Azkya Isbat');
$sheet->setCellValue('C2', 'Bandung');
$sheet->setCellValue('D2', '2005-01-15');
$sheet->setCellValue('E2', '081234567890');
$sheet->setCellValue('F2', 'Jl. Contoh No.1, Bandung');
$sheet->setCellValue('G2', 'XII');
$sheet->setCellValue('H2', '4');
$sheet->setCellValue('I2', 'PPLG');
$sheet->setCellValue('J2', '2024-02-21');
$sheet->setCellValue('K2', '2024-05-21');

$sheet->setCellValue('A4', 'KETERANGAN:');
$sheet->getStyle('A4')->getFont()->setBold(true);
$sheet->setCellValue('A5', '- nipd: Username (wajib, unique, max 9)');
$sheet->setCellValue('A6', '- tgl_lahir: Password format YYYY-MM-DD (wajib)');
$sheet->setCellValue('A7', '- kelas: X, XI, XII (wajib)');
$sheet->setCellValue('A8', '- jurusan: PPLG, BRP, DKV (wajib)');
$sheet->setCellValue('A9', '- Hapus baris 2 sebelum import!');
$sheet->setCellValue('A10', '- Disarankan menggunakan spreadsheet dibanding excel');

$writer = new Xlsx($spreadsheet);
$writer->save('public/templates/template_siswa.xlsx');
echo "[✓] Berhasil!\n";

echo "2. Membuat template_instansi.xlsx... ";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Instansi');

$headers = ['nama_instansi', 'alamat', 'latitude', 'longitude', 'no_hp', 'pemilik', 'kuota_siswa'];

$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $sheet->getStyle($col . '1')->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '70AD47']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    ]);
    $sheet->getColumnDimension($col)->setWidth(15);
    $col++;
}

$sheet->setCellValue('A2', 'PT. COHESION');
$sheet->setCellValue('B2', 'Jl. Instansi No.1, Bandung');
$sheet->setCellValue('C2', '-6.914744');
$sheet->setCellValue('D2', '107.609810');
$sheet->setCellValue('E2', '0227654321');
$sheet->setCellValue('F2', 'Bpk. M.Tafirhan');
$sheet->setCellValue('G2', '10');

$sheet->setCellValue('A4', 'KETERANGAN:');
$sheet->getStyle('A4')->getFont()->setBold(true);
$sheet->setCellValue('A5', '- nama_instansi: Wajib, max 50 karakter');
$sheet->setCellValue('A6', '- Auto create Mentor (password: @mentor123)');
$sheet->setCellValue('A7', '- Hapus baris 2 sebelum import!');
$sheet->setCellValue('A8', '- Disarankan menggunakan spreadsheet dibanding excel');

$writer = new Xlsx($spreadsheet);
$writer->save('public/templates/template_instansi.xlsx');
echo "[✓] Berhasil!\n";

echo "3. Membuat template_guru.xlsx... ";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Guru');

$headers = ['nama', 'email', 'tempat_lahir', 'tgl_lahir', 'no_hp'];

$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $sheet->getStyle($col . '1')->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFC000']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    ]);
    $sheet->getColumnDimension($col)->setWidth(20);
    $col++;
}

$sheet->setCellValue('A2', 'Budi Santoso');
$sheet->setCellValue('B2', 'budi.santoso@gmail.com');
$sheet->setCellValue('C2', 'Jakarta');
$sheet->setCellValue('D2', '1985-05-20');
$sheet->setCellValue('E2', '081298765432');

$sheet->setCellValue('A4', 'KETERANGAN:');
$sheet->getStyle('A4')->getFont()->setBold(true);
$sheet->setCellValue('A5', '- email: Username (wajib, unique)');
$sheet->setCellValue('A6', '- tgl_lahir: Password format YYYY-MM-DD (wajib)');
$sheet->setCellValue('A7', '- Hapus baris 2 sebelum import!');
$sheet->setCellValue('A8', '- Disarankan menggunakan spreadsheet dibanding excel');

$writer = new Xlsx($spreadsheet);
$writer->save('public/templates/template_guru.xlsx');
echo "[✓] Berhasil!\n";

echo "\n===================================\n";
echo "SELESAI!\n";
echo "===================================\n";
echo "Template tersimpan di: public/templates/\n";
echo "- template_siswa.xlsx\n";
echo "- template_instansi.xlsx\n";
echo "- template_guru.xlsx\n";