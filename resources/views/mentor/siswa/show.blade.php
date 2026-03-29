<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Siswa - Mentor</title>

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

        #content {
            background-color: #e8eef7;
            min-height: 100vh;
        }

        .topbar {
            background-color: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .table-card {
            background: #fff;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e3e6f0;
        }

        .table-header h5 {
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            font-size: 1.1rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .jurnal-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .jurnal-table thead {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
        }

        .jurnal-table thead th {
            color: #fff;
            font-weight: 700;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            border: none;
        }

        .jurnal-table tbody tr {
            border-bottom: 1px solid #e3e6f0;
            transition: all 0.2s;
        }

        .jurnal-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .jurnal-table tbody td {
            padding: 1rem;
            text-align: center;
            font-size: 0.9rem;
            color: #334155;
            vertical-align: middle;
        }

        .jurnal-table tbody td:first-child {
            font-weight: 600;
            color: #1a1a1a;
        }

        .stat-card {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
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

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-wfo {
            background: #d1fae5;
            color: #065f46;
        }

        .status-wfh {
            background: #d1fae5;
            color: #065f46;
        }

        .status-sakit {
            background: #fecaca;
            color: #991b1b;
        }

        .status-izin {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-libur {
            background: #e5e7eb;
            color: #374151;
        }

        .status-alfa {
            background: #fee2e2;
            color: #b91c1c;
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

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            color: #64748b;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .btn-back-custom {
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
            background: #64748b;
            color: #fff;
        }

        .btn-back-custom:hover {
            background: #475569;
            color: #fff;
            text-decoration: none;
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

            .jurnal-table {
                font-size: 0.8rem;
            }

            .jurnal-table thead th,
            .jurnal-table tbody td {
                padding: 0.75rem 0.5rem;
            }

            .btn-back-custom {
                width: 100%;
                justify-content: center;
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
        }
    </style>
</head>

<body id="page-top">
    <div id="page-loader">
        <img src="{{ asset('dist_mentor/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Detail...</div>
    </div>

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('mentor.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_mentor/img/logo.png')}}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item active">
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-card">
                                <div class="table-header">
                                    <h5>Data Siswa</h5>
                                </div>
                                <div style="padding: 1.5rem 2rem;">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="font-weight-bold">Nama Lengkap</td>
                                            <td>: {{ $siswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="font-weight-bold">NIPD</td>
                                            <td>: {{ $siswa->nipd ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Tempat, Tanggal Lahir</td>
                                            <td>: {{ $siswa->tempat_lahir ?? '-' }}@if($siswa->tgl_lahir), {{ $siswa->tgl_lahir->format('d M Y') }}@endif</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Kelas</td>
                                            <td>: {{ $siswa->kelas_lengkap ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Jurusan</td>
                                            <td>: <span>{{ $siswa->jurusan_lengkap ?? '-' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">No HP</td>
                                            <td>: {{ $siswa->no_hp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Alamat</td>
                                            <td>: {{ $siswa->alamat ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="table-card">
                                <div class="table-header">
                                    <h5>Data Prakerin</h5>
                                </div>
                                <div style="padding: 1.5rem 2rem;">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td width="40%" class="font-weight-bold">Instansi</td>
                                            <td>: {{ $siswa->instansi->nama_instansi ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Alamat Instansi</td>
                                            <td>: {{ $siswa->instansi->alamat ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Guru Pembimbing</td>
                                            <td>: {{ $siswa->guru->nama ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">No HP Guru</td>
                                            <td>: {{ $siswa->guru->no_hp ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Periode PKL</td>
                                            <td>:
                                                @if($siswa->tanggal_mulai && $siswa->tanggal_selesai)
                                                    {{ \Carbon\Carbon::parse($siswa->tanggal_mulai)->format('d M Y') }} -
                                                    {{ \Carbon\Carbon::parse($siswa->tanggal_selesai)->format('d M Y') }}
                                                @else
                                                    <span>Belum diatur</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Status Penempatan</td>
                                            <td>:
                                                @if($siswa->status_penempatan == 'ditempatkan')
                                                    <span class="badge badge-success">Ditempatkan</span>
                                                @elseif($siswa->status_penempatan == 'belum_ditempatkan')
                                                    <span class="badge badge-warning">Belum Ditempatkan</span>
                                                @else
                                                    <span>{{ $siswa->status_penempatan ?? '-' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-card">
                                <div class="table-header">
                                    <h5>Statistik Kehadiran</h5>
                                </div>
                                <div style="padding: 1.5rem 2rem;">
                                    <div class="stat-breakdown mb-4">
                                        <div class="stat-item">
                                            <i class="fas fa-check-circle" style="color: #1dd1a1; font-size: 20px;"></i>
                                            <div class="stat-item-label">Hadir</div>
                                            <div class="stat-item-value">{{ $siswa->total_jurnal_hadir }}</div>
                                        </div>
                                        <div class="stat-item">
                                            <i class="fas fa-clipboard-list" style="color: #f6c23e; font-size: 20px;"></i>
                                            <div class="stat-item-label">Izin</div>
                                            <div class="stat-item-value">{{ $siswa->total_jurnal_izin }}</div>
                                        </div>
                                        <div class="stat-item">
                                            <i class="fas fa-thermometer" style="color: #667eea; font-size: 20px;"></i>
                                            <div class="stat-item-label">Sakit</div>
                                            <div class="stat-item-value">{{ $siswa->total_jurnal_sakit }}</div>
                                        </div>
                                        <div class="stat-item">
                                            <i class="fas fa-times-circle" style="color: #e74a3b; font-size: 20px;"></i>
                                            <div class="stat-item-label">Alfa</div>
                                            <div class="stat-item-value">{{ $siswa->total_jurnal_alfa }}</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 mb-3">
                                            <div class="stat-card">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <div class="stat-label">Presentasi Kehadiran</div>
                                                        <div class="stat-value">{{ $siswa->persentase_kehadiran }}%</div>
                                                    </div>
                                                    <div class="stat-icon">
                                                        <i class="fas fa-percentage"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 mb-3">
                                            <div class="stat-card">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <div class="stat-label">Predikat</div>
                                                        <div class="stat-value">{{ $siswa->predikat }}</div>
                                                    </div>
                                                    <div class="stat-icon">
                                                        <i class="fas fa-medal"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 mb-3">
                                            <div class="stat-card">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <div class="stat-label">Total Jurnal</div>
                                                        <div class="stat-value">{{ $siswa->total_jurnal_all }}</div>
                                                    </div>
                                                    <div class="stat-icon">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-card">
                                <div class="table-header">
                                    <h5>Jurnal Terbaru (10 Terakhir)</h5>
                                </div>
                                <div class="table-responsive">
                                    @if(count($recentJurnal) > 0)
                                    <table class="jurnal-table">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Kehadiran</th>
                                                <th>Status Verifikasi</th>
                                                <th>Kegiatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentJurnal as $jurnal)
                                            <tr>
                                                <td>{{ $jurnal->tgl ? $jurnal->tgl->format('d M Y') : '-' }}</td>
                                                <td>{{ $jurnal->jam_mulai ?? '-' }} - {{ $jurnal->jam_selesai ?? '-' }}</td>
                                                <td>
                                                    @if($jurnal->status_kehadiran == 'wfo')
                                                        <span class="status-badge status-wfo">WFO</span>
                                                    @elseif($jurnal->status_kehadiran == 'wfh')
                                                        <span class="status-badge status-wfh">WFH</span>
                                                    @elseif($jurnal->status_kehadiran == 'izin')
                                                        <span class="status-badge status-izin">Izin</span>
                                                    @elseif($jurnal->status_kehadiran == 'sakit')
                                                        <span class="status-badge status-sakit">Sakit</span>
                                                    @elseif($jurnal->status_kehadiran == 'libur')
                                                        <span class="status-badge status-libur">Libur</span>
                                                    @else
                                                        <span class="status-badge status-alfa">Alfa</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($jurnal->status_verifikasi == 'verified')
                                                        <span class="verif-badge verif-approved">Verified</span>
                                                    @elseif($jurnal->status_verifikasi == 'pending')
                                                        <span class="verif-badge verif-pending">Pending</span>
                                                    @else
                                                        <span class="verif-badge verif-rejected">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Str::limit($jurnal->kegiatan ?? '-', 50) }}</td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h5>Belum Ada Jurnal</h5>
                                        <p>Siswa ini belum memiliki riwayat jurnal.</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="text-center mb-4">
                                <a href="{{ route('mentor.siswa.index') }}" class="btn-back-custom">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Siswa
                                </a>
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
            <a href="{{ route('mentor.dashboard') }}" class="bottom-nav-item">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('mentor.siswa.index') }}" class="bottom-nav-item active">
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
    </script>
</body>
</html>