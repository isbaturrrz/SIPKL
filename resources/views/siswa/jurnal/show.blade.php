<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Jurnal - Siswa</title>
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

        .detail-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .detail-card h5 {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e3e6f0;
            font-size: 1.1rem;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #64748b;
            font-size: 0.9rem;
        }

        .detail-value {
            color: #1e293b;
            font-size: 0.9rem;
            word-wrap: break-word;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-wfo {
            background: #e5e7eb;
            color: #374151;
        }

        .status-wfh {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-sakit {
            background: #fecaca;
            color: #991b1b;
        }

        .status-izin {
            background: #fef3c7;
            color: #92400e;
        }

        .status-libur {
            background: #d1fae5;
            color: #065f46;
        }

        .verif-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .verif-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .verif-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .verif-rejected {
            background: #fecaca;
            color: #991b1b;
        }

        .rejection-alert {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-top: 1rem;
            margin-bottom: 1rem;
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

        #map {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        .foto-kegiatan-container {
            margin-top: 1rem;
            text-align: center;
        }

        .foto-kegiatan-container img {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .foto-kegiatan-container img:hover {
            transform: scale(1.02);
        }

        .foto-kegiatan-label {
            display: block;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .no-foto-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .modal-foto {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-foto-content {
            position: relative;
            margin: auto;
            padding: 20px;
            width: 90%;
            max-width: 900px;
            top: 50%;
            transform: translateY(-50%);
        }

        .modal-foto-content img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .modal-foto-close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10000;
            transition: color 0.3s;
        }

        .modal-foto-close:hover,
        .modal-foto-close:focus {
            color: #f1f5f9;
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
            text-decoration: none;
            margin-right: 8px;
            margin-bottom: 20px;
        }

        .btn-secondary-custom {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary-custom:hover {
            background: #475569;
            color: #fff;
        }

        .btn-edit-custom {
           background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            color: #fff;
        }

        .btn-edit-custom:hover {
            background: #1e4179;
            color: #fff;
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

            .detail-row {
                grid-template-columns: 1fr;
                gap: 0.25rem;
            }

            .detail-label {
                font-weight: 700;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .foto-kegiatan-container img {
                max-width: 100%;
            }

            .modal-foto-content {
                width: 95%;
                padding: 10px;
            }

            .modal-foto-close {
                font-size: 30px;
                top: 5px;
                right: 15px;
            }

            #map {
                height: 300px;
            }
        }

        @media (max-width: 576px) {
            .detail-card {
                padding: 1.5rem;
            }

            .detail-card h5 {
                font-size: 1rem;
            }

            .detail-row {
                padding: 0.5rem 0;
            }

            .detail-label,
            .detail-value {
                font-size: 0.85rem;
            }

            #map {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            .bottom-nav-item {
                font-size: 0.65rem;
            }

            .bottom-nav-item i {
                font-size: 1.1rem;
            }

            .detail-card {
                padding: 1.25rem;
            }

            .btn-action {
                padding: 0.65rem 1.5rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="page-loader">
        <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Detail...</div>
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Detail Jurnal</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="detail-card">
                                <h5>Informasi Jurnal</h5>

                                <div class="detail-row">
                                    <div class="detail-label">Nama Siswa</div>
                                    <div class="detail-value">{{ $siswa->nama }}</div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">Tanggal</div>
                                    <div class="detail-value">{{ $jurnal->tgl->format('d F Y') }}</div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">Status Kehadiran</div>
                                    <div class="detail-value">
                                        <span class="status-badge status-{{ $jurnal->status_kehadiran }}">
                                            {{ strtoupper($jurnal->status_kehadiran) }}
                                        </span>
                                    </div>
                                </div>

                                @if($jurnal->jam_mulai)
                                <div class="detail-row">
                                    <div class="detail-label">Jam Masuk</div>
                                    <div class="detail-value">{{ $jurnal->jam_mulai }}</div>
                                </div>
                                @endif

                                @if($jurnal->jam_selesai)
                                <div class="detail-row">
                                    <div class="detail-label">Jam Pulang</div>
                                    <div class="detail-value">{{ $jurnal->jam_selesai }}</div>
                                </div>
                                @endif

                                <div class="detail-row">
                                    <div class="detail-label">Status Verifikasi</div>
                                    <div class="detail-value">
                                        @if($jurnal->status_verifikasi == 'pending')
                                        <span class="verif-badge verif-pending">Pending</span>
                                        @elseif($jurnal->status_verifikasi == 'verified')
                                        <span class="verif-badge verif-approved">Verified</span>
                                        @else
                                        <span class="verif-badge verif-rejected">Reject</span>
                                        @endif
                                    </div>
                                </div>

                                @if($jurnal->verified_at)
                                <div class="detail-row">
                                    <div class="detail-label">Diverifikasi Pada</div>
                                    <div class="detail-value">{{ $jurnal->verified_at->format('d F Y H:i') }}</div>
                                </div>
                                @endif
                            </div>

                            @if($jurnal->kegiatan || $jurnal->manfaat)
                            <div class="detail-card">
                                <h5>Kegiatan & Manfaat</h5>

                                @if($jurnal->kegiatan)
                                <div class="detail-row">
                                    <div class="detail-label">Kegiatan</div>
                                    <div class="detail-value">{{ $jurnal->kegiatan }}</div>
                                </div>
                                @endif

                                @if($jurnal->manfaat)
                                <div class="detail-row">
                                    <div class="detail-label">Manfaat</div>
                                    <div class="detail-value">{{ $jurnal->manfaat }}</div>
                                </div>
                                @endif
                            </div>
                            @endif

                            @if($jurnal->foto_kegiatan)
                            <div class="detail-card">
                                <h5>Bukti Foto Kegiatan</h5>
                                <div class="foto-kegiatan-container">
                                    <img src="{{ asset('storage/' . $jurnal->foto_kegiatan) }}" 
                                         alt="Foto Kegiatan" 
                                         id="fotoKegiatan"
                                         onclick="openModal()">
                                    <small class="d-block mt-2 text-muted">
                                        <i class="fas fa-info-circle"></i> Klik foto untuk memperbesar
                                    </small>
                                </div>
                            </div>
                            @endif

                            @if($jurnal->status_verifikasi == 'rejected' && $jurnal->keterangan_reject)
                            <div class="rejection-alert">
                                <strong><i class="fas fa-exclamation-circle"></i> Alasan Penolakan</strong>
                                <p>{{ $jurnal->keterangan_reject }}</p>
                            </div>
                            @endif

                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('siswa.jurnal.index') }}" class="btn-action btn-secondary-custom">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                                @if($jurnal->status_verifikasi == 'pending' || $jurnal->status_verifikasi == 'rejected')
                                <a href="{{ route('siswa.jurnal.edit', $jurnal->id_jurnal) }}" class="btn-action btn-edit-custom">
                                    <i class="fas fa-edit"></i>
                                    Edit Jurnal
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            @if($jurnal->latitude && $jurnal->longitude)
                            <div class="detail-card">
                                <h5>Lokasi Presensi</h5>
                                <div id="map"></div>
                                <div class="mt-3">
                                    <div class="detail-row">
                                        <div class="detail-label">Koordinat</div>
                                        <div class="detail-value">{{ $jurnal->latitude }}, {{ $jurnal->longitude }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
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

    <div id="modalFoto" class="modal-foto">
        <span class="modal-foto-close" onclick="closeModal()">&times;</span>
        <div class="modal-foto-content">
            <img src="{{ asset('storage/' . ($jurnal->foto_kegiatan ?? '')) }}" alt="Foto Kegiatan">
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
    
    @if($jurnal->latitude && $jurnal->longitude)
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const lat = {{ $jurnal->latitude }};
        const lng = {{ $jurnal->longitude }};
        
        const map = L.map('map').setView([lat, lng], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        L.marker([lat, lng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(map).bindPopup('<b>Lokasi Presensi</b>').openPopup();
    </script>
    @endif

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

        function openModal() {
            document.getElementById('modalFoto').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalFoto').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalFoto');
            if (event.target == modal) {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>