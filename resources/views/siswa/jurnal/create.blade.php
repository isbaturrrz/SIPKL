<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Catat Jurnal - Siswa</title>
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

        .time-badge {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-block;
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

        .radio-item {
            flex: none;
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

        .radius-badge.warning {
            background: #f59e0b;
        }

        .radius-badge.danger {
            background: #ef4444;
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
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%);
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

        .alert-custom {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.25rem;
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

        .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark {
            display: block !important;
        }

        .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
            display: block !important;
            position: absolute !important;
            height: 3px !important;
            width: 30px !important;
            background-color: #ef4444 !important;
            border-radius: 2px !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark-line-left {
            top: 28px !important;
            left: 15px !important;
            transform: rotate(45deg) !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark-line-right {
            top: 28px !important;
            right: 15px !important;
            transform: rotate(-45deg) !important;
        }

        .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }

        .swal2-icon.swal2-info {
            border-color: #3b82f6 !important;
            color: #3b82f6 !important;
        }

        .swal2-icon.swal2-success {
            border-color: #10b981 !important;
        }

        .swal2-icon.swal2-success [class^='swal2-success-line'] {
            background-color: #10b981 !important;
        }

        .swal2-icon.swal2-success .swal2-success-ring {
            border-color: rgba(16, 185, 129, 0.3) !important;
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
        }

        @media (max-width: 576px) {
            .radio-group {
                grid-template-columns: 1fr 1fr;
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

            .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
                width: 26px !important;
            }

            .swal2-icon.swal2-error .swal2-x-mark-line-left {
                top: 26px !important;
                left: 13px !important;
            }

            .swal2-icon.swal2-error .swal2-x-mark-line-right {
                top: 26px !important;
                right: 13px !important;
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
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
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

            .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
                width: 22px !important;
            }

            .swal2-icon.swal2-error .swal2-x-mark-line-left {
                top: 22px !important;
                left: 11px !important;
            }

            .swal2-icon.swal2-error .swal2-x-mark-line-right {
                top: 22px !important;
                right: 11px !important;
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

            <li class="nav-item active">
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
                            <span class="time-badge" id="currentTime">08:30 WIB</span>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">

                    @if(session('error'))
                    <div class="alert alert-danger alert-custom">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success alert-custom">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-custom">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('siswa.jurnal.store') }}" method="POST" id="jurnalForm">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-card">
                                    <h6>Presensi Harian</h6>

                                    <div class="mb-3">
                                        <label class="form-label">Tanggal<span class="text-danger">*</span></label>
                                        <input 
                                            type="date" 
                                            class="form-control" 
                                            name="tgl" 
                                            id="tgl"
                                            value="{{ old('tgl', date('Y-m-d')) }}" 
                                            min="{{ date('Y-m-d', strtotime('-1 day')) }}"
                                            max="{{ date('Y-m-d') }}"
                                            required>
                                        <small class="text-muted">Hanya bisa memilih hari ini atau kemarin</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status Kehadiran<span class="text-danger">*</span></label>
                                        <div class="radio-group">
                                            <div class="radio-item">
                                                <input type="radio" id="wfo" name="status_kehadiran" value="wfo" {{ old('status_kehadiran', 'wfo') == 'wfo' ? 'checked' : '' }} required>
                                                <label for="wfo">WFO</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="wfh" name="status_kehadiran" value="wfh" {{ old('status_kehadiran') == 'wfh' ? 'checked' : '' }}>
                                                <label for="wfh">WFH</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="sakit" name="status_kehadiran" value="sakit" {{ old('status_kehadiran') == 'sakit' ? 'checked' : '' }}>
                                                <label for="sakit">Sakit</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="izin" name="status_kehadiran" value="izin" {{ old('status_kehadiran') == 'izin' ? 'checked' : '' }}>
                                                <label for="izin">Izin</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="libur" name="status_kehadiran" value="libur" {{ old('status_kehadiran') == 'libur' ? 'checked' : '' }}>
                                                <label for="libur">Libur</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="jamContainer">
                                        <div class="time-input-group">
                                            <div>
                                                <label class="form-label">Jam Masuk</label>
                                                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">Jam Pulang</label>
                                                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-card" id="kegiatanCard">
                                    <h6>Kegiatan yang Dilakukan :</h6>
                                    <textarea class="form-control" name="kegiatan" id="kegiatan" placeholder="Tuliskan kegiatan yang dilakukan hari ini...">{{ old('kegiatan') }}</textarea>
                                </div>

                                <div class="form-card" id="manfaatCard">
                                    <h6>Manfaat yang Didapat :</h6>
                                    <textarea class="form-control" name="manfaat" id="manfaat" placeholder="Tuliskan manfaat yang didapat...">{{ old('manfaat') }}</textarea>
                                </div>

                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary-custom btn-action">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                    <button type="button" class="btn btn-primary-custom btn-action" id="submitBtn" onclick="confirmSubmitJurnal()">
                                        <i class="fas fa-save"></i>
                                        Simpan
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
                                        <p class="mt-2"><strong>Koordinat Anda:</strong> <span id="coordinates">Menunggu lokasi...</span></p>
                                        <p class="mt-2"><strong>Jarak dari Instansi:</strong> <span id="distance">-</span></p>
                                        <div class="mt-2">
                                            <span class="radius-badge" id="radiusBadge">
                                                <i class="fas fa-spinner fa-spin"></i>
                                                Memuat lokasi...
                                            </span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
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

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/gps-helper.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let map;
        let userMarker;
        let instansiMarker;
        let radiusCircle;
        let watchId = null;
        let locationPermissionGranted = false;
        
        const instansiLat = {{ $siswa->instansi->latitude ?? 0 }};
        const instansiLng = {{ $siswa->instansi->longitude ?? 0 }};
        const MAX_DISTANCE = 100;

        function showValidationAlert(title, message, icon = 'warning') {
            Swal.fire({
                icon: icon,
                title: title,
                html: `<p style="color: #64748b; margin: 0;">${message}</p>`,
                confirmButtonText: '<i class="fas fa-check"></i> Mengerti',
                buttonsStyling: true
            });
        }

        function showLocationPermissionAlert() {
            Swal.fire({
                icon: 'info',
                title: 'Izin Akses Lokasi',
                html: `
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; color: #2c5aa0; margin: 1rem 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <p style="color: #64748b; margin: 0;">
                            Aplikasi memerlukan akses lokasi untuk memverifikasi kehadiran di tempat PKL.
                        </p>
                        <p style="color: #475569; margin-top: 1rem; font-weight: 600; font-size: 0.85rem;">
                            Silakan izinkan akses lokasi pada browser Anda.
                        </p>
                    </div>
                `,
                confirmButtonText: '<i class="fas fa-check"></i> Mengerti',
                allowOutsideClick: false,
                buttonsStyling: true
            });
        }

        function showLocationLoadingAlert() {
            Swal.fire({
                title: 'Mengambil Lokasi',
                html: `
                    <div style="text-align: center; padding: 1rem 0;">
                        <div style="font-size: 3rem; color: #2c5aa0; margin-bottom: 1rem;">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                        <p style="color: #64748b; margin: 0;">
                            Mohon tunggu, sedang mendapatkan lokasi Anda...
                        </p>
                    </div>
                `,
                showConfirmButton: false,
                allowOutsideClick: false,
                buttonsStyling: true
            });
        }

        function confirmSubmitJurnal() {
            const status = document.querySelector('input[name="status_kehadiran"]:checked')?.value;
            const tanggal = document.getElementById('tgl').value;
            const jamMulai = document.getElementById('jam_mulai').value;
            const jamSelesai = document.getElementById('jam_selesai').value;
            const kegiatan = document.getElementById('kegiatan').value.trim();
            const manfaat = document.getElementById('manfaat').value.trim();

            if (!status) {
                showValidationAlert('Status Kehadiran Belum Dipilih', 'Silakan pilih status kehadiran terlebih dahulu.');
                return;
            }

            if (status === 'wfo' || status === 'wfh') {
                if (!jamMulai || !jamSelesai) {
                    showValidationAlert('Data Tidak Lengkap', 'Jam masuk dan jam pulang harus diisi untuk status WFO/WFH.');
                    return;
                }
                if (!kegiatan || !manfaat) {
                    showValidationAlert('Data Tidak Lengkap', 'Kegiatan dan manfaat harus diisi untuk status WFO/WFH.');
                    return;
                }
            }

            if (status === 'wfo') {
                const lat = parseFloat(document.getElementById('latitude').value);
                const lng = parseFloat(document.getElementById('longitude').value);
                
                if (!lat || !lng) {
                    showValidationAlert('Lokasi Belum Terdeteksi', 'Lokasi GPS belum terdeteksi. Harap tunggu sebentar atau refresh halaman.', 'error');
                    return;
                }
                
                if (instansiLat && instansiLng) {
                    const result = GPSHelper.checkRadius(lat, lng, instansiLat, instansiLng, MAX_DISTANCE);
                    
                    if (!result.isWithinRadius) {
                        showValidationAlert('Di Luar Radius', 'Anda berada di luar radius instansi PKL ('+result.distance+' meter). Maksimal '+MAX_DISTANCE+' meter.', 'error');
                        return;
                    }
                }
            }

            const statusLabel = {
                'wfo': 'WFO (Work From Office)',
                'wfh': 'WFH (Work From Home)',
                'sakit': 'Sakit',
                'izin': 'Izin',
                'libur': 'Libur'
            };

            let summaryHTML = `
                <div style="padding: 0.5rem 0;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #e8eef7 0%, #d1dce8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-pen-square" style="font-size: 1.75rem; color: #1e4179;"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Jurnal</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Periksa kembali data jurnal Anda:</p>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                        <table style="width: 100%; font-size: 0.85rem;">
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Tanggal:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${tanggal}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                <td style="padding: 0.4rem 0; color: #1e4179; font-weight: 700;">${statusLabel[status]}</td>
                            </tr>`;

            if (status === 'wfo' || status === 'wfh') {
                summaryHTML += `
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Jam:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${jamMulai} - ${jamSelesai}</td>
                            </tr>`;
            }

            summaryHTML += `
                        </table>
                    </div>
                    
                    <div style="background: #dbeafe; border-left: 4px solid #3b82f6; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                        <p style="font-size: 0.8rem; color: #1e40af; margin: 0; font-weight: 600;">
                            <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                            Data yang sudah disimpan tidak dapat diubah
                        </p>
                    </div>
                </div>
            `;

            Swal.fire({
                html: summaryHTML,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>Ya, Simpan',
                cancelButtonText: '<i class="fas fa-times-circle" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('jurnalForm').submit();
                }
            });
        }

        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('currentTime').textContent = h + ':' + m + ' WIB';
        }
        updateClock();
        setInterval(updateClock, 1000);

        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function initializeDateInput() {
            const dateInput = document.getElementById('tgl');
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            
            const todayStr = formatDate(today);
            const yesterdayStr = formatDate(yesterday);
            
            dateInput.setAttribute('min', yesterdayStr);
            dateInput.setAttribute('max', todayStr);
            
            dateInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const minDate = new Date(yesterdayStr);
                const maxDate = new Date(todayStr);
                
                if (selectedDate < minDate || selectedDate > maxDate) {
                    showValidationAlert('Tanggal Tidak Valid', 'Tanggal hanya bisa dipilih hari ini atau kemarin.');
                    this.value = todayStr;
                }
            });
        }

        function initMap() {
            const defaultLat = instansiLat || -6.9175;
            const defaultLng = instansiLng || 107.6191;
            
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
                instansiMarker.bindPopup('<b>{{ $siswa->instansi->nama_instansi ?? "Instansi PKL" }}</b>').openPopup();

                radiusCircle = L.circle([instansiLat, instansiLng], {
                    color: '#2c5aa0',
                    fillColor: '#2c5aa0',
                    fillOpacity: 0.1,
                    radius: MAX_DISTANCE
                }).addTo(map);
            }
        }

        async function getUserLocation() {
            const mapLoading = document.getElementById('mapLoading');
            
            if (!locationPermissionGranted) {
                showLocationPermissionAlert();
            }
            
            mapLoading.style.display = 'flex';

            try {
                const position = await GPSHelper.getCurrentPosition();
                locationPermissionGranted = true;
                updateUserLocation(position.latitude, position.longitude);
                mapLoading.style.display = 'none';
                Swal.close();
            } catch (error) {
                console.error('Error getting location:', error);
                mapLoading.style.display = 'none';
                showValidationAlert('Gagal Mengambil Lokasi', error.message + '. Pastikan lokasi/GPS aktif dan izin diberikan.', 'error');
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
                    badge.classList.add('');
                    badge.innerHTML = '<i class="fas fa-check-circle"></i> Dalam Radius ('+result.distance+' m)';
                } else {
                    badge.classList.add('danger');
                    badge.innerHTML = '<i class="fas fa-times-circle"></i> Di Luar Radius ('+result.distance+' m)';
                }
            }
        }

        function toggleFields() {
            const status = $('input[name="status_kehadiran"]:checked').val();
            
            const jamContainer = $('#jamContainer');
            const jamMulai = $('#jam_mulai');
            const jamSelesai = $('#jam_selesai');
            const kegiatanCard = $('#kegiatanCard');
            const manfaatCard = $('#manfaatCard');
            const mapContainer = $('#mapContainer');
            const kegiatanField = $('#kegiatan');
            const manfaatField = $('#manfaat');
            
            jamContainer.removeClass('field-disabled');
            kegiatanCard.removeClass('field-disabled');
            manfaatCard.removeClass('field-disabled');
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
            else {
                jamMulai.prop('required', false);
                jamSelesai.prop('required', false);
                kegiatanField.prop('required', false);
                manfaatField.prop('required', false);
                
                jamContainer.addClass('field-disabled');
                kegiatanCard.addClass('field-disabled');
                manfaatCard.addClass('field-disabled');
                mapContainer.addClass('field-disabled');
                
                if (watchId !== null) {
                    GPSHelper.clearWatch(watchId);
                    watchId = null;
                }
            }
        }

        $(document).ready(function() {
            initializeDateInput();
            initMap();

            $('input[name="status_kehadiran"]').on('change', toggleFields);
            
            const initialStatus = $('input[name="status_kehadiran"]:checked').val();
            if (initialStatus === 'wfo') {
                getUserLocation();
            } else {
                toggleFields();
            }
        });
    </script>
</body>
</html>