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
        .performa-section {
            margin-bottom: 20px;
        }
        .performa-title {
            background-color: #4e73df;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .performa-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        .performa-item {
            border: 2px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            background-color: #f8f9fa;
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
            font-size: 12px;
            color: #333;
            margin-bottom: 5px;
        }
        .performa-item-value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #4e73df;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        .table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
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
        .tanggal-cetak {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Performa Kehadiran Siswa</h2>
        <p>Periode: {{ $bulan }} {{ $tahun }}</p>
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

    <div class="performa-section">
        <div class="performa-title">Ringkasan Performa Kehadiran</div>
        
        <div class="performa-grid">
            <div class="performa-item wfo">
                <div class="performa-item-label">Hadir WFO</div>
                <div class="performa-item-value">{{ $performa['wfo'] }}</div>
            </div>
            <div class="performa-item wfh">
                <div class="performa-item-label">Hadir WFH</div>
                <div class="performa-item-value">{{ $performa['wfh'] }}</div>
            </div>
            <div class="performa-item izin">
                <div class="performa-item-label">Izin</div>
                <div class="performa-item-value">{{ $performa['izin'] }}</div>
            </div>
            <div class="performa-item sakit">
                <div class="performa-item-label">Sakit</div>
                <div class="performa-item-value">{{ $performa['sakit'] }}</div>
            </div>
            <div class="performa-item libur">
                <div class="performa-item-label">Libur</div>
                <div class="performa-item-value">{{ $performa['libur'] }}</div>
            </div>
            <div class="performa-item alfa">
                <div class="performa-item-label">Alfa</div>
                <div class="performa-item-value">{{ $performa['alfa'] }}</div>
            </div>
        </div>
    </div>

    @if($jurnal->count() > 0)
    <div class="performa-section">
        <div class="performa-title">Detail Kehadiran Harian</div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jurnal as $index => $item)
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
    </div>
    @else
    <div class="info-section" style="text-align: center; background-color: #fff3cd; border-color: #f6c23e;">
        <p><strong>Tidak ada data kehadiran untuk periode ini</strong></p>
    </div>
    @endif

    <div class="footer">
        <p class="tanggal-cetak">Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
        <p style="margin-top: 15px;">Guru Pembimbing</p>
        <p style="margin-top: 50px; text-decoration: underline;">{{ $guru->nama }}</p>
    </div>
</body>
</html>