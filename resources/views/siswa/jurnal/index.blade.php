<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Jurnal - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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

        .search-box button {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            background: #1e4179;
            border: none;
            color: #fff;
            padding: 0 1.25rem;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-box button:hover {
            background: #2c5aa0;
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
            background: linear-gradient(135deg, #2c5aa0 0%, #1e4179 100%);
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
            text-transform: uppercase;
        }

        .status-wfo {
            background: #d1fae5;
            color: #065f46;
        }

        .status-wfh {
            background: #d1fae5;
            color: #065f46    ;
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
        }

        .btn-view {
            background: #4f46e5;
            color: #fff;
        }

        .btn-view:hover {
            background: #4338ca;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-edit {
            background: #f59e0b;
            color: #fff;
        }

        .btn-edit:hover {
            background: #d97706;
            color: #fff;
            transform: translateY(-1px);
        }

        .pagination-wrapper {
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination-btn {
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
        }

        .pagination-btn:hover {
            border-color: #2c5aa0;
            color: #2c5aa0;
            background: #f8fafc;
        }

        .pagination-btn.active {
            background: #2c5aa0;
            color: #fff;
            border-color: #2c5aa0;
        }

        .pagination-btn.disabled {
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
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-card">
                        <div class="table-header d-flex justify-content-between align-items-center">
                            <h5>Riwayat Jurnal</h5>
                            <div class="search-box">
                                <form action="{{ route('siswa.jurnal.index') }}" method="GET">
                                    <input type="text" name="search" placeholder="Cari Tanggal..." value="{{ request('search') }}">
                                    <button type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            @if($jurnal->count() > 0)
                            <table class="table-striped jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Kehadiran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jurnal as $index => $item)
                                    <tr>
                                        <td>{{ $jurnal->firstItem() + $index }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $item->tgl->format('d M Y') }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $item->status_kehadiran }}">
                                                {{ strtoupper($item->status_kehadiran) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->status_verifikasi == 'pending')
                                            <span class="verif-badge verif-pending">Pending</span>
                                            @elseif($item->status_verifikasi == 'verified')
                                            <span class="verif-badge verif-approved">Verified</span>
                                            @else
                                            <span class="verif-badge verif-rejected">Reject</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('siswa.jurnal.show', $item->id_jurnal) }}" class="btn-action btn-view">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($item->status_verifikasi == 'pending')
                                            <a href="{{ route('siswa.jurnal.edit', $item->id_jurnal) }}" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="empty-state">
                                <i class="fas fa-clipboard-list"></i>
                                <h5>Belum Ada Jurnal</h5>
                                <p>Anda belum memiliki riwayat jurnal. Mulai catat jurnal Anda sekarang!</p>
                            </div>
                            @endif
                        </div>

                        @if($jurnal->hasPages())
                        <div class="pagination-wrapper">
                            @if($jurnal->onFirstPage())
                            <span class="pagination-btn disabled">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            @else
                            <a href="{{ $jurnal->previousPageUrl() }}" class="pagination-btn">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            @endif

                            @foreach($jurnal->getUrlRange(1, $jurnal->lastPage()) as $page => $url)
                            <a href="{{ $url }}" class="pagination-btn {{ $page == $jurnal->currentPage() ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                            @endforeach

                            @if($jurnal->hasMorePages())
                            <a href="{{ $jurnal->nextPageUrl() }}" class="pagination-btn">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            @else
                            <span class="pagination-btn disabled">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Tabel Jurnal Ditolak</h5>
                        </div>

                        <div class="table-responsive">
                            @if($jurnalRejected->count() > 0)
                            <table class="jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Kehadiran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jurnalRejected as $index => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $item->tgl->format('d M Y') }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $item->status_kehadiran }}">
                                                {{ strtoupper($item->status_kehadiran) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="verif-badge verif-rejected">Reject</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('siswa.jurnal.show', $item->id_jurnal) }}" class="btn-action btn-view">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('siswa.jurnal.edit', $item->id_jurnal) }}" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="empty-state">
                                <i class="fas fa-check-circle"></i>
                                <h5>Tidak Ada Jurnal Ditolak</h5>
                                <p>Semua jurnal Anda telah disetujui atau masih dalam proses verifikasi.</p>
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

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>