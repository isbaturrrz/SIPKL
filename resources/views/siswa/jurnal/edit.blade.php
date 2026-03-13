<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Jurnal - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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

        .form-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .form-card h6 {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .radio-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 0.75rem;
        }

        .radio-item input[type="radio"] {
            display: none;
        }

        .radio-item label {
            display: block;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            color: #64748b;
        }

        .radio-item input[type="radio"]:checked + label {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%);
            color: #fff;
            border-color: #1e4179;
        }

        .radio-item label:hover {
            border-color: #2c5aa0;
        }

        .time-input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .map-container {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        #map {
            width: 100%;
            height: 350px;
            background: #f1f5f9;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            z-index: 1;
        }

        .location-info {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .location-info p {
            margin: 0;
            font-size: 0.85rem;
            color: #475569;
        }

        .location-info strong {
            color: #1e293b;
        }

        .radius-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #10b981;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .radius-badge.danger {
            background: #ef4444;
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8fafc;
            position: relative;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .upload-area:hover {
            border-color: #2c5aa0;
            background: #f1f5f9;
        }

        .upload-area.dragover {
            border-color: #2c5aa0;
            background: #e0e7ff;
        }

        .upload-placeholder i {
            font-size: 3rem;
            color: #94a3b8;
            margin-bottom: 1rem;
        }

        .upload-placeholder p {
            font-weight: 600;
            color: #475569;
            font-size: 0.95rem;
        }

        .image-preview {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .image-preview img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ef4444;
            color: #fff;
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        .btn-remove-image:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s;
            border: none;
            margin-right: 8px; 
            margin-bottom: 20px;
        }

        .btn-primary-custom {
           background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            color: #fff;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4);
            color: #fff;
        }

        .btn-secondary-custom {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary-custom:hover {
            background: #475569;
            color: #fff;
        }

        .field-disabled {
            opacity: 0.6;
            pointer-events: none;
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            z-index: 10;
        }

        .rejection-alert {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .rejection-alert strong {
            color: #991b1b;
            display: block;
            margin-bottom: 0.5rem;
        }

        .rejection-alert p {
            color: #7f1d1d;
            margin: 0;
        }

        .current-photo {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .current-photo img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

        .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }

        .swal2-icon .swal2-icon-content {
            font-size: 2.5rem !important;
        }

        .swal2-title {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #1a1a1a !important;
            padding: 0 1.5rem !important;
            margin-bottom: 0.75rem !important;
            line-height: 1.3 !important;
        }

        .swal2-html-container {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            font-size: 0.9rem !important;
            color: #64748b !important;
            line-height: 1.5 !important;
        }

        .swal2-actions {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            gap: 0.75rem !important;
            display: flex !important;
            width: 100% !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%) !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4) !important;
        }

        .swal2-cancel {
            background: #fff !important;
            color: #64748b !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: 2px solid #e2e8f0 !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-cancel:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #475569 !important;
        }

        .swal2-styled:focus {
            box-shadow: none !important;
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

        .more-menu-item.active {
            background: #f1f5f9;
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
                padding: 1rem 1rem 5rem 1rem !important;
            }

            .sticky-footer {
                display: none;
            }

            .time-input-group {
                grid-template-columns: 1fr;
            }

            .radio-group {
                grid-template-columns: 1fr 1fr;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .swal2-popup {
                width: 90% !important;
                max-width: 380px !important;
            }

            #map {
                height: 300px;
            }

            .upload-area {
                padding: 1.5rem;
                min-height: 180px;
            }

            .upload-placeholder i {
                font-size: 2.5rem;
            }

            .image-preview img {
                max-height: 250px;
            }
        }

        @media (max-width: 576px) {
            .form-card {
                padding: 1.5rem;
            }

            .swal2-popup {
                width: 92% !important;
                max-width: 340px !important;
            }
            
            .swal2-icon {
                width: 56px !important;
                height: 56px !important;
                margin: 1.25rem auto 0.75rem !important;
            }
            
            .swal2-title {
                font-size: 1.1rem !important;
                padding: 0 1rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .swal2-html-container {
                padding: 0 1rem 1.25rem !important;
                font-size: 0.85rem !important;
            }
            
            .swal2-actions {
                padding: 0 1rem 1.25rem !important;
                gap: 0.5rem !important;
            }
            
            .swal2-confirm,
            .swal2-cancel {
                padding: 0.6rem 1.25rem !important;
                font-size: 0.85rem !important;
            }
        }

        @media (max-width: 480px) {
            .bottom-nav-item {
                font-size: 0.65rem;
            }

            .bottom-nav-item i {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 400px) {
            .swal2-popup {
                width: 95% !important;
                max-width: 300px !important;
            }
            
            .swal2-icon {
                width: 48px !important;
                height: 48px !important;
                margin: 1rem auto 0.5rem !important;
            }
            
            .swal2-title {
                font-size: 1rem !important;
                padding: 0 0.75rem !important;
            }
            
            .swal2-html-container {
                padding: 0 0.75rem 1rem !important;
                font-size: 0.8rem !important;
            }
            
            .swal2-actions {
                padding: 0 0.75rem 1rem !important;
                flex-direction: column !important;
                gap: 0.5rem !important;
            }
            
            .swal2-confirm,
            .swal2-cancel {
                padding: 0.55rem 1rem !important;
                font-size: 0.8rem !important;
                width: 100% !important;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="page-loader">
        <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Editor...</div>
    </div>

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

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('siswa.jurnal.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.leaderboard.index') }}">
                    <i class="fas fa-trophy"></i>
                    <span>Leaderboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('siswa.nilai.index')}}">
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Edit Jurnal</h1>
                            <p class="text-muted mb-0">Nama: <strong>{{ $siswa->nama }}</strong></p>
                        </div>
                    </div>

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($jurnal->status_verifikasi == 'rejected' && $jurnal->keterangan_reject)
                    <div class="rejection-alert">
                        <strong><i class="fas fa-exclamation-circle"></i> Alasan Penolakan</strong>
                        <p>{{ $jurnal->keterangan_reject }}</p>
                    </div>
                    @endif

                    <form action="{{ route('siswa.jurnal.update', $jurnal->id_jurnal) }}" method="POST" id="jurnalForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-card">
                                    <h6>Presensi Harian</h6>

                                    <div class="mb-3">
                                        <label class="form-label">Tanggal<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $jurnal->tgl->format('d F Y') }}" readonly disabled>
                                        <input type="hidden" name="tgl" value="{{ $jurnal->tgl->format('Y-m-d') }}">
                                        <small class="text-muted">Tanggal tidak dapat diubah</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status Kehadiran<span class="text-danger">*</span></label>
                                        <div class="radio-group">
                                            <div class="radio-item">
                                                <input type="radio" id="wfo" name="status_kehadiran" value="wfo" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'wfo' ? 'checked' : '' }} required>
                                                <label for="wfo">WFO</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="wfh" name="status_kehadiran" value="wfh" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'wfh' ? 'checked' : '' }}>
                                                <label for="wfh">WFH</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="sakit" name="status_kehadiran" value="sakit" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'sakit' ? 'checked' : '' }}>
                                                <label for="sakit">Sakit</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="izin" name="status_kehadiran" value="izin" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'izin' ? 'checked' : '' }}>
                                                <label for="izin">Izin</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="libur" name="status_kehadiran" value="libur" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'libur' ? 'checked' : '' }}>
                                                <label for="libur">Libur</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="jamContainer">
                                        <div class="time-input-group">
                                            <div>
                                                <label class="form-label">Jam Masuk</label>
                                                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', $jurnal->jam_mulai ? substr($jurnal->jam_mulai, 0, 5) : '') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">Jam Pulang</label>
                                                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', $jurnal->jam_selesai ? substr($jurnal->jam_selesai, 0, 5) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-card" id="kegiatanCard">
                                    <h6>Kegiatan yang Dilakukan :</h6>
                                    <textarea class="form-control" name="kegiatan" id="kegiatan" placeholder="Tuliskan kegiatan yang dilakukan hari ini...">{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
                                </div>

                                <div class="form-card" id="manfaatCard">
                                    <h6>Manfaat yang Didapat :</h6>
                                    <textarea class="form-control" name="manfaat" id="manfaat" placeholder="Tuliskan manfaat yang didapat...">{{ old('manfaat', $jurnal->manfaat) }}</textarea>
                                </div>

                                <div class="form-card" id="fotoCard">
                                    <h6>Bukti Foto Kegiatan</h6>
                                    
                                    @if($jurnal->foto_kegiatan)
                                    <div class="current-photo">
                                        <p class="text-muted mb-2"><strong>Foto Saat Ini:</strong></p>
                                        <img src="{{ asset('storage/' . $jurnal->foto_kegiatan) }}" alt="Foto Kegiatan">
                                        <p class="text-muted mt-2 mb-0"><small>Upload foto baru untuk mengganti</small></p>
                                    </div>
                                    @endif

                                    <div class="upload-area" id="uploadArea">
                                        <input type="file" name="foto_kegiatan" id="foto_kegiatan" accept="image/jpeg,image/jpg,image/png" hidden>
                                        <div class="upload-placeholder" id="uploadPlaceholder">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p class="mb-1">Klik atau drag foto ke sini</p>
                                            <small class="text-muted">Format: JPG, JPEG, PNG (Max 2MB)</small>
                                        </div>
                                        <div class="image-preview" id="imagePreview" style="display: none;">
                                            <img id="previewImage" src="" alt="Preview">
                                            <button type="button" class="btn-remove-image" id="removeImage">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="fileError" class="text-danger mt-2" style="display: none; font-size: 0.85rem;"></div>
                                </div>

                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('siswa.jurnal.index') }}" class="btn-action btn-secondary-custom">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                    <button type="button" id="btnUpdate" class="btn-action btn-primary-custom">
                                        <i class="fas fa-save"></i>
                                        Update
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="map-container" id="mapContainer">
                                    <h6 class="font-weight-bold mb-3">Tempat PKL</h6>
                                    <h5 class="text-primary font-weight-bold mb-2">{{ $siswa->instansi->nama_instansi ?? 'Belum ada instansi' }}</h5>
                                    <p class="text-muted mb-3">Lokasi Anda Saat Ini:</p>
                                    
                                    <div style="position: relative;">
                                        <div id="map"></div>
                                        <div id="mapLoading" class="loading-overlay" style="display: none;">
                                            <div class="text-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <p class="mt-2 mb-0">Mengambil lokasi...</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="location-info">
                                        <p><strong>Alamat Instansi:</strong> {{ $siswa->instansi->alamat ?? '-' }}</p>
                                        <p class="mt-2"><strong>Koordinat Anda:</strong> <span id="coordinates">{{ $jurnal->latitude }}, {{ $jurnal->longitude }}</span></p>
                                        <p class="mt-2"><strong>Jarak dari Instansi:</strong> <span id="distance">-</span></p>
                                        <div class="mt-2">
                                            <span class="radius-badge" id="radiusBadge">
                                                <i class="fas fa-spinner fa-spin"></i>
                                                Memuat lokasi...
                                            </span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $jurnal->latitude) }}">
                                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $jurnal->longitude) }}">
                                </div>
                            </div>
                        </div>
                    </form>
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

    <div class="more-menu-overlay" id="moreMenuOverlay"></div>
    <div class="more-menu" id="moreMenu">
        <a href="{{ route('siswa.jurnal.index') }}" class="more-menu-item active">
            <i class="fas fa-history"></i>
            <span>Riwayat Jurnal</span>
        </a>
        <a href="{{ route('siswa.nilai.index') }}" class="more-menu-item">
            <i class="fas fa-download"></i>
            <span>Unduh Nilai</span>
        </a>
        <a href="{{ route('siswa.instansi.index') }}" class="more-menu-item">
            <i class="fas fa-building"></i>
            <span>Pilih Instansi</span>
        </a>
        <a href="#" class="more-menu-item" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <nav class="bottom-nav">
        <div class="bottom-nav-container">
            <a href="{{ route('siswa.dashboard') }}" class="bottom-nav-item">
                <i class="fas fa-th-large"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('siswa.jurnal.create') }}" class="bottom-nav-item">
                <i class="fas fa-pen-square"></i>
                <span>Jurnal</span>
            </a>
            <a href="{{ route('siswa.leaderboard.index') }}" class="bottom-nav-item">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/gps-helper.js') }}"></script>

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

        let map;
        let userMarker;
        let instansiMarker;
        let radiusCircle;
        let watchId = null;
        
        const instansiLat = {{ $siswa->instansi->latitude ?? 0 }};
        const instansiLng = {{ $siswa->instansi->longitude ?? 0 }};
        const MAX_DISTANCE = 100;

        function initMap() {
            const defaultLat = {{ $jurnal->latitude ?? ($siswa->instansi->latitude ?? -6.9175) }};
            const defaultLng = {{ $jurnal->longitude ?? ($siswa->instansi->longitude ?? 107.6191) }};
            
            map = L.map('map').setView([defaultLat, defaultLng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            if (instansiLat && instansiLng) {
                instansiMarker = L.marker([instansiLat, instansiLng], {
                    icon: L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    })
                }).addTo(map);
                instansiMarker.bindPopup('<b>{{ $siswa->instansi->nama_instansi ?? "Instansi PKL" }}</b>');

                radiusCircle = L.circle([instansiLat, instansiLng], {
                    color: '#2c5aa0',
                    fillColor: '#2c5aa0',
                    fillOpacity: 0.1,
                    radius: MAX_DISTANCE
                }).addTo(map);
            }

            @if($jurnal->latitude && $jurnal->longitude)
            updateUserLocation({{ $jurnal->latitude }}, {{ $jurnal->longitude }});
            @endif
        }

        async function getUserLocation() {
            const mapLoading = document.getElementById('mapLoading');
            mapLoading.style.display = 'flex';

            try {
                const position = await GPSHelper.getCurrentPosition();
                updateUserLocation(position.latitude, position.longitude);
                mapLoading.style.display = 'none';
            } catch (error) {
                console.error('Error getting location:', error);
                alert(error.message + '. Pastikan lokasi/GPS aktif dan izin diberikan.');
                mapLoading.style.display = 'none';
            }
        }

        function updateUserLocation(lat, lng) {
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('coordinates').textContent = lat.toFixed(6) + ', ' + lng.toFixed(6);

            if (userMarker) {
                map.removeLayer(userMarker);
            }

            userMarker = L.marker([lat, lng], {
                icon: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }).addTo(map);
            userMarker.bindPopup('<b>Lokasi Anda</b>');

            map.setView([lat, lng], 16);

            if (instansiLat && instansiLng) {
                const result = GPSHelper.checkRadius(lat, lng, instansiLat, instansiLng, MAX_DISTANCE);
                
                document.getElementById('distance').textContent = result.distance + ' meter';
                
                const badge = document.getElementById('radiusBadge');
                badge.className = 'radius-badge';
                
                if (result.isWithinRadius) {
                    badge.innerHTML = '<i class="fas fa-check-circle"></i> Dalam Radius ('+result.distance+' m)';
                } else {
                    badge.classList.add('danger');
                    badge.innerHTML = '<i class="fas fa-times-circle"></i> Di Luar Radius ('+result.distance+' m)';
                }
            }
        }

        function initializePhotoUpload() {
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('foto_kegiatan');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            const removeImage = document.getElementById('removeImage');
            const fileError = document.getElementById('fileError');

            uploadArea.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove-image')) return;
                fileInput.click();
            });

            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelect(files[0]);
                }
            });

            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    handleFileSelect(e.target.files[0]);
                }
            });

            removeImage.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                uploadPlaceholder.style.display = 'block';
                imagePreview.style.display = 'none';
                previewImage.src = '';
                fileError.style.display = 'none';
            });

            function handleFileSelect(file) {
                fileError.style.display = 'none';

                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    fileError.textContent = 'Format file tidak valid. Gunakan JPG, JPEG, atau PNG';
                    fileError.style.display = 'block';
                    fileInput.value = '';
                    return;
                }

                const maxSize = 2 * 1024 * 1024;
                if (file.size > maxSize) {
                    fileError.textContent = 'Ukuran file terlalu besar. Maksimal 2MB';
                    fileError.style.display = 'block';
                    fileInput.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    uploadPlaceholder.style.display = 'none';
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function toggleFields() {
            const status = $('input[name="status_kehadiran"]:checked').val();
            
            const jamContainer = $('#jamContainer');
            const jamMulai = $('#jam_mulai');
            const jamSelesai = $('#jam_selesai');
            const kegiatanCard = $('#kegiatanCard');
            const manfaatCard = $('#manfaatCard');
            const fotoCard = $('#fotoCard');
            const mapContainer = $('#mapContainer');
            const kegiatanField = $('#kegiatan');
            const manfaatField = $('#manfaat');
            
            jamContainer.removeClass('field-disabled');
            kegiatanCard.removeClass('field-disabled');
            manfaatCard.removeClass('field-disabled');
            fotoCard.removeClass('field-disabled');
            mapContainer.removeClass('field-disabled');
            
            if (status === 'wfo') {
                jamMulai.prop('required', true);
                jamSelesai.prop('required', true);
                kegiatanField.prop('required', true);
                manfaatField.prop('required', true);
                mapContainer.removeClass('field-disabled');
                getUserLocation();
            } 
            else if (status === 'wfh') {
                jamMulai.prop('required', true);
                jamSelesai.prop('required', true);
                kegiatanField.prop('required', true);
                manfaatField.prop('required', true);
                mapContainer.addClass('field-disabled');
                
                if (watchId !== null) {
                    GPSHelper.clearWatch(watchId);
                    watchId = null;
                }
            } 
            else if (status === 'izin') {
                jamMulai.prop('required', false);
                jamSelesai.prop('required', false);
                kegiatanField.prop('required', true);
                manfaatField.prop('required', false);
                
                jamContainer.addClass('field-disabled');
                kegiatanCard.removeClass('field-disabled');
                manfaatCard.addClass('field-disabled');
                fotoCard.addClass('field-disabled');
                mapContainer.addClass('field-disabled');
                
                if (watchId !== null) {
                    GPSHelper.clearWatch(watchId);
                    watchId = null;
                }
            }
            else {
                jamMulai.prop('required', false);
                jamSelesai.prop('required', false);
                kegiatanField.prop('required', false);
                manfaatField.prop('required', false);
                
                jamContainer.addClass('field-disabled');
                kegiatanCard.addClass('field-disabled');
                manfaatCard.addClass('field-disabled');
                fotoCard.addClass('field-disabled');
                mapContainer.addClass('field-disabled');
                
                if (watchId !== null) {
                    GPSHelper.clearWatch(watchId);
                    watchId = null;
                }
            }
        }

        function getStatusLabel(status) {
            const statusLabels = {
                'wfo': 'WFO',
                'wfh': 'WFH',
                'sakit': 'Sakit',
                'izin': 'Izin',
                'libur': 'Libur'
            };
            return statusLabels[status] || status;
        }

        $(document).ready(function() {
            initMap();
            initializePhotoUpload();

            $('input[name="status_kehadiran"]').on('change', toggleFields);
            
            const initialStatus = $('input[name="status_kehadiran"]:checked').val();
            toggleFields();

            $('#btnUpdate').on('click', function(e) {
                e.preventDefault();
                
                const status = $('input[name="status_kehadiran"]:checked').val();
                const tanggal = "{{ $jurnal->tgl->format('d/m/Y') }}";
                const jamMulai = $('#jam_mulai').val();
                const jamSelesai = $('#jam_selesai').val();
                const kegiatan = $('#kegiatan').val();

                if (status === 'wfo') {
                    const lat = parseFloat($('#latitude').val());
                    const lng = parseFloat($('#longitude').val());
                    
                    if (!lat || !lng) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lokasi Belum Terdeteksi',
                            text: 'Lokasi GPS belum terdeteksi. Harap tunggu atau refresh halaman.',
                            confirmButtonText: 'OK',
                            buttonsStyling: true
                        });
                        return false;
                    }
                    
                    if (instansiLat && instansiLng) {
                        const result = GPSHelper.checkRadius(lat, lng, instansiLat, instansiLng, MAX_DISTANCE);
                        
                        if (!result.isWithinRadius) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Di Luar Radius',
                                text: 'Anda berada di luar radius instansi PKL ('+result.distance+' meter). Maksimal '+MAX_DISTANCE+' meter.',
                                confirmButtonText: 'OK',
                                buttonsStyling: true
                            });
                            return false;
                        }
                    }
                }

                const confirmHTML = `
                    <div style="padding: 0.5rem 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-edit" style="font-size: 1.75rem; color: #f59e0b;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Update Jurnal</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin mengupdate jurnal berikut?</p>
                        
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                            <table style="width: 100%; font-size: 0.85rem;">
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Tanggal:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${tanggal}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${getStatusLabel(status)}</td>
                                </tr>
                                ${(status === 'wfo' || status === 'wfh') ? `
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Jam:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${jamMulai} - ${jamSelesai}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Kegiatan:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kegiatan.substring(0, 40)}${kegiatan.length > 40 ? '...' : ''}</td>
                                </tr>
                                ` : ''}
                            </table>
                        </div>
                        
                        <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                            <p style="font-size: 0.8rem; color: #92400e; margin: 0; font-weight: 600;">
                                <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                                Data jurnal akan diperbarui
                            </p>
                        </div>
                    </div>
                `;

                Swal.fire({
                    html: confirmHTML,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-save" style="margin-right: 0.5rem;"></i>Ya, Update',
                    cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                    reverseButtons: true,
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#jurnalForm').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>