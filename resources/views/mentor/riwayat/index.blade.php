<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Riwayat Jurnal - Mentor</title>

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

        .search-box {
            position: relative;
            max-width: 350px;
        }

        .search-box input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            padding-right: 3rem;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.3s;
        }

        .search-box input:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
            outline: none;
        }

        .search-box select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.3s;
        }

        .search-box select:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
            outline: none;
        }

        .search-box button {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            border: none;
            color: #fff;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .search-box button:hover {
            background: #2c5aa0;
        }

        .btn-reset {
            background: #6c757d;
            border: none;
            color: #fff;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-reset:hover {
            background: #5a6268;
            color: #fff;
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
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
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

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin: 0 0.15rem;
        }

        .btn-info {
            background: #4f46e5;
            color: #fff;
        }

        .btn-info:hover {
            background: #4338ca;
            color: #fff;
            transform: translateY(-1px);
        }

        .pagination-wrapper {
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            margin: 0;
        }

        .page-item .page-link {
            width: 40px;
            height: 40px;
            border: 2px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            padding: 0;
        }

        .page-item .page-link:hover {
            border-color: #2c5aa0;
            color: #2c5aa0;
            background: #f8fafc;
        }

        .page-item.active .page-link {
            background: #2c5aa0;
            color: #fff;
            border-color: #2c5aa0;
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
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

            .table-header {
                flex-direction: column;
                gap: 1rem;
            }

            .search-box {
                max-width: 100%;
            }

            .jurnal-table {
                font-size: 0.8rem;
            }

            .jurnal-table thead th,
            .jurnal-table tbody td {
                padding: 0.75rem 0.5rem;
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
                    <i class="fas fa-fw fa-tachometer-alt"></i>
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

            <li class="nav-item active">
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="font-weight: 700;">Riwayat Jurnal</h1>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Filter Riwayat Jurnal</h5>
                        </div>
                        <div style="padding: 1.5rem 2rem;">
                            <form method="GET" action="{{ route('mentor.riwayat.index') }}">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="search-box" style="max-width: 100%;">
                                            <input type="text" name="search" placeholder="Cari nama siswa..." value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="search-box" style="max-width: 100%;">
                                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #64748b; font-size: 0.9rem;">Filter Tanggal</label>
                                            <input type="date" name="tanggal" value="{{ request('tanggal') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="search-box" style="max-width: 100%;">
                                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #64748b; font-size: 0.9rem;">Status Kehadiran</label>
                                            <select name="kehadiran">
                                                <option value="">-- Semua Status --</option>
                                                <option value="wfo" {{ request('kehadiran') == 'wfo' ? 'selected' : '' }}>WFO</option>
                                                <option value="wfh" {{ request('kehadiran') == 'wfh' ? 'selected' : '' }}>WFH</option>
                                                <option value="izin" {{ request('kehadiran') == 'izin' ? 'selected' : '' }}>Izin</option>
                                                <option value="sakit" {{ request('kehadiran') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                <option value="libur" {{ request('kehadiran') == 'libur' ? 'selected' : '' }}>Libur</option>
                                                <option value="alfa" {{ request('kehadiran') == 'alfa' ? 'selected' : '' }}>Alfa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="search-box" style="max-width: 100%; display: flex; gap: 0.75rem;">
                                            <button type="submit">
                                                <i class="fas fa-search"></i> Cari
                                            </button>
                                            <a href="{{ route('mentor.riwayat.index') }}" class="btn-reset">
                                                <i class="fas fa-sync"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Riwayat Jurnal Terverifikasi</h5>
                        </div>

                        <div class="table-responsive">
                            @if($jurnal->count() > 0)
                            <table class="jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal</th>
                                        <th>Kehadiran</th>
                                        <th>Diverifikasi Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jurnal as $index => $item)
                                    <tr>
                                        <td>{{ $jurnal->firstItem() + $index }}</td>
                                        <td>{{ $item->siswa->nama ?? '-' }}</td>
                                        <td>{{ $item->tgl ? $item->tgl->format('d M Y') : '-' }}</td>
                                        <td>
                                            @if($item->status_kehadiran == 'wfo')
                                                <span class="status-badge badge-success">WFO</span>
                                            @elseif($item->status_kehadiran == 'wfh')
                                                <span class="status-badge badge-success">WFH</span>
                                            @elseif($item->status_kehadiran == 'izin')
                                                <span class="status-badge badge-warning">Izin</span>
                                            @elseif($item->status_kehadiran == 'sakit')
                                                <span class="status-badge badge-info">Sakit</span>
                                            @elseif($item->status_kehadiran == 'libur')
                                                <span class="status-badge badge-secondary">Libur</span>
                                            @else
                                                <span class="status-badge badge-danger">Alfa</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$item->verifiedBy)
                                                Guru Pembimbing
                                            @elseif($item->verifiedBy->role)
                                                {{ $item->verifiedBy->name }}
                                            @else
                                                Guru Pembimbing
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('mentor.riwayat.show', $item->id_jurnal) }}" class="btn-action btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h5>Tidak Ada Riwayat Jurnal</h5>
                                <p>Tidak ada riwayat jurnal yang tersedia</p>
                            </div>
                            @endif
                        </div>

                        @if($jurnal->hasPages())
                        <div class="pagination-wrapper">
                            <div class="pagination-info">
                                Menampilkan {{ $jurnal->firstItem() ?? 0 }} - {{ $jurnal->lastItem() ?? 0 }} dari {{ $jurnal->total() }} data
                            </div>
                            <div class="pagination">
                                @if($jurnal->onFirstPage())
                                <span class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </span>
                                @else
                                <span class="page-item">
                                    <a href="{{ $jurnal->previousPageUrl() }}" class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </span>
                                @endif

                                @foreach($jurnal->getUrlRange(1, $jurnal->lastPage()) as $page => $url)
                                <span class="page-item {{ $page == $jurnal->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </span>
                                @endforeach

                                @if($jurnal->hasMorePages())
                                <span class="page-item">
                                    <a href="{{ $jurnal->nextPageUrl() }}" class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </span>
                                @else
                                <span class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
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
   
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
</body>
</html>