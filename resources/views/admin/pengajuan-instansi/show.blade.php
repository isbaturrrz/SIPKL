<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Pengajuan - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_admin/css/style.css')}}">
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

        .card-header {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100%);
        }

        .card-header h6 {
            color: white !important;
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

        body.menu-open {
            overflow: hidden;
        }

        .detail-label {
            font-weight: 700;
            color: #6c757d;
            width: 200px;
        }
        .detail-value {
            color: #212529;
        }

        .swal2-popup {
            border-radius: 16px !important;
            padding: 0 !important;
            width: 85% !important;
            max-width: 450px !important;
        }

        .swal2-icon {
            width: 60px !important;
            height: 60px !important;
            margin: 1.5rem auto 1rem !important;
            border-width: 3px !important;
        }

        .swal2-title {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #1a1a1a !important;
            padding: 0 1.5rem !important;
            margin-bottom: 0.75rem !important;
        }

        .swal2-html-container {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            font-size: 0.9rem !important;
            color: #64748b !important;
        }

        .swal2-actions {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            gap: 0.75rem !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
        }

        .swal2-cancel {
            background: #fff !important;
            color: #64748b !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            border: 2px solid #e2e8f0 !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, #2c5aa0 0%, #1e4179 100%);
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 1.25rem 1.5rem;
        }

        .modal-header .modal-title {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .modal-header .close {
            color: #fff;
            opacity: 0.8;
            text-shadow: none;
        }

        .modal-header .close:hover {
            opacity: 1;
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

            <li class="nav-item">
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

            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Pengajuan Instansi</h1>
                        <a href="{{ route('admin.pengajuan-instansi.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Siswa</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="detail-label">Nama</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">NIPD</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->nipd }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Kelas</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->kelas_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Jurusan</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->jurusan_lengkap }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Instansi</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="detail-label">Nama Perusahaan</td>
                                            <td class="detail-value">: {{ $pengajuan->nama_perusahaan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Pemilik</td>
                                            <td class="detail-value">: {{ $pengajuan->pemilik }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">No HP</td>
                                            <td class="detail-value">: {{ $pengajuan->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Kuota Siswa</td>
                                            <td class="detail-value">: {{ $pengajuan->kuota_siswa }} siswa</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Jurusan Diterima</td>
                                            <td class="detail-value">
                                                : @if($pengajuan->jurusan_diterima === 'PPLG-BRP-DKV')
                                                    <span class="badge badge-success">Semua Jurusan</span>
                                                @else
                                                    @php
                                                        $jurusan_list = explode('-', $pengajuan->jurusan_diterima);
                                                    @endphp
                                                    <span class="badge badge-info">{{ implode(', ', $jurusan_list) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Lengkap</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="detail-label">Alamat</td>
                                    <td class="detail-value">: {{ $pengajuan->alamat }}</td>
                                </tr>
                                @if($pengajuan->latitude && $pengajuan->longitude)
                                <tr>
                                    <td class="detail-label">Koordinat</td>
                                    <td class="detail-value">: {{ $pengajuan->latitude }}, {{ $pengajuan->longitude }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="detail-label">Status</td>
                                    <td class="detail-value">
                                        : @if($pengajuan->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($pengajuan->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($pengajuan->status == 'rejected' && $pengajuan->keterangan_reject)
                                <tr>
                                    <td class="detail-label">Alasan Penolakan</td>
                                    <td class="detail-value">: {{ $pengajuan->keterangan_reject }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="detail-label">Tanggal Pengajuan</td>
                                    <td class="detail-value">: {{ $pengajuan->created_at->format('d F Y, H:i') }}</td>
                                </tr>
                            </table>

                            @if($pengajuan->status == 'pending')
                            <div class="mt-4 d-flex gap-2">
                                <button type="button" 
                                        class="btn btn-success" 
                                        onclick="confirmApprove()">
                                    <i class="fas fa-check"></i> Setujui Pengajuan
                                </button>
                                <button type="button" 
                                        class="btn btn-danger ml-2" 
                                        data-toggle="modal" 
                                        data-target="#rejectModal">
                                    <i class="fas fa-times"></i> Tolak Pengajuan
                                </button>
                            </div>
                            @endif
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
                <img src="{{asset('dist_admin/img/logo.png')}}" alt="">
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

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pengajuan-instansi.reject', $pengajuan->id_pengajuan) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Anda akan menolak pengajuan: <strong>{{ $pengajuan->nama_perusahaan }}</strong></p>
                        <div class="form-group">
                            <label for="keterangan_reject">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea class="form-control" 
                                      id="keterangan_reject" 
                                      name="keterangan_reject" 
                                      rows="3" 
                                      required
                                      placeholder="Contoh: Data tidak lengkap, alamat tidak jelas, dll"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="form-approve" action="{{ route('admin.pengajuan-instansi.approve', $pengajuan->id_pengajuan) }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        function confirmApprove() {
            Swal.fire({
                title: 'Setujui Pengajuan?',
                html: `Anda akan menyetujui pengajuan instansi:<br><strong>{{ $pengajuan->nama_perusahaan }}</strong><br><br><small>Instansi akan dibuat dan siswa akan otomatis ditempatkan</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-approve').submit();
                }
            });
        }
    </script>
</body>
</html>