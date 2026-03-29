<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Siswa - Admin</title>

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

        .btn-warning {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100%);
            border: none;
            color: #fff;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #2c5aa0 0%, #3a6bb5 100%);
            color: #fff;
        }

        .card-header {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100%);
        }

        .card-header h6 {
            color: white !important;
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

        .detail-label {
            font-weight: 600;
            color: #4e73df;
            margin-bottom: 5px;
        }
        .detail-value {
            color: #5a5c69;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fc;
            border-radius: 5px;
        }
        .section-title {
            border-bottom: 2px solid #4e73df;
            padding-bottom: 10px;
            margin-bottom: 20px;
            margin-top: 30px;
        }
        .badge-custom {
            font-size: 0.9rem;
            padding: 8px 15px;
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

            <li class="nav-item active">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600">
                                    Halo {{ Auth::user()->name }}
                                </span>                             
                            </a>                         
                        </li>
                        @endauth
                    </ul>
                </nav>

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pribadi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">NIPD</div>
                                            <div class="detail-value">{{ $siswa->nipd }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Nama Lengkap</div>
                                            <div class="detail-value">{{ $siswa->nama }}</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">Tempat Lahir</div>
                                            <div class="detail-value">{{ $siswa->tempat_lahir }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Tanggal Lahir</div>
                                            <div class="detail-value">
                                                {{ $siswa->tgl_lahir ? $siswa->tgl_lahir->format('d F Y') : '-' }}
                                                @if($siswa->tgl_lahir)
                                                    <span class="text-muted">({{ $siswa->tgl_lahir->age }} tahun)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">No HP</div>
                                            <div class="detail-value">
                                                <i class="text-success"></i> {{ $siswa->no_hp }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Kelas</div>
                                            <div class="detail-value">
                                                <span class="badge badge-primary badge-custom">
                                                    {{ $siswa->kelas }} {{ $siswa->jurusan }} {{ $siswa->rombel }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="detail-label">Alamat</div>
                                            <div class="detail-value">
                                                <i class="text-danger"></i> {{ $siswa->alamat }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi PKL</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="detail-label">Status Penempatan</div>
                                            <div class="detail-value">
                                                @if($siswa->status_penempatan == 'sudah')
                                                    <span class="badge badge-success badge-custom">
                                                        <i class="fas fa-check-circle"></i> Sudah Ditempatkan
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning badge-custom">
                                                        <i class="fas fa-clock"></i> Belum Ditempatkan
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if($siswa->instansi)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="detail-label">Instansi PKL</div>
                                            <div class="detail-value">
                                                <i class="text-primary"></i> 
                                                {{ $siswa->instansi->nama_instansi }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="detail-label">Alamat Instansi</div>
                                            <div class="detail-value">
                                                <i class="text-danger"></i> 
                                                {{ $siswa->instansi->alamat ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($siswa->guru)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">Guru Pembimbing</div>
                                            <div class="detail-value">
                                                <i class="text-info"></i> 
                                                {{ $siswa->guru->nama }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">No HP Guru</div>
                                            <div class="detail-value">
                                                <i class="text-success"></i> 
                                                {{ $siswa->guru->no_hp ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">Tanggal Mulai PKL</div>
                                            <div class="detail-value">
                                                @if($siswa->tanggal_mulai)
                                                    <i class="text-success"></i> 
                                                    {{ $siswa->tanggal_mulai->format('d F Y') }}
                                                @else
                                                    <span class="text-muted">Belum ditentukan</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Tanggal Selesai PKL</div>
                                            <div class="detail-value">
                                                @if($siswa->tanggal_selesai)
                                                    <i class="text-danger"></i> 
                                                    {{ $siswa->tanggal_selesai->format('d F Y') }}
                                                @else
                                                    <span class="text-muted">Belum ditentukan</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if($siswa->tanggal_mulai && $siswa->tanggal_selesai)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="detail-label">Durasi PKL</div>
                                            <div class="detail-value">
                                                <i class="text-warning"></i> 
                                                {{ $siswa->tanggal_mulai->diffInDays($siswa->tanggal_selesai) }} hari
                                                ({{ round($siswa->tanggal_mulai->diffInDays($siswa->tanggal_selesai) / 30, 1) }} bulan)
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <div class="mb-3">
                                            <i class="fas fa-user-circle fa-5x text-dark"></i>
                                        </div>
                                        <h5 class="font-weight-bold">{{ $siswa->nama }}</h5>
                                        <p class="text-muted mb-2">{{ $siswa->nipd }}</p>
                                        <span class="badge badge-primary badge-custom">
                                            {{ $siswa->kelas }} {{ $siswa->jurusan }} {{ $siswa->rombel }}
                                        </span>
                                    </div>

                                    <hr>

                                    <h6 class="font-weight-bold text-dark mb-3">Informasi Kontak</h6>
                                    <p class="mb-2">
                                        <i class="fas fa-phone text-success"></i>
                                        <small class="ml-2">{{ $siswa->no_hp }}</small>
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-envelope text-info"></i>
                                        <small class="ml-2">{{ $siswa->user->email ?? '-' }}</small>
                                    </p>

                                    <hr>

                                    <h6 class="font-weight-bold text-dark mb-3">Status PKL</h6>
                                    @if($siswa->instansi)
                                        <div class="alert alert-success">
                                            <i class="fas fa-check-circle"></i> 
                                            <strong>Sudah Ditempatkan</strong>
                                            <p class="mb-0 mt-2 small">{{ $siswa->instansi->nama_instansi }}</p>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> 
                                            <strong>Belum Ditempatkan</strong>
                                        </div>
                                    @endif

                                    @if($siswa->guru)
                                    <hr>
                                    <h6 class="font-weight-bold text-dark mb-3">Pembimbing</h6>
                                    <div class="alert alert-info">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        <strong>{{ $siswa->guru->nama }}</strong>
                                        <p class="mb-0 mt-2 small">
                                            <i class="fas fa-phone"></i> {{ $siswa->guru->no_hp ?? '-' }}
                                        </p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}" 
                                       class="btn btn-warning btn-block mb-2">
                                        <i class="fas fa-edit"></i> Edit Data
                                    </a>
                                    <form action="{{ route('admin.siswa.destroy', $siswa->id_siswa) }}" 
                                          method="POST"
                                          id="deleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-block" id="deleteBtn">
                                            <i class="fas fa-trash"></i> Hapus Data
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.siswa.index', $siswa->id_siswa) }}" 
                                       class="btn btn-secondary btn-block mt-2">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
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

        document.getElementById('deleteBtn').addEventListener('click', function() {
            const nama = "{{ $siswa->nama }}";
            const nipd = "{{ $siswa->nipd }}";
            const kelas = "{{ $siswa->kelas }} {{ $siswa->jurusan }} {{ $siswa->rombel }}";

            Swal.fire({
                html: `
                    <div style="padding: 0.5rem 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-user-graduate" style="font-size: 1.75rem; color: #dc2626;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Hapus Siswa</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menghapus data siswa berikut?</p>
                        
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                            <table style="width: 100%; font-size: 0.85rem;">
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 30%;">Nama:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nama}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">NIPD:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nipd}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Kelas:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kelas}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                            <p style="font-size: 0.8rem; color: #991b1b; margin: 0; font-weight: 600;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                Data yang dihapus tidak dapat dikembalikan
                            </p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-trash-alt" style="margin-right: 0.5rem;"></i>Ya, Hapus',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        });
    </script>
</body>
</html>