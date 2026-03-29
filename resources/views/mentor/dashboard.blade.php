<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Mentor</title>

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

        .stat-card {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100%);
            border-radius: 10px;
            padding: 20px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin-top: 10px;
        }
        .stat-card .stat-label {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            opacity: 0.9;
        }
        .stat-card .stat-icon {
            font-size: 28px;
            opacity: 0.5;
        }
        .chart-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        }
        .chart-card .chart-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #1e3a6e;
        }
        
        .chart-container {
            position: relative;
            width: 100%;
            min-height: 250px;
        }
        
        .info-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        }
        .info-card .info-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #667eea;
        }
        .stat-breakdown {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }
        .stat-item {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #1e3a6e;
        }
        .stat-item .stat-item-value {
            font-size: 20px;
            font-weight: bold;
            color: #535353;
            margin-top: 5px;
        }
        .stat-item .stat-item-label {
            font-size: 11px;
            color: #666;
            font-weight: 500;
        }
        .stat-item .stat-item-percent {
            font-size: 11px;
            color: #999;
            margin-top: 3px;
        }
        .siswa-table {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        }
        .siswa-table .table-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #1e3a6e;
        }
        .siswa-table table {
            font-size: 13px;
        }
        .siswa-table table thead {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
            color: #fff;
        }
        .siswa-table table tbody tr:hover {
            background-color: #f1f3f5;
        }
        .badge-verified {
            background-color: #1dd1a1;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
        }
        .badge-pending {
            background-color: #f6c23e;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
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
            
            .chart-container {
                min-height: 280px;
            }
            
            .chart-card {
                padding: 15px;
            }
            
            .chart-card .chart-title {
                font-size: 14px;
                margin-bottom: 15px;
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
            
            .chart-container {
                min-height: 300px;
            }
            
            .chart-card {
                padding: 12px;
            }
            
            .chart-card .chart-title {
                font-size: 13px;
                margin-bottom: 12px;
                padding-bottom: 10px;
            }
            
            .row.mb-4 .col-xl-6 {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 425px) {
            .chart-container {
                min-height: 280px;
            }
            
            .stat-breakdown {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 375px) {
            .chart-container {
                min-height: 260px;
            }
            
            .chart-card {
                padding: 10px;
            }
        }

        @media (max-width: 320px) {
            .chart-container {
                min-height: 240px;
            }
            
            .chart-card .chart-title {
                font-size: 12px;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="page-loader">
        <img src="{{ asset('dist_mentor/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Dashboard...</div>
    </div>

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('mentor.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_mentor/img/logo.png')}}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
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

            <li class="nav-item">
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-3 mb-sm-0 text-gray-800">Dashboard Mentor</h1>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Siswa</div>
                                        <div class="stat-value">{{ $totalSiswa }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Jurnal Hari Ini</div>
                                        <div class="stat-value">{{ $jurnalHariIni }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Menunggu Verifikasi</div>
                                        <div class="stat-value">{{ $menungguVerifikasi }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="chart-card">
                                <div class="chart-title">Statistik Verifikasi Jurnal</div>
                                <div class="stat-breakdown">
                                    <div class="stat-item">
                                        <i class="fas fa-check-circle" style="color: #1dd1a1; font-size: 20px;"></i>
                                        <div class="stat-item-label">Sudah Verifikasi</div>
                                        <div class="stat-item-value">{{ $sudahVerifikasi }}</div>
                                        <div class="stat-item-percent">{{ $persentaseVerifikasi }}%</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: ##667eea;">
                                        <i class="fas fa-clock" style="color: #f6c23e; font-size: 20px;"></i>
                                        <div class="stat-item-label">Menunggu</div>
                                        <div class="stat-item-value">{{ $menungguVerifikasi }}</div>
                                        <div class="stat-item-percent">{{ $persentasePending }}%</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: ##667eea;">
                                        <i class="fas fa-times-circle" style="color: #e74a3b; font-size: 20px;"></i>
                                        <div class="stat-item-label">Ditolak</div>
                                        <div class="stat-item-value">{{ $ditolak }}</div>
                                        <div class="stat-item-percent">{{ $persentaseDitolak }}%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                            <div class="chart-card">
                                <div class="chart-title">Presentase Jurnal</div>
                                <div class="chart-container">
                                    <canvas id="chartPresentas"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                            <div class="chart-card">
                                <div class="chart-title">Trend Jurnal Per Bulan</div>
                                <div class="chart-container">
                                    <canvas id="chartTrend"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="siswa-table">
                                <div class="table-title">10 Siswa dengan Aktivitas Terbaru</div>
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Total Jurnal</th>
                                                <th>Verified</th>
                                                <th>Pending</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($siswaList as $index => $siswa)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $siswa->nama }}</td>
                                                <td>{{ $siswa->totalJurnal }}</td>
                                                <td><span class="badge-verified">{{ $siswa->jurnalVerified }}</span></td>
                                                <td><span class="badge-pending">{{ $siswa->jurnalPending }}</span></td>
                                                <td>
                                                    <div class="progress" style="height: 20px;">
                                                        @php
                                                            $persentase = $siswa->totalJurnal > 0 ? round(($siswa->jurnalVerified / $siswa->totalJurnal) * 100) : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100">{{ $persentase }}%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Belum ada siswa</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
        <a href="{{ route('mentor.nilai.index') }}" class="more-menu-item">
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
            <a href="{{ route('mentor.dashboard') }}" class="bottom-nav-item active">
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
            <a href="#" class="bottom-nav-item" id="moreBtn">
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
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

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

        function getResponsiveConfig() {
            const width = window.innerWidth;
            
            if (width <= 320) {
                return {
                    fontSize: 9,
                    legendFontSize: 8,
                    padding: 8,
                    maxTicksLimit: 4
                };
            } else if (width <= 375) {
                return {
                    fontSize: 10,
                    legendFontSize: 9,
                    padding: 10,
                    maxTicksLimit: 5
                };
            } else if (width <= 425) {
                return {
                    fontSize: 10,
                    legendFontSize: 9,
                    padding: 10,
                    maxTicksLimit: 6
                };
            } else if (width <= 768) {
                return {
                    fontSize: 11,
                    legendFontSize: 10,
                    padding: 12,
                    maxTicksLimit: 8
                };
            } else {
                return {
                    fontSize: 12,
                    legendFontSize: 11,
                    padding: 15,
                    maxTicksLimit: 10
                };
            }
        }

        let chartPresentas, chartTrend;
        
        function createCharts() {
            const config = getResponsiveConfig();

            if (chartPresentas) chartPresentas.destroy();
            if (chartTrend) chartTrend.destroy();

            var ctx1 = document.getElementById('chartPresentas').getContext('2d');
            chartPresentas = new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: ['Sudah Verifikasi', 'Menunggu Verifikasi', 'Ditolak'],
                    datasets: [{
                        data: [{{ $sudahVerifikasi }}, {{ $menungguVerifikasi }}, {{ $ditolak }}],
                        backgroundColor: ['#1dd1a1', '#f6c23e', '#e74a3b'],
                        borderColor: ['#10ac84', '#dda516', '#c0392b'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: config.padding,
                                font: {
                                    size: config.legendFontSize
                                },
                                boxWidth: window.innerWidth <= 425 ? 12 : 15,
                                boxHeight: window.innerWidth <= 425 ? 12 : 15
                            }
                        },
                        tooltip: {
                            titleFont: {
                                size: config.fontSize
                            },
                            bodyFont: {
                                size: config.fontSize
                            }
                        }
                    }
                }
            });

            var ctx2 = document.getElementById('chartTrend').getContext('2d');
            chartTrend = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jurnal',
                        data: [
                            @foreach(range(1, 12) as $bulan)
                                {{ $jurnalPerBulan[$bulan] ?? 0 }},
                            @endforeach
                        ],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: window.innerWidth <= 425 ? 3 : 4,
                        pointBackgroundColor: '#667eea',
                        pointBorderWidth: window.innerWidth <= 425 ? 1 : 2,
                        pointHoverRadius: window.innerWidth <= 425 ? 4 : 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: config.fontSize
                                },
                                maxRotation: window.innerWidth <= 425 ? 45 : 0,
                                minRotation: window.innerWidth <= 425 ? 45 : 0,
                                autoSkip: true,
                                maxTicksLimit: window.innerWidth <= 425 ? 6 : 12
                            },
                            grid: {
                                display: window.innerWidth > 425
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: window.innerWidth <= 425 ? 10 : 5,
                                font: {
                                    size: config.fontSize
                                },
                                maxTicksLimit: config.maxTicksLimit,
                                padding: window.innerWidth <= 425 ? 5 : 10
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: config.padding,
                                font: {
                                    size: config.legendFontSize
                                },
                                boxWidth: window.innerWidth <= 425 ? 12 : 15,
                                boxHeight: window.innerWidth <= 425 ? 12 : 15
                            }
                        },
                        tooltip: {
                            titleFont: {
                                size: config.fontSize
                            },
                            bodyFont: {
                                size: config.fontSize
                            },
                            padding: window.innerWidth <= 425 ? 8 : 12
                        }
                    },
                    layout: {
                        padding: {
                            left: window.innerWidth <= 425 ? 5 : 10,
                            right: window.innerWidth <= 425 ? 5 : 10
                        }
                    }
                }
            });
        }

        createCharts();

        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                createCharts();
            }, 250);
        });
    </script>
</body>
</html>