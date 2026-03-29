<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
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

        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
            
            #content-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
            }
            
            .topbar {
                padding-left: 1rem !important;
            }
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
        }

        @media (max-width: 480px) {
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }
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
            border-bottom: 2px solid #667eea;
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
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #ecf0f1;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-item-label {
            font-weight: 500;
            color: #555;
        }
        .info-item-value {
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
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
            border-left: 4px solid #667eea;
        }
        .stat-item .stat-item-value {
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
            margin-top: 5px;
        }
        .stat-item .stat-item-label {
            font-size: 11px;
            color: #666;
            font-weight: 500;
        }
        .instansi-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .instansi-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #ecf0f1;
        }
        .instansi-item:last-child {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .chart-card .chart-title {
                font-size: 14px;
            }
            .stat-card .stat-value {
                font-size: 22px;
            }
            .stat-card .stat-label {
                font-size: 10px;
            }
            .info-item-value {
                font-size: 14px;
            }
            .stat-item .stat-item-value {
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .stat-breakdown {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }
            .stat-item {
                padding: 10px;
            }
            .chart-card {
                padding: 15px;
            }
            .info-card {
                padding: 15px;
            }
        }

        .mobile-nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0d1b3e 0%, #1e3a6e 100%);
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        .mobile-nav-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .mobile-nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .mobile-nav-header .logo img {
            max-width: 120px;
            height: auto;
        }

        .close-nav-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-nav-btn:hover {
            transform: rotate(90deg);
            background: rgba(255, 255, 255, 0.2);
        }

        .mobile-nav-content {
            height: calc(100% - 80px - 80px);
            overflow-y: auto;
            padding: 2rem;
        }

        .mobile-nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav-menu li {
            margin-bottom: 0.5rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.4s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-nav-menu li:nth-child(1) { animation-delay: 0.05s; }
        .mobile-nav-menu li:nth-child(2) { animation-delay: 0.1s; }
        .mobile-nav-menu li:nth-child(3) { animation-delay: 0.15s; }
        .mobile-nav-menu li:nth-child(4) { animation-delay: 0.2s; }
        .mobile-nav-menu li:nth-child(5) { animation-delay: 0.25s; }
        .mobile-nav-menu li:nth-child(6) { animation-delay: 0.3s; }
        .mobile-nav-menu li:nth-child(7) { animation-delay: 0.35s; }
        .mobile-nav-menu li:nth-child(8) { animation-delay: 0.4s; }
        .mobile-nav-menu li:nth-child(9) { animation-delay: 0.45s; }
        .mobile-nav-menu li:nth-child(10) { animation-delay: 0.5s; }

        .mobile-nav-menu a {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.25rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .mobile-nav-menu a i {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .mobile-nav-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(10px);
            color: white;
        }

        .mobile-nav-menu a:hover i {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .mobile-nav-menu .active a {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .mobile-nav-menu .active a i {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        .mobile-nav-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
        }

        .user-info i {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1.2rem;
        }

        .user-info .user-details {
            flex: 1;
        }

        .user-info .user-name {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .user-info .user-role {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .logout-mobile {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .logout-mobile:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        @media (max-width: 768px) {
            .mobile-nav-menu a {
                font-size: 1.3rem;
                padding: 1rem 1.2rem;
            }
            
            .mobile-nav-menu a i {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
            
            .mobile-nav-content {
                padding: 1.5rem;
            }
            
            .mobile-nav-header {
                padding: 1rem 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .mobile-nav-menu a {
                font-size: 1.15rem;
                padding: 0.9rem 1rem;
                gap: 1rem;
            }
            
            .mobile-nav-menu a i {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .mobile-nav-content {
                padding: 1rem;
            }
            
            .mobile-nav-header {
                padding: 0.8rem 1rem;
            }
            
            .close-nav-btn {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }
        }

        @media (max-width: 400px) {
            .mobile-nav-menu a {
                font-size: 1rem;
                padding: 0.8rem 0.8rem;
            }
            
            .mobile-nav-menu a i {
                width: 38px;
                height: 38px;
                font-size: 0.9rem;
            }
            
            .user-info i {
                width: 40px;
                height: 40px;
            }
            
            .user-info .user-name {
                font-size: 0.9rem;
            }
        }

        .hamburger-menu {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #5a5c69;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .hamburger-menu:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 991px) {
            .hamburger-menu {
                display: block;
            }
            
            #sidebarToggleTop {
                display: none;
            }
        }

        body.menu-open {
            overflow: hidden;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_admin/img/logo.png')}}" alt="">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>   

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.siswa.index') }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.instansi.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Kelola Instansi</span>
                </a> 
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pengajuan-instansi.index') }}">
                    <i class="fas fa-inbox"></i>
                    <span>Pengajuan Instansi</span>
                </a> 
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.guru.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Kelola Guru</span>
                </a>    
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola User</span>
                </a>    
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.import.index') }}">
                    <i class="fas fa-file-import"></i>
                    <span>Import Data</span>
                </a>    
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.sistem.index') }}">
                    <i class="fas fa-cogs"></i>
                    <span>Kelola Sistem</span>
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

                    <button class="hamburger-menu" id="hamburgerMenuBtn">
                        <i class="fa fa-bars"></i>
                    </button>

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>                  

                    <ul class="navbar-nav ml-auto">

                        @auth
                        <li class="nav-item">                             
                            <a class="nav-link" href="#">                                 
                                <span class="mr-2 d-none d-lg-inline text-gray-600 ">
                                    Halo {{ Auth::user()->name }}
                                </span>                             
                            </a>                         
                        </li>
                        @endauth

                    </ul>

                </nav>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-3 mb-sm-0 text-gray-800">Dashboard Admin</h1>
                    </div>

                    <div class="row mb-4">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Siswa</div>
                                        <div class="stat-value">{{ $totalSiswa }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Guru</div>
                                        <div class="stat-value">{{ $totalGuru }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Instansi</div>
                                        <div class="stat-value">{{ $totalInstansi }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total User</div>
                                        <div class="stat-value">{{ $totalUser }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="chart-card">
                                <div class="chart-title">Statistik Penempatan Siswa</div>
                                <div class="stat-breakdown">
                                    <div class="stat-item" style="border-left-color: #6495ed ;">
                                        <i class="fas fa-check-circle" style="color: #1dd1a1; font-size: 20px;"></i>
                                        <div class="stat-item-label">Sudah Ditempatkan</div>
                                        <div class="stat-item-value">{{ $siswaAktif }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #6495ed;">
                                        <i class="fas fa-times-circle" style="color: #f6c23e; font-size: 20px;"></i>
                                        <div class="stat-item-label">Belum Ditempatkan</div>
                                        <div class="stat-item-value">{{ $siswaBeluDitempatkan }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #6495ed ;">
                                        <i class="fas fa-scroll" style="color: #36b9cc; font-size: 20px;"></i>
                                        <div class="stat-item-label">Total Jurnal</div>
                                        <div class="stat-item-value">{{ $totalJurnal }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #6495ed;">
                                        <i class="fas fa-calendar-today" style="color: #e74a3b; font-size: 20px;"></i>
                                        <div class="stat-item-label">Jurnal Hari Ini</div>
                                        <div class="stat-item-value">{{ $jurnalHariIni }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-8">
                            <div class="chart-card">
                                <div class="chart-title">Penempatan Siswa per Jurusan</div>
                                <canvas id="chartPenempatan" height="100"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="info-card">
                                <div class="info-title">Data Siswa per Jurusan Tahun Ajaran 2025</div>
                                @foreach($jurusanList as $jurusan)
                                <div class="info-item">
                                    <span class="info-item-label">{{ $jurusan }}</span>
                                    <span class="info-item-value">{{ $siswaPerJurusanTotal[$jurusan] }} Siswa</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-6">
                            <div class="chart-card">
                                <div class="chart-title">Sebaran Siswa per Jurusan</div>
                                <canvas id="chartJurusan" height="80"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="info-card">
                                <div class="info-title">5 Instansi dengan Siswa Terbanyak</div>
                                <div class="instansi-list">
                                    @forelse($instansiData as $instansi)
                                    <div class="instansi-item">
                                        <span>{{ $instansi->nama_instansi }}</span>
                                        <span class="badge badge-primary">{{ $instansi->jumlah_siswa }} Siswa</span>
                                    </div>
                                    @empty
                                    <div class="text-center text-muted py-3">
                                        Belum ada data instansi
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 mb-3">
                            <div class="chart-card">
                                <div class="chart-title">Trend Jurnal Per Bulan</div>
                                <canvas id="chartTrend" height="60"></canvas>
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

    <div class="mobile-nav-overlay" id="mobileNavOverlay">
        <div class="mobile-nav-header">
            <div class="logo">
                <img src="{{asset('dist_admin/img/logo.png')}}" alt="Logo">
            </div>
            <button class="close-nav-btn" id="closeNavBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-nav-content">
            <ul class="mobile-nav-menu">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                    <a href="{{ route('admin.siswa.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Kelola Siswa</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.instansi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.instansi.index') }}">
                        <i class="fas fa-building"></i>
                        <span>Kelola Instansi</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.pengajuan-instansi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pengajuan-instansi.index') }}">
                        <i class="fas fa-inbox"></i>
                        <span>Pengajuan Instansi</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                    <a href="{{ route('admin.guru.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Kelola Guru</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Kelola User</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.import*') ? 'active' : '' }}">
                    <a href="{{ route('admin.import.index') }}">
                        <i class="fas fa-file-import"></i>
                        <span>Import Data</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.sistem*') ? 'active' : '' }}">
                    <a href="{{ route('admin.sistem.index') }}">
                        <i class="fas fa-cogs"></i>
                        <span>Kelola Sistem</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="mobile-nav-footer">
            @auth
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
                <a href="#" class="logout-mobile" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @endauth
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <script>
        const mobileOverlay = document.getElementById('mobileNavOverlay');
        const hamburgerBtn = document.getElementById('hamburgerMenuBtn');
        const closeNavBtn = document.getElementById('closeNavBtn');

        function openMobileMenu() {
            mobileOverlay.classList.add('active');
            document.body.classList.add('menu-open');
        }

        function closeMobileMenu() {
            mobileOverlay.classList.remove('active');
            document.body.classList.remove('menu-open');
        }

        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', openMobileMenu);
        }

        if (closeNavBtn) {
            closeNavBtn.addEventListener('click', closeMobileMenu);
        }

        mobileOverlay.addEventListener('click', function(e) {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });

        const mobileMenuLinks = document.querySelectorAll('.mobile-nav-menu a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(() => {
                    closeMobileMenu();
                }, 100);
            });
        });

        function getResponsiveFontSize() {
            if (window.innerWidth <= 576) return 9;
            if (window.innerWidth <= 768) return 10;
            if (window.innerWidth <= 992) return 11;
            return 12;
        }

        function getResponsiveStepSize(maxValue) {
            if (maxValue <= 50) return 10;
            if (maxValue <= 100) return 20;
            if (maxValue <= 200) return 50;
            if (maxValue <= 500) return 100;
            return 200;
        }

        var chartPenempatanData = {
            labels: {!! json_encode($jurusanList) !!},
            datasets: [
                {
                    label: 'Belum ditempatkan',
                    data: [
                        @foreach($jurusanList as $jurusan)
                            {{ $chartData[$jurusan]['belum_ditempatkan'] }},
                        @endforeach
                    ],
                    backgroundColor: '#e74a3b',
                    borderColor: '#c0392b',
                    borderWidth: 1,
                    borderRadius: 4,
                    maxBarThickness: 60
                },
                {
                    label: 'Sudah ditempatkan',
                    data: [
                        @foreach($jurusanList as $jurusan)
                            {{ $chartData[$jurusan]['sudah_ditempatkan'] }},
                        @endforeach
                    ],
                    backgroundColor: '#1dd1a1',
                    borderColor: '#10ac84',
                    borderWidth: 1,
                    borderRadius: 4,
                    maxBarThickness: 60
                }
            ]
        };

        var maxPenempatanValue = Math.max(
            ...chartPenempatanData.datasets[0].data,
            ...chartPenempatanData.datasets[1].data
        );

        var ctx = document.getElementById('chartPenempatan').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartPenempatanData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: getResponsiveStepSize(maxPenempatanValue),
                            maxTicksLimit: 6,
                            font: {
                                size: getResponsiveFontSize()
                            }
                        },
                        grid: {
                            drawBorder: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: getResponsiveFontSize()
                            },
                            maxRotation: 45,
                            minRotation: 45,
                            autoSkip: true,
                            maxTicksLimit: 6
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: getResponsiveFontSize()
                            },
                            boxWidth: 12,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        titleFont: {
                            size: 11
                        },
                        bodyFont: {
                            size: 11
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10,
                        left: 5,
                        right: 5
                    }
                }
            }
        });

        var chartJurusanData = {
            labels: {!! json_encode($jurusanList) !!},
            datasets: [{
                data: [
                    @foreach($jurusanList as $jurusan)
                        {{ $siswaJurusanData[$jurusan] }},
                    @endforeach
                ],
                backgroundColor: ['#667eea', '#f6c23e', '#e74a3b', '#1dd1a1', '#36b9cc'],
                borderColor: '#fff',
                borderWidth: 2,
                hoverOffset: 10
            }]
        };

        var ctx2 = document.getElementById('chartJurusan').getContext('2d');
        var chartJurusan = new Chart(ctx2, {
            type: 'doughnut',
            data: chartJurusanData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 12,
                            font: {
                                size: getResponsiveFontSize()
                            },
                            boxWidth: 10,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.raw || 0;
                                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        },
                        bodyFont: {
                            size: 11
                        }
                    }
                },
                cutout: '55%',
                layout: {
                    padding: {
                        top: 5,
                        bottom: 5,
                        left: 5,
                        right: 5
                    }
                }
            }
        });

        var trendData = [
            @foreach(range(1, 12) as $bulan)
                {{ $jurnalPerBulan[$bulan] ?? 0 }},
            @endforeach
        ];

        var maxTrendValue = Math.max(...trendData);

        var ctx3 = document.getElementById('chartTrend').getContext('2d');
        var chartTrend = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jurnal',
                    data: trendData,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: function(context) {
                        return window.innerWidth <= 576 ? 3 : 4;
                    },
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: maxTrendValue <= 50 ? 10 : (maxTrendValue <= 100 ? 20 : 50),
                            maxTicksLimit: 5,
                            font: {
                                size: getResponsiveFontSize()
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: getResponsiveFontSize()
                            },
                            maxRotation: 45,
                            minRotation: 45,
                            autoSkip: true,
                            maxTicksLimit: 8
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: getResponsiveFontSize()
                            },
                            boxWidth: 12,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        titleFont: {
                            size: 11
                        },
                        bodyFont: {
                            size: 11
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10,
                        left: 5,
                        right: 5
                    }
                }
            }
        });

        function resizeCharts() {
            var fontSize = getResponsiveFontSize();
            var stepSize = getResponsiveStepSize(maxPenempatanValue);
            
            if (myChart && myChart.options) {
                myChart.options.scales.y.ticks.font.size = fontSize;
                myChart.options.scales.x.ticks.font.size = fontSize;
                myChart.options.plugins.legend.labels.font.size = fontSize;
                myChart.options.scales.y.ticks.stepSize = stepSize;
                myChart.update();
            }
            
            if (chartJurusan && chartJurusan.options) {
                chartJurusan.options.plugins.legend.labels.font.size = fontSize;
                chartJurusan.update();
            }
            
            if (chartTrend && chartTrend.options) {
                var trendStepSize = maxTrendValue <= 50 ? 10 : (maxTrendValue <= 100 ? 20 : 50);
                chartTrend.options.scales.y.ticks.font.size = fontSize;
                chartTrend.options.scales.x.ticks.font.size = fontSize;
                chartTrend.options.plugins.legend.labels.font.size = fontSize;
                chartTrend.options.scales.y.ticks.stepSize = trendStepSize;
                if (chartTrend.options.elements && chartTrend.options.elements.point) {
                    chartTrend.options.elements.point.radius = window.innerWidth <= 576 ? 3 : 4;
                }
                chartTrend.update();
            }
        }

        window.addEventListener('resize', function() {
            setTimeout(resizeCharts, 100);
        });

        resizeCharts();
    </script>

</body>

</html>