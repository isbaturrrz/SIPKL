!DOCTYPE html>
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
        
        .section-title {
            font-weight: bold;
            font-size: 11pt;
            text-transform: uppercase;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #000;
        }
        
        .summary-section {
            margin-bottom: 15px;
        }
        
        .summary-section table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .summary-section td,
        .summary-section th {
            padding: 4px 8px;
            border: 1px solid #000;
            text-align: center;
        }
        
        .summary-section th {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        
        .monthly-section {
            margin-bottom: 15px;
        }
        
        .monthly-section table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }
        
        .monthly-section th {
            padding: 4px 6px;
            border: 1px solid #000;
            font-weight: bold;
            background-color: #f0f0f0;
            text-align: center;
        }
        
        .monthly-section td {
            padding: 4px 6px;
            border: 1px solid #000;
            text-align: center;
        }
        
        .statistics {
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
        
        .stat-label {
            font-weight: bold;
            width: 50%;
            background-color: #f0f0f0;
        }
        
        .stat-value {
            text-align: center;
            width: 50%;
        }
        
        .footer {
            margin-top: 15px;
            font-size: 9pt;
        }
        
        .signature-section {
            margin-top: 10px;
            text-align: right;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 200px;
        }
        
        .signature-line {
            margin-top: 40px;
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
        
        // Hitung total tahunan
        $total_wfo = collect($data)->sum(fn($d) => safeGet($d['performa'], 'wfo'));
        $total_wfh = collect($data)->sum(fn($d) => safeGet($d['performa'], 'wfh'));
        $total_izin = collect($data)->sum(fn($d) => safeGet($d['performa'], 'izin'));
        $total_sakit = collect($data)->sum(fn($d) => safeGet($d['performa'], 'sakit'));
        $total_libur = collect($data)->sum(fn($d) => safeGet($d['performa'], 'libur'));
        $total_alfa = collect($data)->sum(fn($d) => safeGet($d['performa'], 'alfa'));
        
        // Hitung statistik kehadiran tahunan
        $total_hadir = $total_wfo + $total_wfh;
        $total_tidak_hadir = $total_izin + $total_sakit + $total_alfa;
        $total_hari = $total_hadir + $total_tidak_hadir;
        $persentase = $total_hari > 0 ? round(($total_hadir / $total_hari) * 100, 2) : 0;
    @endphp

    <div class="header">
        <h2>Laporan Kehadiran Siswa</h2>
        <p>Periode: Tahun {{ $data[0]['tahun'] ?? date('Y') }}</p>
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

    <div class="monthly-section">
        <div class="section-title">Rekapitulasi Per Bulan</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Bulan</th>
                    <th style="width: 10%;">WFO</th>
                    <th style="width: 10%;">WFH</th>
                    <th style="width: 10%;">Izin</th>
                    <th style="width: 10%;">Sakit</th>
                    <th style="width: 10%;">Libur</th>
                    <th style="width: 10%;">Alfa</th>
                    <th style="width: 10%;">Hadir</th>
                    <th style="width: 10%;">Tidak Hadir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $monthData)
                @php
                    $m_wfo = safeGet($monthData['performa'], 'wfo');
                    $m_wfh = safeGet($monthData['performa'], 'wfh');
                    $m_izin = safeGet($monthData['performa'], 'izin');
                    $m_sakit = safeGet($monthData['performa'], 'sakit');
                    $m_libur = safeGet($monthData['performa'], 'libur');
                    $m_alfa = safeGet($monthData['performa'], 'alfa');
                    $m_hadir = $m_wfo + $m_wfh;
                    $m_tidak_hadir = $m_izin + $m_sakit + $m_alfa;
                @endphp
                <tr>
                    <td style="text-align: left; padding-left: 10px;">{{ $monthData['bulan'] }}</td>
                    <td>{{ $m_wfo }}</td>
                    <td>{{ $m_wfh }}</td>
                    <td>{{ $m_izin }}</td>
                    <td>{{ $m_sakit }}</td>
                    <td>{{ $m_libur }}</td>
                    <td>{{ $m_alfa }}</td>
                    <td><strong>{{ $m_hadir }}</strong></td>
                    <td><strong>{{ $m_tidak_hadir }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="statistics">
        <div class="section-title">Statistik Kehadiran Tahunan</div>
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
        
        <div style="margin-top: 10px;">
            <p class="print-info">Dokumen ini dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
        </div>
    </div>
</body>
</html>