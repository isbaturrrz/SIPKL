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
            font-family: 'Times New Roman', Times, serif;
            padding: 30px 50px;
            font-size: 11px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #000;
        }

        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 10px;
            margin: 1px 0;
        }

        .info-section {
            margin-bottom: 20px;
            font-size: 11px;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            width: 110px;
            padding: 2px 0;
        }

        .info-colon {
            display: table-cell;
            width: 15px;
            padding: 2px 0;
        }

        .info-value {
            display: table-cell;
            padding: 2px 0;
        }

        .nilai-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 15px 0;
            font-size: 11px;
        }

        .nilai-table th,
        .nilai-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
        }

        .nilai-table th {
            font-weight: bold;
            background: #e3e3e3;
        }

        .nilai-table td:nth-child(2) {
            text-align: left;
            padding-left: 12px;
        }

        .nilai-table .total-row,
        .nilai-table .average-row {
            font-weight: normal;
            background: #e3e3e3;
        }

        .nilai-table .total-row td:first-child,
        .nilai-table .average-row td:first-child {
            font-weight: bold;
        }

        .nilai-akhir-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11px;
        }

        .nilai-akhir-table th,
        .nilai-akhir-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        .nilai-akhir-table th {
            font-weight: bold;
            background: #e3e3e3;
        }

        .nilai-akhir-table tr:last-child td {
            background: #e3e3e3;
        }

        .signature-section {
            margin-top: 50px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
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
            width: 175px;
            margin-top: 10px;
        }

        @media print {
            body {
                padding: 20px 40px;
            }
            
            @page {
                size: A4;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SMK BUDI BAKTI CIWIDEY</h1>
        <p>Jl. Raya Ciwidey No. 82, RT 001/RW 007, Desa Kelurahan Ciwidey,</p>
        <p>Kecamatan Ciwidey, Kabupaten Bandung, Jawa Barat</p>
        <p>Tlp. (022) 5928262</p>
    </div>

    <div class="info-section">
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nama Siswa</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ $siswa->nama }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">NIPD</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ $siswa->nipd }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kelas</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ $siswa->kelas_lengkap }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jurusan</div>
                <div class="info-colon">:</div>
                <div class="info-value">Rekayasa Perangkat Lunak</div>
            </div>
            <div class="info-row">
                <div class="info-label">Periode PKL</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ date('d M Y', strtotime($siswa->tanggal_mulai)) }} - {{ date('d M Y', strtotime($siswa->tanggal_selesai)) }}</div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nama Instansi</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ $penilaian->instansi->nama_instansi ?? 'Cyberlabs' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Alamat</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ $penilaian->instansi->alamat ?? 'Jl Mars III Utara, Bandung' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">No. HP</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ $penilaian->instansi->no_hp ?? '(022) 8888 1999 0857 2303' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Pimpinan</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ $penilaian->instansi->pemilik }}</div>
            </div>
        </div>
    </div>

    <table class="nilai-table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 8%;">NO</th>
                <th rowspan="2" style="width: 50%;">ASPEK YANG DINILAI</th>
                <th colspan="2">ASPEK</th>
            </tr>
            <tr>
                <th style="width: 21%;">NILAI</th>
                <th style="width: 21%;">HURUF</th>
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
            <tr class="total-row">
                <td colspan="2">TOTAL</td>
                <td>{{ number_format($penilaian->nilai_kedisiplinan + $penilaian->nilai_tanggung_jawab + $penilaian->nilai_kreatifitas + $penilaian->nilai_komunikasi + $penilaian->nilai_kerjasama, 0) }}</td>
                <td>-</td>
            </tr>
            <tr class="average-row">
                <td colspan="2">RATA-RATA</td>
                <td>{{ number_format($penilaian->nilai_akhir, 1) }}</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>

    <table class="nilai-akhir-table">
        <thead>
            <tr>
                <th style="width: 50%;">Nilai Akhir</th>
                <th style="width: 50%;">Predikat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ number_format($penilaian->nilai_akhir, 1) }}</td>
                <td>
                    @if($penilaian->nilai_akhir >= 90) A
                    @elseif($penilaian->nilai_akhir >= 80) B
                    @elseif($penilaian->nilai_akhir >= 70) C
                    @elseif($penilaian->nilai_akhir >= 60) D
                    @else E
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left; padding: 8px;">
                    @if($penilaian->keterangan)
                    Catatan: {{ $penilaian->keterangan }}
                    @else
                    Catatan:<br>Demikian keterangan ini dibuat, untuk digunakan sebagaimana mestinya.
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p>Bandung, {{ date('d F Y') }}<br>Pembimbing DU/DI</p>
            <div class="signature-line"></div>
            <p style="margin-top: 10px; margin-bottom: 0;">{{ $penilaian->instansi->pemilik ?? '(............................)' }}</p>
        </div>
    </div>
</body>
</html>