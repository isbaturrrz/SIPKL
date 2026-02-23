<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4e73df;
            padding-bottom: 15px;
        }
        .header h2 {
            margin: 5px 0;
            color: #4e73df;
        }
        .header p {
            margin: 3px 0;
            font-size: 12px;
        }
        .info-section {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .info-row {
            display: flex;
            margin-bottom: 8px;
        }
        .info-label {
            width: 150px;
            font-weight: bold;
            color: #4e73df;
        }
        .info-value {
            flex: 1;
        }
        .month-section {
            page-break-inside: avoid;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        .month-title {
            background-color: #4e73df;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }
        .performa-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }
        .performa-item {
            border: 2px solid #ddd;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            background-color: #f8f9fa;
            font-size: 12px;
        }
        .performa-item.wfo {
            border-color: #1cc88a;
            background-color: #d4edda;
        }
        .performa-item.wfh {
            border-color: #36b9cc;
            background-color: #cce5ff;
        }
        .performa-item.izin {
            border-color: #f6c23e;
            background-color: #fff3cd;
        }
        .performa-item.sakit {
            border-color: #36b9cc;
            background-color: #d1ecf1;
        }
        .performa-item.libur {
            border-color: #858796;
            background-color: #e2e3e5;
        }
        .performa-item.alfa {
            border-color: #e74a3b;
            background-color: #f8d7da;
        }
        .performa-item-label {
            font-weight: bold;
            font-size: 10px;
            color: #333;
            margin-bottom: 3px;
        }
        .performa-item-value {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        .table th {
            background-color: #4e73df;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        .table td {
            padding: 6px 8px;
            border-bottom: 1px solid #ddd;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            color: white;
        }
        .status-wfo {
            background-color: #1cc88a;
        }
        .status-wfh {
            background-color: #36b9cc;
        }
        .status-izin {
            background-color: #f6c23e;
            color: #333;
        }
        .status-sakit {
            background-color: #36b9cc;
        }
        .status-libur {
            background-color: #858796;
        }
        .status-alfa {
            background-color: #e74a3b;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }
        .summary-table th {
            background-color: #4e73df;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
        }
        .summary-table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .summary-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Performa Kehadiran Siswa</h2>
        <p>Periode: Semua Bulan {{ $data[0]['tahun'] ?? date('Y') }}</p>
    </div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-label">Nama Siswa</div>
            <div class="info-value">: {{ $siswa->nama }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">NIPD</div>
            <div class="info-value">: {{ $siswa->nipd ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Kelas</div>
            <div class="info-value">: {{ $siswa->kelas }} {{ $siswa->jurusan }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Guru Pembimbing</div>
            <div class="info-value">: {{ $guru->nama }}</div>
        </div>
    </div>

    <!-- Ringkasan Tahunan -->
    <div class="info-section">
        <h3 style="color: #4e73df; margin-top: 0;">Ringkasan Kehadiran Tahunan</h3>
        <table class="summary-table">
            <thead>
                <tr>
                    <th>WFO</th>
                    <th>WFH</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Libur</th>
                    <th>Alfa</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>{{ collect($data)->sum(fn($d) => $d['performa']['wfo']) }}</strong></td>
                    <td><strong>{{ collect($data)->sum(fn($d) => $d['performa']['wfh']) }}</strong></td>
                    <td><strong>{{ collect($data)->sum(fn($d) => $d['performa']['izin']) }}</strong></td>
                    <td><strong>{{ collect($data)->sum(fn($d) => $d['performa']['sakit']) }}</strong></td>
                    <td><strong>{{ collect($data)->sum(fn($d) => $d['performa']['libur']) }}</strong></td>
                    <td><strong>{{ collect($data)->sum(fn($d) => $d['performa']['alfa']) }}</strong></td>
                    <td><strong>{{ collect($data)->sum(fn($d) => $d['performa']['total']) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Detail per Bulan -->
    @foreach($data as $monthData)
    <div class="month-section">
        <div class="month-title">{{ $monthData['bulan'] }} {{ $monthData['tahun'] }}</div>
        
        <div class="performa-grid">
            <div class="performa-item wfo">
                <div class="performa-item-label">WFO</div>
                <div class="performa-item-value">{{ $monthData['performa']['wfo'] }}</div>
            </div>
            <div class="performa-item wfh">
                <div class="performa-item-label">WFH</div>
                <div class="performa-item-value">{{ $monthData['performa']['wfh'] }}</div>
            </div>
            <div class="performa-item izin">
                <div class="performa-item-label">Izin</div>
                <div class="performa-item-value">{{ $monthData['performa']['izin'] }}</div>
            </div>
            <div class="performa-item sakit">
                <div class="performa-item-label">Sakit</div>
                <div class="performa-item-value">{{ $monthData['performa']['sakit'] }}</div>
            </div>
            <div class="performa-item libur">
                <div class="performa-item-label">Libur</div>
                <div class="performa-item-value">{{ $monthData['performa']['libur'] }}</div>
            </div>
            <div class="performa-item alfa">
                <div class="performa-item-label">Alfa</div>
                <div class="performa-item-value">{{ $monthData['performa']['alfa'] }}</div>
            </div>
        </div>

        @if($monthData['jurnal']->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 15%;">Jam Mulai</th>
                    <th style="width: 15%;">Jam Selesai</th>
                    <th style="width: 35%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthData['jurnal'] as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tgl)) }}</td>
                    <td>
                        <span class="status-badge status-{{ $item->status_kehadiran }}">
                            {{ strtoupper(str_replace(['wfo', 'wfh'], ['WFO', 'WFH'], $item->status_kehadiran)) }}
                        </span>
                    </td>
                    <td>{{ $item->jam_mulai }}</td>
                    <td>{{ $item->jam_selesai }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div style="text-align: center; padding: 10px; background-color: #fff3cd; border-radius: 5px; font-size: 12px;">
            Tidak ada data kehadiran untuk bulan ini
        </div>
        @endif
    </div>
    @endforeach

    <div class="footer">
        <p style="margin: 0;">Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
        <p style="margin-top: 30px; margin-bottom: 0;">Guru Pembimbing</p>
        <p style="margin-top: 50px; text-decoration: underline; margin-bottom: 0;">{{ $guru->nama }}</p>
    </div>
</body>
</html>