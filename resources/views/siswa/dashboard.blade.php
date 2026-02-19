<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_siswa/css/style.css') }}">
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
        }

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .topbar .nav-item .nav-link {
            height: 4.375rem;
            display: flex;
            align-items: center;
        }

        #content {
            background-color: #e8eef7;
            min-height: 100vh;
        }

        .container-fluid {
            padding: 1.5rem 2rem;
        }

        .hero-card {
            background: linear-gradient(135deg, #2c5aa0 0%, #1e4179 100%);
            border-radius: 12px;
            padding: 2rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(30, 65, 121, 0.25);
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .hero-info {
            flex: 1;
            min-width: 250px;
            z-index: 1;
        }

        .hero-date {
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hero-name {
            color: #fff;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
        }

        .hero-school {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-class {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .hero-time-wrapper {
            z-index: 1;
            text-align: right;
        }

        .hero-time {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            font-variant-numeric: tabular-nums;
            letter-spacing: 3px;
        }

        .journal-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem 2.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .journal-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #f1f5f9;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .journal-top-text h5 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .journal-top-text p {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0;
        }

        .btn-catat-jurnal {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3);
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-catat-jurnal:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4);
            text-decoration: none;
        }

        .btn-catat-jurnal i {
            font-size: 1rem;
        }

        .pkl-section {
            text-align: center;
            padding: 1rem 0;
        }

        .tempat-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }

        .tempat-name {
            font-size: 2rem;
            font-weight: 800;
            color: #1e4179;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }

        .tempat-address {
            font-size: 0.95rem;
            color: #475569;
            font-weight: 500;
        }

        .no-instansi {
            text-align: center;
            padding: 3rem 2rem;
        }

        .no-instansi-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .no-instansi-text {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .sticky-footer {
            background-color: #fff;
            border-top: 1px solid #e3e6f0;
        }

        .copyright {
            font-size: 0.85rem;
            color: #858796;
        }

        .hero-card {
            animation: fadeUp 0.5s ease both;
        }

        .journal-card {
            animation: fadeUp 0.5s ease 0.15s both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem 1.5rem;
            }

            .hero-card {
                padding: 1.5rem 1.75rem;
            }

            .hero-name {
                font-size: 1.5rem;
            }

            .hero-school {
                font-size: 0.9rem;
            }

            .hero-class {
                font-size: 0.8rem;
            }

            .hero-time {
                font-size: 1.75rem;
                letter-spacing: 2px;
            }

            .hero-time-wrapper {
                text-align: left;
                width: 100%;
            }

            .journal-card {
                padding: 1.5rem 1.75rem;
            }

            .journal-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-catat-jurnal {
                width: 100%;
                justify-content: center;
            }

            .tempat-name {
                font-size: 1.5rem;
            }

            .tempat-address {
                font-size: 0.85rem;
            }

            .no-instansi {
                padding: 2rem 1.5rem;
            }

            .no-instansi-icon {
                font-size: 3rem;
            }
        }

        @media (max-width: 480px) {
            .hero-name {
                font-size: 1.25rem;
            }

            .hero-time {
                font-size: 1.5rem;
            }

            .tempat-name {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('siswa.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
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
                <a class="nav-link" href="#">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-download"></i>
                    <span>Unduh Nilai</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
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
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 font-weight-bold">
                                    Siswa
                                </span>
                            </a>
                        </li>
                        @endauth
                    </ul>
                </nav>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-card">
                                <div class="hero-info">
                                    <div class="hero-date" id="heroDate"></div>
                                    <div class="hero-name">{{ $nama }}</div>
                                    <div class="hero-school">SMK BUDI BAKTI CIWIDEY</div>
                                    <div class="hero-class">{{ $kelas_lengkap }} | {{ $jurusan_lengkap }}</div>
                                </div>
                                <div class="hero-time-wrapper">
                                    <div class="hero-time" id="heroTime"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="journal-card">
                                <div class="journal-top">
                                    <div class="journal-top-text">
                                        <h5>Sudah mengisi jurnal hari ini?</h5>
                                        <p>Jika belum yuk segera catat jurnalmu!</p>
                                    </div>
                                    <a href="{{ route('siswa.jurnal.create') }}" class="btn-catat-jurnal">
                                        <i class="fas fa-pen"></i>
                                        Catat Jurnal
                                    </a>
                                </div>

                                @if($has_instansi)
                                    <div class="pkl-section">
                                        <div class="tempat-label">Tempat PKL</div>
                                        <div class="tempat-name">{{ $instansi_nama }}</div>
                                        <div class="tempat-address">{{ $instansi_alamat }}</div>
                                    </div>
                                @else
                                    <div class="no-instansi">
                                        <div class="no-instansi-icon">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="no-instansi-text">
                                            Anda belum memiliki instansi PKL
                                        </div>
                                        <a href="#" class="btn-catat-jurnal">
                                            <i class="fas fa-building"></i>
                                            Pilih Instansi
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

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

    <script>
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('heroTime').textContent = h + ':' + m;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const d = now;
            document.getElementById('heroDate').textContent =
                d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>

</html>