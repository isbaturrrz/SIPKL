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
        .chart-container {
            position: relative;
            width: 100%;
            min-height: 250px;
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
            .chart-container {
                min-height: 280px;
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
            .chart-container {
                min-height: 300px;
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
                padding: 12px;
            }
        }

        @media (max-width: 320px) {
            .chart-container {
                min-height: 240px;
            }
            .chart-card .chart-title {
                font-size: 13px;
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
    <div id="page-loader">
        <img src="{{ asset('dist_admin/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Dashboard...</div>
    </div>

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
                                <div class="chart-container">
                                    <canvas id="chartPenempatan"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="info-card mt-4">
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
                                <div class="chart-container">
                                    <canvas id="chartJurusan"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="info-card mt-4">
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
                                <div class="chart-container">
                                    <canvas id="chartTrend"></canvas>
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
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('page-loader').classList.add('hidden');
            }, 800);
        });

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

        function getResponsiveConfig() {
            const width = window.innerWidth;
            
            if (width <= 320) {
                return {
                    fontSize: 9,
                    legendFontSize: 8,
                    padding: 8,
                    maxTicksLimit: 4,
                    pointRadius: 2,
                    borderWidth: 1.5
                };
            } else if (width <= 375) {
                return {
                    fontSize: 10,
                    legendFontSize: 9,
                    padding: 10,
                    maxTicksLimit: 5,
                    pointRadius: 3,
                    borderWidth: 2
                };
            } else if (width <= 425) {
                return {
                    fontSize: 10,
                    legendFontSize: 9,
                    padding: 10,
                    maxTicksLimit: 6,
                    pointRadius: 3,
                    borderWidth: 2
                };
            } else if (width <= 768) {
                return {
                    fontSize: 11,
                    legendFontSize: 10,
                    padding: 12,
                    maxTicksLimit: 8,
                    pointRadius: 3.5,
                    borderWidth: 2
                };
            } else {
                return {
                    fontSize: 12,
                    legendFontSize: 11,
                    padding: 15,
                    maxTicksLimit: 10,
                    pointRadius: 4,
                    borderWidth: 2
                };
            }
        }

        let chartPenempatan, chartJurusan, chartTrend;

        function createPenempatanChart() {
            const config = getResponsiveConfig();
            
            if (chartPenempatan) {
                chartPenempatan.destroy();
            }

            const belumData = [
                @foreach($jurusanList as $jurusan)
                    {{ $chartData[$jurusan]['belum_ditempatkan'] }},
                @endforeach
            ];
            const sudahData = [
                @foreach($jurusanList as $jurusan)
                    {{ $chartData[$jurusan]['sudah_ditempatkan'] }},
                @endforeach
            ];
            const allValues = [...belumData, ...sudahData];
            const maxValue = Math.max(...allValues);
            
            let dynamicStepSize;
            let suggestedMax;

            if (maxValue <= 10) {
                dynamicStepSize = 2;
                suggestedMax = 10;
            } else if (maxValue <= 20) {
                dynamicStepSize = 5;
                suggestedMax = Math.ceil(maxValue / 5) * 5;
            } else if (maxValue <= 50) {
                dynamicStepSize = 10;
                suggestedMax = Math.ceil(maxValue / 10) * 10;
            } else if (maxValue <= 100) {
                dynamicStepSize = 20;
                suggestedMax = Math.ceil(maxValue / 20) * 20;
            } else if (maxValue <= 200) {
                dynamicStepSize = 25;
                suggestedMax = Math.ceil(maxValue / 25) * 25;
            } else {
                dynamicStepSize = Math.ceil(maxValue / 8);
                suggestedMax = Math.ceil(maxValue / dynamicStepSize) * dynamicStepSize;
            }

            const ctx = document.getElementById('chartPenempatan').getContext('2d');
            chartPenempatan = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($jurusanList) !!},
                    datasets: [
                        {
                            label: 'Belum ditempatkan',
                            data: belumData,
                            backgroundColor: '#e74a3b',
                            borderColor: '#c0392b',
                            borderWidth: config.borderWidth,
                            borderRadius: 4,
                            maxBarThickness: 60
                        },
                        {
                            label: 'Sudah ditempatkan',
                            data: sudahData,
                            backgroundColor: '#1dd1a1',
                            borderColor: '#10ac84',
                            borderWidth: config.borderWidth,
                            borderRadius: 4,
                            maxBarThickness: 60
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: suggestedMax,
                            ticks: {
                                stepSize: dynamicStepSize,
                                font: {
                                    size: config.fontSize
                                },
                                maxTicksLimit: config.maxTicksLimit,
                                padding: window.innerWidth <= 425 ? 5 : 10
                            },
                            grid: {
                                drawBorder: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: config.fontSize
                                },
                                maxRotation: window.innerWidth <= 768 ? 45 : 0,
                                minRotation: window.innerWidth <= 768 ? 45 : 0,
                                autoSkip: true,
                                maxTicksLimit: window.innerWidth <= 425 ? 4 : 6
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
                                padding: config.padding,
                                font: {
                                    size: config.legendFontSize
                                },
                                boxWidth: window.innerWidth <= 425 ? 12 : 15,
                                usePointStyle: true
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
                            right: window.innerWidth <= 425 ? 5 : 10,
                            top: 10,
                            bottom: 5
                        }
                    }
                }
            });
        }

        function createJurusanChart() {
            const config = getResponsiveConfig();
            
            if (chartJurusan) {
                chartJurusan.destroy();
            }

            const jurusanValues = [
                @foreach($jurusanList as $jurusan)
                    {{ $siswaJurusanData[$jurusan] }},
                @endforeach
            ];
            const totalJurusan = jurusanValues.reduce((a, b) => a + b, 0);

            const ctx = document.getElementById('chartJurusan').getContext('2d');
            chartJurusan = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($jurusanList) !!},
                    datasets: [{
                        data: jurusanValues,
                        backgroundColor: ['#667eea', '#f6c23e', '#e74a3b', '#1dd1a1', '#36b9cc'],
                        borderColor: '#fff',
                        borderWidth: window.innerWidth <= 425 ? 1 : 2,
                        hoverOffset: 10
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
                                boxWidth: window.innerWidth <= 425 ? 10 : 12,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const percentage = totalJurusan > 0 ? ((value / totalJurusan) * 100).toFixed(1) : 0;
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            },
                            titleFont: {
                                size: config.fontSize
                            },
                            bodyFont: {
                                size: config.fontSize
                            }
                        }
                    },
                    cutout: window.innerWidth <= 425 ? '50%' : '55%',
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
        }

        function createTrendChart() {
            const config = getResponsiveConfig();
            
            if (chartTrend) {
                chartTrend.destroy();
            }

            const trendData = [
                @foreach(range(1, 12) as $bulan)
                    {{ $jurnalPerBulan[$bulan] ?? 0 }},
                @endforeach
            ];
            const maxTrendValue = Math.max(...trendData);
            
            let dynamicStepSize;
            let suggestedMax;

            if (maxTrendValue <= 10) {
                dynamicStepSize = 2;
                suggestedMax = 10;
            } else if (maxTrendValue <= 20) {
                dynamicStepSize = 5;
                suggestedMax = Math.ceil(maxTrendValue / 5) * 5;
            } else if (maxTrendValue <= 50) {
                dynamicStepSize = 10;
                suggestedMax = Math.ceil(maxTrendValue / 10) * 10;
            } else if (maxTrendValue <= 100) {
                dynamicStepSize = 20;
                suggestedMax = Math.ceil(maxTrendValue / 20) * 20;
            } else if (maxTrendValue <= 200) {
                dynamicStepSize = 25;
                suggestedMax = Math.ceil(maxTrendValue / 25) * 25;
            } else {
                dynamicStepSize = Math.ceil(maxTrendValue / 8);
                suggestedMax = Math.ceil(maxTrendValue / dynamicStepSize) * dynamicStepSize;
            }

            const ctx = document.getElementById('chartTrend').getContext('2d');
            chartTrend = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jurnal',
                        data: trendData,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.05)',
                        borderWidth: config.borderWidth,
                        fill: true,
                        tension: 0.4,
                        pointRadius: config.pointRadius,
                        pointHoverRadius: window.innerWidth <= 425 ? 4 : 6,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#fff',
                        pointBorderWidth: window.innerWidth <= 425 ? 1 : 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: suggestedMax,
                            ticks: {
                                stepSize: dynamicStepSize,
                                font: {
                                    size: config.fontSize
                                },
                                maxTicksLimit: config.maxTicksLimit,
                                padding: window.innerWidth <= 425 ? 5 : 10
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: config.fontSize
                                },
                                maxRotation: window.innerWidth <= 768 ? 45 : 0,
                                minRotation: window.innerWidth <= 768 ? 45 : 0,
                                autoSkip: true,
                                maxTicksLimit: window.innerWidth <= 425 ? 6 : 12
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
                                padding: config.padding,
                                font: {
                                    size: config.legendFontSize
                                },
                                boxWidth: window.innerWidth <= 425 ? 12 : 15,
                                usePointStyle: true
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
                            right: window.innerWidth <= 425 ? 5 : 10,
                            top: 10,
                            bottom: 5
                        }
                    }
                }
            });
        }

        function initAllCharts() {
            createPenempatanChart();
            createJurusanChart();
            createTrendChart();
        }

        initAllCharts();

        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                initAllCharts();
            }, 250);
        });
    </script>

</body>

</html>