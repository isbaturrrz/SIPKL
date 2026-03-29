<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 15mm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }
        
        .header h2 {
            margin: 0 0 5px 0;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header p {
            margin: 0;
            font-size: 10pt;
            font-style: italic;
        }
        
        .info-table {
            width: 100%;
            margin-bottom: 15px;
            font-size: 10pt;
        }
        
        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        
        .info-table .label {
            width: 150px;
            font-weight: bold;
        }
        
        .info-table .separator {
            width: 15px;
            text-align: center;
        }
        
        .summary-section {
            margin-bottom: 15px;
        }
        
        .summary-section table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .summary-section td {
            padding: 4px 8px;
            border: 1px solid #000;
        }
        
        .section-title {
            font-weight: bold;
            font-size: 11pt;
            text-transform: uppercase;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #000;
        }
        
        .statistics {
            font-size: 10pt;
            margin-bottom: 15px;
        }
        
        .statistics table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .statistics td {
            padding: 4px 8px;
            border: 1px solid #000;
        }
        
        .statistics .stat-label {
            font-weight: bold;
            width: 50%;
            background-color: #f0f0f0;
        }
        
        .statistics .stat-value {
            text-align: center;
            width: 50%;
        }
        
        .footer {
            margin-top: 20px;
            font-size: 9pt;
        }
        
        .signature-section {
            margin-top: 15px;
            text-align: right;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 200px;
        }
        
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            padding-top: 3px;
        }
        
        .print-info {
            font-size: 8pt;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    @php
        // Helper function untuk format data
        function safeGet($array, $key, $default = 0) {
            return isset($array[$key]) ? $array[$key] : $default;
        }
        
        // Ambil data performa dengan safety check
        $wfo = safeGet($performa, 'wfo');
        $wfh = safeGet($performa, 'wfh');
        $izin = safeGet($performa, 'izin');
        $sakit = safeGet($performa, 'sakit');
        $libur = safeGet($performa, 'libur');
        $alfa = safeGet($performa, 'alfa');
        
        // Hitung statistik kehadiran
        $total_hadir = $wfo + $wfh;
        $total_tidak_hadir = $izin + $sakit + $alfa;
        $total_hari = $total_hadir + $total_tidak_hadir;
        $persentase = $total_hari > 0 ? round(($total_hadir / $total_hari) * 100, 2) : 0;
    @endphp

    <div class="header">
        <h2>Laporan Kehadiran Siswa</h2>
        <p>Periode: {{ $bulan }} {{ $tahun }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama Siswa</td>
            <td class="separator">:</td>
            <td>{{ $siswa->nama }}</td>
        </tr>
        <tr>
            <td class="label">NIPD</td>
            <td class="separator">:</td>
            <td>{{ $siswa->nipd ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Kelas</td>
            <td class="separator">:</td>
            <td>{{ $siswa->kelas_lengkap }}</td>
        </tr>
        <tr>
            <td class="label">Guru Pembimbing</td>
            <td class="separator">:</td>
            <td>{{ $guru->nama }}</td>
        </tr>
    </table>

    <div class="summary-section">
        <div class="section-title">Ringkasan Kehadiran</div>
        <table>
            <tr>
                <td class="stat-label">Hadir WFO</td>
                <td class="stat-value">{{ $wfo }} Hari</td>
            </tr>
            <tr>
                <td class="stat-label">Hadir WFH</td>
                <td class="stat-value">{{ $wfh }} Hari</td>
            </tr>
            <tr>
                <td class="stat-label">Izin</td>
                <td class="stat-value">{{ $izin }} Hari</td>
            </tr>
            <tr>
                <td class="stat-label">Sakit</td>
                <td class="stat-value">{{ $sakit }} Hari</td>
            </tr>
            <tr>
                <td class="stat-label">Libur</td>
                <td class="stat-value">{{ $libur }} Hari</td>
            </tr>
            <tr>
                <td class="stat-label">Alfa</td>
                <td class="stat-value">{{ $alfa }} Hari</td>
            </tr>
        </table>
    </div>

    <div class="statistics">
        <div class="section-title">Statistik Kehadiran</div>
        <table>
            <tr>
                <td class="stat-label">Total Hadir</td>
                <td class="stat-value">{{ $total_hadir }} Hari</td>
            </tr>
            <tr>
                <td class="stat-label">Total Tidak Hadir</td>
                <td class="stat-value">{{ $total_tidak_hadir }} Hari</td>
            </tr>
            <tr>
                <td class="stat-label">Persentase Kehadiran</td>
                <td class="stat-value">{{ $persentase }}%</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <div class="signature-section">
            <div class="signature-box">
                <div>Mengetahui,</div>
                <div style="margin-top: 5px; font-weight: bold;">Guru Pembimbing</div>
                <div class="signature-line">{{ $guru->nama }}</div>
            </div>
        </div>
        
        <div style="margin-top: 15px;">
            <p class="print-info">Dokumen ini dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
        </div>
    </div>
</body>
</html>