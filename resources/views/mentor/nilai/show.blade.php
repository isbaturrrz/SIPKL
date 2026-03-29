<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Nilai - Mentor</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }

        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #182151 0%, #3F7FB6 50%, #010B40 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-logo {
            width: 120px;
            height: auto;
            margin-bottom: 2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loader-text {
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 1.5rem;
            letter-spacing: 0.5px;
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

        .table-card {
            background: #fff;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h5 {
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            font-size: 1.1rem;
        }

        .nilai-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .nilai-table thead {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
        }

        .nilai-table thead th {
            color: #fff;
            font-weight: 700;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            border: none;
            vertical-align: middle;
        }

        .nilai-table tbody tr {
            border-bottom: 1px solid #e3e6f0;
        }

        .nilai-table tbody td {
            padding: 1rem;
            text-align: center;
            font-size: 1.1rem;
            font-weight: 700;
            color: #182151;
            vertical-align: middle;
            border-bottom: 1px solid #e3e6f0;
        }

        .box-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .box-summary .summary-item {
            padding: 1rem 1.5rem;
            text-align: center;
        }

        .box-summary .summary-item:first-child {
            border-right: 1px solid #e3e6f0;
        }

        .box-summary .summary-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 0.25rem;
        }

        .box-summary .summary-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #182151;
        }

        .btn-edit-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            text-decoration: none;
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
            color: #fff;
            box-shadow: 0 4px 10px rgba(24, 33, 81, 0.25);
        }

        .btn-edit-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(24, 33, 81, 0.35);
            color: #fff;
            text-decoration: none;
        }

        .btn-back-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            background: #64748b;
            color: #fff;
        }

        .btn-back-custom:hover {
            background: #475569;
            color: #fff;
            text-decoration: none;
        }

        .keterangan-box {
            background: #f8fafc;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            color: #334155;
            line-height: 1.6;
        }

        .bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 0.5rem 0;
        }

        .bottom-nav-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 100%;
            margin: 0 auto;
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.75rem;
            text-decoration: none;
            color: #64748b;
            font-size: 0.7rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            flex: 1;
            max-width: 80px;
        }

        .bottom-nav-item i {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .bottom-nav-item.active {
            color: #182151;
        }

        .bottom-nav-item.active i {
            transform: scale(1.1);
        }

        .bottom-nav-item span {
            font-size: 0.65rem;
        }

        .more-menu {
            position: fixed;
            bottom: 70px;
            right: 1rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 999;
        }

        .more-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .more-menu-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #334155;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .more-menu-item.active {
            background: #f1f5f9;
            color: #182151;
        }

        .more-menu-item:hover {
            background: #f8fafc;
            color: #182151;
        }

        .more-menu-item i {
            margin-right: 0.75rem;
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .more-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 998;
        }

        .more-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none !important;
            }

            .topbar {
                display: none !important;
            }

            #content-wrapper {
                margin-left: 0 !important;
            }

            .bottom-nav {
                display: block;
            }

            .container-fluid {
                padding: 1rem 1rem 5rem 1rem;
            }

            .sticky-footer {
                display: none;
            }

            .sidebar-brand {
                padding: 1rem 0.5rem !important;
            }

            .sidebar-brand-icon img {
                max-width: 80px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 60px;
            }

            .table-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start;
            }

            .btn-back-custom {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }

            .bottom-nav-item {
                font-size: 0.65rem;
            }

            .bottom-nav-item i {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body id="page-top">
    <div id="page-loader">
        <img src="{{ asset('dist_mentor/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Data...</div>
    </div>

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('mentor.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_mentor/img/logo.png')}}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Daftar Siswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.jurnal.index') }}">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Verifikasi Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.riwayat.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('mentor.nilai.index') }}">
                    <i class="fas fa-star"></i>
                    <span>Nilai Siswa</span>
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
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="mr-2 d-none d-lg-inline text-gray-600">
                                    Halo {{ Auth::user()->name }}
                                </span>
                            </a>
                        </li>
                        @endauth
                    </ul>
                </nav>

                <div class="container-fluid">

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Data Siswa</h5>
                        </div>
                        <div style="padding: 1.25rem 2rem;">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="100" class="font-weight-bold">Nama</td>
                                    <td>: {{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kelas</td>
                                    <td>: {{ $siswa->kelas_lengkap }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Hasil Penilaian</h5>
                            <a href="{{ route('mentor.nilai.edit', $siswa->id_siswa) }}" class="btn-edit-custom">
                                <i class="fas fa-edit"></i> Edit Nilai
                            </a>
                        </div>
                        <div style="padding: 1.5rem 2rem;">
                            <div class="box-summary">
                                <div class="summary-item">
                                    <div class="summary-label">Nilai Akhir</div>
                                    <div class="summary-value">{{ $siswa->penilaian->nilai_akhir }}</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">Predikat</div>
                                    <div class="summary-value">
                                        @php
                                            $nilai = $siswa->penilaian->nilai_akhir;
                                            if ($nilai >= 90) $predikat = 'A';
                                            elseif ($nilai >= 80) $predikat = 'B';
                                            elseif ($nilai >= 70) $predikat = 'C';
                                            elseif ($nilai >= 60) $predikat = 'D';
                                            else $predikat = 'E';
                                        @endphp
                                        {{ $predikat }}
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="nilai-table">
                                    <thead>
                                        <tr>
                                            <th>Kedisiplinan</th>
                                            <th>Kreativitas</th>
                                            <th>Tanggung Jawab</th>
                                            <th>Kerjasama</th>
                                            <th>Komunikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $siswa->penilaian->nilai_kedisiplinan }}</td>
                                            <td>{{ $siswa->penilaian->nilai_kreatifitas }}</td>
                                            <td>{{ $siswa->penilaian->nilai_tanggung_jawab }}</td>
                                            <td>{{ $siswa->penilaian->nilai_kerjasama }}</td>
                                            <td>{{ $siswa->penilaian->nilai_komunikasi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <div class="font-weight-bold text-dark mb-2" style="font-size: 0.9rem;">Keterangan</div>
                                <div class="keterangan-box">
                                    {{ $siswa->penilaian->keterangan ?? 'Tidak ada keterangan.' }}
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('mentor.nilai.index') }}" class="btn-back-custom">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Nilai Siswa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; COHESION TEAM 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <div class="more-menu-overlay" id="moreMenuOverlay"></div>
    <div class="more-menu" id="moreMenu">
        <a href="{{ route('mentor.riwayat.index') }}" class="more-menu-item">
            <i class="fas fa-history"></i>
            <span>Riwayat Jurnal</span>
        </a>
        <a href="{{ route('mentor.nilai.index') }}" class="more-menu-item active">
            <i class="fas fa-star"></i>
            <span>Nilai Siswa</span>
        </a>
        <a href="#" class="more-menu-item" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <nav class="bottom-nav">
        <div class="bottom-nav-container">
            <a href="{{ route('mentor.dashboard') }}" class="bottom-nav-item">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('mentor.siswa.index') }}" class="bottom-nav-item">
                <i class="fas fa-users"></i>
                <span>Siswa</span>
            </a>
            <a href="{{ route('mentor.jurnal.index') }}" class="bottom-nav-item">
                <i class="fas fa-clipboard-check"></i>
                <span>Verifikasi</span>
            </a>
            <a href="#" class="bottom-nav-item active" id="moreBtn">
                <i class="fas fa-ellipsis-h"></i>
                <span>Lainnya</span>
            </a>
        </div>
    </nav>

    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('page-loader').classList.add('hidden');
            }, 800);
        });

        const moreBtn = document.getElementById('moreBtn');
        const moreMenu = document.getElementById('moreMenu');
        const moreMenuOverlay = document.getElementById('moreMenuOverlay');

        moreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            moreMenu.classList.toggle('active');
            moreMenuOverlay.classList.toggle('active');
        });

        moreMenuOverlay.addEventListener('click', function() {
            moreMenu.classList.remove('active');
            moreMenuOverlay.classList.remove('active');
        });

        document.querySelectorAll('.more-menu-item').forEach(function(item) {
            item.addEventListener('click', function() {
                moreMenu.classList.remove('active');
                moreMenuOverlay.classList.remove('active');
            });
        });
    </script>
</body>
</html>