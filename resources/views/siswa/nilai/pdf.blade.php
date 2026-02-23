<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai PKL - {{ $siswa->nama }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            padding: 40px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #1e4179;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #1e4179;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-section h3 {
            background: linear-gradient(135deg, #2c5aa0 0%, #1e4179 100%);
            color: white;
            padding: 10px 15px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 8px 0;
            font-size: 12px;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
            color: #333;
        }

        .info-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }

        .nilai-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .nilai-table th {
            background: #1e4179;
            color: white;
            padding: 12px 10px;
            text-align: center;
            font-size: 12px;
            border: 1px solid #1e4179;
        }

        .nilai-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 11px;
        }

        .nilai-table td:nth-child(2) {
            text-align: left;
            padding-left: 20px;
        }

        .nilai-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .nilai-akhir-row {
            background-color: #e8eef7 !important;
            font-weight: bold;
        }

        .nilai-final {
            background: #f0f4f8;
            padding: 20px;
            text-align: center;
            margin: 25px 0;
            border: 2px solid #1e4179;
            border-radius: 8px;
        }

        .nilai-final h2 {
            color: #1e4179;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .nilai-display {
            font-size: 48px;
            font-weight: bold;
            color: #1e4179;
            margin: 10px 0;
        }

        .predikat-display {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 10px 40px;
            border-radius: 8px;
            font-size: 32px;
            font-weight: bold;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            color: #666;
            font-size: 10px;
        }

        .signature-section {
            margin-top: 50px;
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding: 20px;
        }

        .signature-box p {
            margin-bottom: 80px;
            font-weight: bold;
        }

        .signature-line {
            border-top: 1px solid #000;
            display: inline-block;
            width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN NILAI PRAKTIK KERJA LAPANGAN (PKL)</h1>
        <p>Tahun Ajaran 2024/2025</p>
    </div>

    <!-- Informasi Siswa -->
    <div class="info-section">
        <h3>INFORMASI SISWA</h3>
        <table class="info-table">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td>NIPD</td>
                <td>:</td>
                <td>{{ $siswa->nipd }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $siswa->kelas }}</td>
            </tr>
        </table>
    </div>

    <!-- Informasi PKL -->
    <div class="info-section">
        <h3>INFORMASI PKL</h3>
        <table class="info-table">
            <tr>
                <td>Instansi PKL</td>
                <td>:</td>
                <td>{{ $penilaian->instansi->nama_instansi ?? '-' }}</td>
            </tr>
            <tr>
                <td>Periode PKL</td>
                <td>:</td>
                <td>21.2.2024 - 21.5.2024</td>
            </tr>
            <tr>
                <td>Pembimbing</td>
                <td>:</td>
                <td>{{ $penilaian->instansi->pembimbing ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Nilai Akhir (Box Besar) -->
    <div class="nilai-final">
        <h2>NILAI AKHIR</h2>
        <div class="nilai-display">{{ number_format($penilaian->nilai_akhir, 1) }}</div>
        <div class="predikat-display">
            @if($penilaian->nilai_akhir >= 90) A
            @elseif($penilaian->nilai_akhir >= 80) B
            @elseif($penilaian->nilai_akhir >= 70) C
            @elseif($penilaian->nilai_akhir >= 60) D
            @else E
            @endif
        </div>
    </div>

    <!-- Detail Aspek Penilaian -->
    <div class="info-section">
        <h3>DETAIL ASPEK YANG DINILAI</h3>
        <table class="nilai-table">
            <thead>
                <tr>
                    <th style="width: 10%;">No.</th>
                    <th style="width: 45%;">ASPEK YANG DINILAI</th>
                    <th style="width: 22.5%;">NILAI</th>
                    <th style="width: 22.5%;">PREDIKAT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Kedisiplinan</td>
                    <td>{{ number_format($penilaian->nilai_kedisiplinan, 0) }}</td>
                    <td>
                        @if($penilaian->nilai_kedisiplinan >= 90) A
                        @elseif($penilaian->nilai_kedisiplinan >= 80) B
                        @elseif($penilaian->nilai_kedisiplinan >= 70) C
                        @elseif($penilaian->nilai_kedisiplinan >= 60) D
                        @else E
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Tanggung Jawab</td>
                    <td>{{ number_format($penilaian->nilai_tanggung_jawab, 0) }}</td>
                    <td>
                        @if($penilaian->nilai_tanggung_jawab >= 90) A
                        @elseif($penilaian->nilai_tanggung_jawab >= 80) B
                        @elseif($penilaian->nilai_tanggung_jawab >= 70) C
                        @elseif($penilaian->nilai_tanggung_jawab >= 60) D
                        @else E
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Kreatifitas</td>
                    <td>{{ number_format($penilaian->nilai_kreatifitas, 0) }}</td>
                    <td>
                        @if($penilaian->nilai_kreatifitas >= 90) A
                        @elseif($penilaian->nilai_kreatifitas >= 80) B
                        @elseif($penilaian->nilai_kreatifitas >= 70) C
                        @elseif($penilaian->nilai_kreatifitas >= 60) D
                        @else E
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Komunikasi</td>
                    <td>{{ number_format($penilaian->nilai_komunikasi, 0) }}</td>
                    <td>
                        @if($penilaian->nilai_komunikasi >= 90) A
                        @elseif($penilaian->nilai_komunikasi >= 80) B
                        @elseif($penilaian->nilai_komunikasi >= 70) C
                        @elseif($penilaian->nilai_komunikasi >= 60) D
                        @else E
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Kerjasama</td>
                    <td>{{ number_format($penilaian->nilai_kerjasama, 0) }}</td>
                    <td>
                        @if($penilaian->nilai_kerjasama >= 90) A
                        @elseif($penilaian->nilai_kerjasama >= 80) B
                        @elseif($penilaian->nilai_kerjasama >= 70) C
                        @elseif($penilaian->nilai_kerjasama >= 60) D
                        @else E
                        @endif
                    </td>
                </tr>
                <tr class="nilai-akhir-row">
                    <td colspan="2">JUMLAH</td>
                    <td>{{ number_format($penilaian->nilai_kedisiplinan + $penilaian->nilai_tanggung_jawab + $penilaian->nilai_kreatifitas + $penilaian->nilai_komunikasi + $penilaian->nilai_kerjasama, 0) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    @if($penilaian->keterangan)
    <div class="info-section">
        <h3>KETERANGAN</h3>
        <p style="padding: 15px; background: #f9f9f9; border-left: 4px solid #1e4179;">
            {{ $penilaian->keterangan }}
        </p>
    </div>
    @endif

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-box">
            <p>Mengetahui,<br>Pembimbing Sekolah</p>
            <div class="signature-line"></div>
            <p style="margin-top: 10px; margin-bottom: 0;">(............................)</p>
        </div>
        <div class="signature-box">
            <p>Bandung, {{ date('d F Y') }}<br>Pembimbing Instansi</p>
            <div class="signature-line"></div>
            <p style="margin-top: 10px; margin-bottom: 0;">{{ $penilaian->instansi->pembimbing ?? '(............................)' }}</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh Sistem Informasi PKL</p>
        <p>Copyright © COHESION TEAM 2026</p>
    </div>
</body>
</html>