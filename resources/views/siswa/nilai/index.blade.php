<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unduh Nilai - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }

        .sidebar {
            background: linear-gradient(180deg, #0d1b3e 0%, #1e3a6e 100%) !important;
        }

        .sidebar .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .sidebar .nav-item .nav-link:hover,
        .sidebar .nav-item.active .nav-link {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-item .nav-link i {
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        .sidebar-brand {
            padding: 1.5rem 1rem !important;
        }

        .sidebar-brand-icon img {
            max-width: 120px;
            height: auto;
            transition: max-width 0.3s ease;
        }

        .sidebar.toggled .sidebar-brand-icon img {
            max-width: 50px;
        }

        .sidebar.toggled .sidebar-brand {
            padding: 1rem 0.5rem !important;
        }

        #content {
            background-color: #e8eef7;
            min-height: 100vh;
        }

        .topbar {
            background-color: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .info-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .info-card h5 {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            border-bottom: 2px solid #e3e6f0;
            padding-bottom: 0.75rem;
        }

        .info-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 150px;
            font-weight: 600;
            color: #5a5c69;
            font-size: 0.95rem;
        }

        .info-separator {
            margin: 0 1rem;
            color: #5a5c69;
        }

        .info-value {
            flex: 1;
            color: #1a1a1a;
            font-size: 0.95rem;
        }

        .nilai-table-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .nilai-table-header {
           background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            color: #fff;
            padding: 1rem 2rem;
            font-weight: 700;
            font-size: 1rem;
        }

        .nilai-table {
            width: 100%;
            border-collapse: collapse;
        }

        .nilai-table th,
        .nilai-table td {
            padding: 1rem;
            text-align: center;
            border: 1px solid #e3e6f0;
        }

        .nilai-table th {
            background: #f8f9fc;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 0.9rem;
        }

        .nilai-table td {
            color: #334155;
            font-size: 0.9rem;
        }

        .nilai-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .nilai-akhir-row {
            background: #f0f4f8 !important;
            font-weight: 700;
            font-size: 1rem;
        }

        .predikat-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
        }

        .btn-download {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            color: #fff;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.4);
            color: #fff;
        }

        .btn-download i {
            font-size: 1.1rem;
        }

        .no-data-message {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

        .no-data-message i {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .no-data-message h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .sidebar-brand {
                padding: 1rem 0.5rem !important;
            }
            
            .sidebar-brand-icon img {
                max-width: 80px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 60px;
            }

            .info-row {
                flex-direction: column;
            }

            .info-label {
                width: 100%;
                margin-bottom: 0.25rem;
            }

            .info-separator {
                display: none;
            }

            .nilai-table {
                font-size: 0.8rem;
            }

            .nilai-table th,
            .nilai-table td {
                padding: 0.75rem 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('siswa.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.jurnal.create') }}">
                    <i class="fas fa-pen-square"></i>
                    <span>Catat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.jurnal.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('siswa.nilai.index') }}">
                    <i class="fas fa-download"></i>
                    <span>Unduh Nilai</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.instansi.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Pilih Instansi</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if($penilaian)
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="info-card">
                                <h5>INFORMASI SISWA</h5>
                                <div class="info-row">
                                    <div class="info-label">Nama</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $siswa->nama }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">NIPD</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $siswa->nipd }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Kelas</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $siswa->kelas_lengkap }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="info-card">
                                <h5>INFORMASI PKL</h5>
                                <div class="info-row">
                                    <div class="info-label">Instansi PKL</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $penilaian->instansi->nama_instansi ?? '-' }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Periode PKL</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">21.2.2024 - 21.5.2024</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Pembimbing</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $penilaian->instansi->pemilik ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nilai-table-card">
                        <div class="nilai-table-header">
                            NILAI AKHIR
                        </div>
                        <table class="nilai-table">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">NILAI AKHIR</th>
                                    <th style="width: 60%;">PREDIKAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 1.5rem; font-weight: 700; color: #1e4179;">
                                        {{ number_format($penilaian->nilai_akhir, 1) }}
                                    </td>
                                    <td>
                                        <span class="predikat-badge">
                                            @if($penilaian->nilai_akhir >= 90) A
                                            @elseif($penilaian->nilai_akhir >= 80) B
                                            @elseif($penilaian->nilai_akhir >= 70) C
                                            @elseif($penilaian->nilai_akhir >= 60) D
                                            @else E
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="nilai-table-card">
                        <div class="nilai-table-header">
                            DETAIL ASPEK PENILAIAN
                        </div>
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
                                    <td style="text-align: left; padding-left: 2rem;">Kedisiplinan</td>
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
                                    <td style="text-align: left; padding-left: 2rem;">Tanggung Jawab</td>
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
                                    <td style="text-align: left; padding-left: 2rem;">Kreatifitas</td>
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
                                    <td style="text-align: left; padding-left: 2rem;">Komunikasi</td>
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
                                    <td style="text-align: left; padding-left: 2rem;">Kerjasama</td>
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
                                    <td colspan="2" style="text-align: center;">JUMLAH</td>
                                    <td>{{ number_format($penilaian->nilai_kedisiplinan + $penilaian->nilai_tanggung_jawab + $penilaian->nilai_kreatifitas + $penilaian->nilai_komunikasi + $penilaian->nilai_kerjasama, 0) }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right mb-4">
                        <a href="{{ route('siswa.nilai.download') }}" class="btn-download">
                            <i class="fas fa-file-pdf"></i>
                            Unduh PDF
                        </a>
                    </div>

                    @else
                    <div class="info-card">
                        <div class="no-data-message">
                            <i class="fas fa-clipboard-list"></i>
                            <h5>Belum Ada Penilaian</h5>
                            <p>Penilaian PKL Anda belum tersedia. Hubungi pembimbing instansi untuk informasi lebih lanjut.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © COHESION TEAM 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>