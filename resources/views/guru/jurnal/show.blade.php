<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detail Jurnal - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_guru/css/style.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #182151 0%, #3F7FB6 50%, #010B40 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        #page-loader .loader-logo {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
            animation: pulse 2s ease-in-out infinite;
        }

        #page-loader .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top: 4px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        #page-loader .loader-text {
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Nunito', sans-serif;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(0.95); }
        }

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
            background-color: #f8f9fc;
            min-height: 100vh;
        }

        .detail-card {
            border: none;
            border-radius: 8px;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .detail-header {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: 600;
            width: 150px;
            flex-shrink: 0;
        }

        .info-value {
            flex-grow: 1;
        }

        .section-divider {
            border-top: 2px dashed #e3e6f0;
            margin: 20px 0;
        }

        .textarea-detail {
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-radius: 5px;
            padding: 15px;
            min-height: 100px;
            width: 100%;
        }

        .foto-kegiatan-box {
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin-top: 10px;
        }

        .foto-kegiatan-box img {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .foto-kegiatan-box img:hover {
            transform: scale(1.02);
        }

        .foto-kegiatan-box small {
            display: block;
            margin-top: 10px;
            color: #6c757d;
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

        #map {
            width: 100%;
            height: 350px;
            border-radius: 8px;
            border: 1px solid #d1d3e2;
            margin-top: 15px;
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
            margin-bottom: 8px;
        }

        .btn-secondary-custom {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary-custom:hover {
            background: #475569;
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

        .bottom-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            text-decoration: none;
            color: #64748b;
            transition: all 0.3s ease;
            position: relative;
        }

        .bottom-nav-item i {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .bottom-nav-item span {
            font-size: 0.7rem;
            font-weight: 600;
        }

        .bottom-nav-item.active {
            color: #182151;
        }

        .more-menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .more-menu-overlay.show {
            display: block;
            opacity: 1;
        }

        .more-menu {
            position: fixed;
            bottom: 70px;
            right: 1rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            z-index: 1050;
            min-width: 200px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .more-menu.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .more-menu-item {
            padding: 0.875rem 1.25rem;
            display: flex;
            align-items: center;
            color: #333;
            text-decoration: none;
            transition: background 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .more-menu-item:first-child {
            border-radius: 12px 12px 0 0;
        }

        .more-menu-item:last-child {
            border-bottom: none;
            border-radius: 0 0 12px 12px;
        }

        .more-menu-item:hover {
            background: #f8f9fa;
        }

        .more-menu-item i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            color: #182151;
        }

        .more-menu-item span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            #wrapper #content-wrapper {
                margin-left: 0 !important;
            }

            .sidebar {
                display: none !important;
            }

            .topbar {
                display: none !important;
            }

            #content {
                margin-top: 0 !important;
            }

            .container-fluid {
                padding: 1rem 1rem 5rem 1rem !important;
            }

            .bottom-nav {
                display: flex;
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

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .foto-kegiatan-box img {
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
        }

        @media (max-width: 480px) {
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }
        }
    </style>
</head>

<body id="page-top">

    <div id="page-loader">
        <img src="{{ asset('dist_guru/img/logo.png') }}" alt="Logo" class="loader-logo">
        <div class="spinner"></div>
        <div class="loader-text">Memuat Detail...</div>
    </div>

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guru.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_guru/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('guru.jurnal.index') }}">
                    <i class="fas fa-book"></i>
                    <span>Jurnal Siswa</span>
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

                    <div class="detail-card">
                        <div class="detail-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1 font-weight-bold">Detail Jurnal Siswa</h5>
                                    <small>{{ \Carbon\Carbon::parse($jurnal->tgl)->isoFormat('dddd, D MMMM Y') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-row">
                                    <div class="info-label">Nama Siswa</div>
                                    <div class="info-value">: {{ $jurnal->siswa->nama }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-row">
                                    <div class="info-label">NIPD</div>
                                    <div class="info-value">: {{ $jurnal->siswa->nipd ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-row">
                                    <div class="info-label">Kelas</div>
                                    <div class="info-value">: {{ $jurnal->siswa->kelas_lengkap ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-row">
                                    <div class="info-label">Instansi PKL</div>
                                    <div class="info-value">: {{ $jurnal->siswa->instansi->nama_instansi ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($jurnal->tgl)->isoFormat('dddd, D MMMM Y') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Status Kehadiran</label>
                                <div class="form-control font-weight-bold">
                                    @if($jurnal->status_kehadiran == 'wfo')
                                        <span>WFO</span>
                                    @elseif($jurnal->status_kehadiran == 'wfh')
                                        <span>WFH</span>
                                    @elseif($jurnal->status_kehadiran == 'izin')
                                        <span>Izin</span>
                                    @elseif($jurnal->status_kehadiran == 'sakit')
                                        <span>Sakit</span>
                                    @elseif($jurnal->status_kehadiran == 'libur')
                                        <span>Libur</span>
                                    @else
                                        <span>Alfa</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Jam Mulai</label>
                                <input type="text" class="form-control" value="{{ $jurnal->jam_mulai ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Jam Selesai</label>
                                <input type="text" class="form-control" value="{{ $jurnal->jam_selesai ?? '-' }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Kegiatan yang Dilakukan :</label>
                            <div class="textarea-detail">
                                {{ $jurnal->kegiatan ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Manfaat yang Didapat :</label>
                            <div class="textarea-detail">
                                {{ $jurnal->manfaat ?? '-' }}
                            </div>
                        </div>

                        @if($jurnal->foto_kegiatan)
                        <div class="mb-3">
                            <label class="font-weight-bold">Bukti Foto Kegiatan :</label>
                            <div class="foto-kegiatan-box">
                                <img src="{{ asset('storage/' . $jurnal->foto_kegiatan) }}" 
                                     alt="Foto Kegiatan" 
                                     onclick="openModal()">
                                <small>
                                    <i class="fas fa-info-circle"></i> Klik foto untuk memperbesar
                                </small>
                            </div>
                        </div>
                        @endif

                        @if($jurnal->latitude && $jurnal->longitude)
                        <div class="mb-4">
                            <label class="font-weight-bold">Lokasi Presensi :</label>
                            <div id="map"></div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> Koordinat: {{ $jurnal->latitude }}, {{ $jurnal->longitude }}
                                </small>
                            </div>
                        </div>
                        @endif

                        <div class="section-divider"></div>

                        <div class="card border-left-success shadow mb-3">
                            <div class="card-body">
                                <h6 class="font-weight-bold mb-3">
                                    <i class="fas fa-check-circle"></i> Status Verifikasi
                                </h6>
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <td width="30%" class="font-weight-bold">Status</td>
                                        <td>: 
                                            @if($jurnal->status_verifikasi == 'verified')
                                                <span class="badge badge-success badge-lg">
                                                    <i class="fas fa-check-circle"></i> Terverifikasi
                                                </span>
                                            @elseif($jurnal->status_verifikasi == 'rejected')
                                                <span class="badge badge-danger badge-lg">
                                                    <i class="fas fa-times-circle"></i> Ditolak
                                                </span>
                                            @else
                                                <span class="badge badge-warning badge-lg">
                                                    <i class="fas fa-hourglass-half"></i> Menunggu
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Diinput Oleh</td>
                                        <td>:
                                            @if($jurnal->input_by == 'siswa')
                                                <span>
                                                    Siswa
                                                </span>
                                            @else
                                                <span>
                                                    Guru
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($jurnal->status_verifikasi == 'verified')
                                    <tr>
                                        <td class="font-weight-bold">Diverifikasi Oleh</td>
                                        <td>:
                                            @if(!$jurnal->verifiedBy)
                                                Guru Pembimbing
                                            @elseif($jurnal->verifiedBy->role == 'mentor')
                                                {{ $jurnal->verifiedBy->name }}
                                            @else
                                                Guru Pembimbing
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Waktu Verifikasi</td>
                                        <td>: {{ $jurnal->verified_at ? \Carbon\Carbon::parse($jurnal->verified_at)->isoFormat('D MMMM Y, HH:mm') : '-' }}</td>
                                    </tr>
                                    @endif
                                    @if($jurnal->status_verifikasi == 'rejected' && $jurnal->keterangan_reject)
                                    <tr>
                                        <td colspan="2">
                                            <div class="alert alert-danger mt-2 mb-0">
                                                <strong>Keterangan Penolakan:</strong><br>
                                                <i class="fas fa-exclamation-triangle"></i> 
                                                {{ $jurnal->keterangan_reject }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('guru.jurnal.index') }}" class="btn-action btn-secondary-custom">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Jurnal
                            </a>
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
        <a href="#" class="more-menu-item" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <nav class="bottom-nav">
        <a href="{{ route('guru.dashboard') }}" class="bottom-nav-item">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('guru.siswa.index') }}" class="bottom-nav-item">
            <i class="fas fa-users"></i>
            <span>Kelola Siswa</span>
        </a>
        <a href="{{ route('guru.jurnal.index') }}" class="bottom-nav-item active">
            <i class="fas fa-book"></i>
            <span>Jurnal</span>
        </a>
        <a href="#" class="bottom-nav-item" id="moreBtn">
            <i class="fas fa-ellipsis-h"></i>
            <span>Lainnya</span>
        </a>
    </nav>

    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div id="modalFoto" class="modal-foto">
        <span class="modal-foto-close" onclick="closeModal()">&times;</span>
        <div class="modal-foto-content">
            <img src="{{ asset('storage/' . ($jurnal->foto_kegiatan ?? '')) }}" alt="Foto Kegiatan">
        </div>
    </div>
    
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

        document.getElementById('moreBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('moreMenu').classList.toggle('show');
            document.getElementById('moreMenuOverlay').classList.toggle('show');
        });

        document.getElementById('moreMenuOverlay').addEventListener('click', function() {
            document.getElementById('moreMenu').classList.remove('show');
            document.getElementById('moreMenuOverlay').classList.remove('show');
        });

        document.querySelectorAll('.more-menu-item').forEach(function(item) {
            item.addEventListener('click', function() {
                document.getElementById('moreMenu').classList.remove('show');
                document.getElementById('moreMenuOverlay').classList.remove('show');
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