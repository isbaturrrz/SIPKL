<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kelola Siswa - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_guru/css/style.css') }}">
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

        .search-box input,
        .search-box select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.3s;
        }

        .search-box input:focus,
        .search-box select:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            border: none;
            color: #fff;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(30, 65, 121, 0.3);
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2c5aa0 0%, #3a6bb5 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.4);
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

        .badge-hadir {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-sakit {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-izin {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-libur {
            background: #e5e7eb;
            color: #374151;
        }

        .badge-alfa {
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
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
        }

        .btn-danger:hover {
            background: #dc2626;
            color: #fff;
            transform: translateY(-1px);
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

        .swal2-popup {
            border-radius: 16px !important;
            padding: 0 !important;
            width: 90% !important;
            max-width: 500px !important;
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

        .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
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
            background: #ef4444 !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            background: #dc2626 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4) !important;
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

        .swal2-input {
            border: 2px solid #e2e8f0 !important;
            border-radius: 8px !important;
            padding: 0.75rem 1rem !important;
            font-size: 0.9rem !important;
            margin: 1rem 0 !important;
        }

        .swal2-input:focus {
            border-color: #2c5aa0 !important;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1) !important;
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

            .container-fluid {
                padding: 1rem 1.5rem;
            }

            .jurnal-table {
                font-size: 0.8rem;
            }

            .jurnal-table thead th,
            .jurnal-table tbody td {
                padding: 0.75rem 0.5rem;
            }

            .swal2-popup {
                width: 92% !important;
                max-width: 450px !important;
            }
        }

        @media (max-width: 576px) {
            .swal2-popup {
                width: 95% !important;
                max-width: 400px !important;
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
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }
        }

        @media (max-width: 400px) {
            .swal2-popup {
                width: 96% !important;
                max-width: 350px !important;
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

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('guru.siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>

            <li class="nav-item">
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

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {!! session('success') !!}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {!! session('error') !!}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="font-weight: 700;">Kelola Siswa</h1>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Unduh Jurnal Siswa</h5>
                        </div>
                        <div style="padding: 1.5rem 2rem;">
                            <form id="downloadForm" method="POST" action="{{ route('guru.siswa.download-pdf') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label style="font-weight: 600; color: #1a1a1a; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Siswa <span class="text-danger">*</span></label>
                                        <div class="search-box">
                                            <select name="siswa" id="siswa" required>
                                                <option value="">--Pilih Siswa--</option>
                                                @foreach($siswaList as $siswa)
                                                <option value="{{ $siswa->id_siswa }}">{{ $siswa->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label style="font-weight: 600; color: #1a1a1a; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Rentang Waktu <span class="text-danger">*</span></label>
                                        <div class="search-box">
                                            <select name="rentang_waktu" id="rentang_waktu" required>
                                                <option value="">--Pilih Bulan--</option>
                                                <option value="semua">Semua Bulan</option>
                                                <option value="januari">Januari</option>
                                                <option value="februari">Februari</option>
                                                <option value="maret">Maret</option>
                                                <option value="april">April</option>
                                                <option value="mei">Mei</option>
                                                <option value="juni">Juni</option>
                                                <option value="juli">Juli</option>
                                                <option value="agustus">Agustus</option>
                                                <option value="september">September</option>
                                                <option value="oktober">Oktober</option>
                                                <option value="november">November</option>
                                                <option value="desember">Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary btn-block" id="downloadBtn">
                                            <i class="fas fa-download"></i> Unduh
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Cari Siswa</h5>
                        </div>
                        <div style="padding: 1.5rem 2rem;">
                            <div class="search-box">
                                <input type="text" id="searchInput" placeholder="Cari siswa...">
                            </div>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Daftar Siswa</h5>
                        </div>

                        <div class="table-responsive">
                            @if($siswaList->count() > 0)
                            <table class="jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Hadir</th>
                                        <th>Sakit</th>
                                        <th>Izin</th>
                                        <th>Libur</th>
                                        <th>Alfa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="siswaTable">
                                    @foreach($siswaList as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->kelas_lengkap }}</td>
                                        <td>
                                            <span class="status-badge badge-hadir">{{ $siswa->hadir }}</span>
                                        </td>
                                        <td>
                                            <span class="status-badge badge-sakit">{{ $siswa->sakit }}</span>
                                        </td>
                                        <td>
                                            <span class="status-badge badge-izin">{{ $siswa->izin }}</span>
                                        </td>
                                        <td>
                                            <span class="status-badge badge-libur">{{ $siswa->libur }}</span>
                                        </td>
                                        <td>
                                            <span class="status-badge badge-alfa">{{ $siswa->alfa }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-action btn-danger" onclick="showDetailModal({{ $siswa->id_siswa }}, '{{ $siswa->nama }}')">
                                                <i class="fas fa-calendar-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h5>Tidak Ada Siswa</h5>
                                <p>Tidak ada siswa yang dibimbing</p>
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

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        async function showDetailModal(siswaId, siswaName) {
            const { value: formValues } = await Swal.fire({
                html: `
                    <div style="padding: 0.5rem 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-user-times" style="font-size: 1.75rem; color: #ef4444;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Tandai Siswa Alfa</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Silakan pilih tanggal ketika siswa bolos/alfa</p>
                        
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left; margin-bottom: 1rem;">
                            <p style="font-size: 0.9rem; color: #64748b; margin: 0;"><strong>Nama Siswa:</strong></p>
                            <p style="font-size: 1rem; color: #1a1a1a; font-weight: 700; margin: 0.25rem 0 0 0;">${siswaName}</p>
                        </div>
                        
                        <div style="text-align: left;">
                            <label style="font-weight: 600; color: #1a1a1a; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">
                                Tanggal Bolos <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="date" id="tanggal" class="swal2-input" max="${new Date().toISOString().split('T')[0]}" style="margin: 0; width: 100%;" required>
                            <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 0.5rem;">
                                <i class="fas fa-info-circle"></i> Pilih tanggal saat siswa bolos/alfa
                            </small>
                        </div>
                        
                        <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 0.75rem 1rem; border-radius: 8px; margin-top: 1rem;">
                            <p style="font-size: 0.85rem; color: #92400e; margin: 0; font-weight: 600;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                Tindakan ini akan menandai siswa sebagai <strong>ALFA</strong> pada tanggal yang dipilih
                            </p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Tandai Alfa',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true,
                preConfirm: () => {
                    const tanggal = document.getElementById('tanggal').value;
                    if (!tanggal) {
                        Swal.showValidationMessage('Tanggal harus diisi!');
                        return false;
                    }
                    return { tanggal: tanggal };
                },
                didOpen: () => {
                    const input = document.getElementById('tanggal');
                    input.focus();
                }
            });

            if (formValues) {
                Swal.fire({
                    html: `
                        <div style="padding: 0.5rem 0;">
                            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-exclamation-triangle" style="font-size: 1.75rem; color: #f59e0b;"></i>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Tandai Alfa</h3>
                            <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menandai siswa sebagai alfa?</p>
                            
                            <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                                <table style="width: 100%; font-size: 0.85rem;">
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Nama Siswa:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${siswaName}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Tanggal:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${new Date(formValues.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                        <td style="padding: 0.4rem 0; color: #ef4444; font-weight: 700;">ALFA</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>Ya, Tandai',
                    cancelButtonText: '<i class="fas fa-times-circle" style="margin-right: 0.5rem;"></i>Batal',
                    reverseButtons: true,
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/guru/siswa/' + siswaId + '/update-status';
                        
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        
                        const tanggalInput = document.createElement('input');
                        tanggalInput.type = 'hidden';
                        tanggalInput.name = 'tanggal';
                        tanggalInput.value = formValues.tanggal;
                        
                        const statusInput = document.createElement('input');
                        statusInput.type = 'hidden';
                        statusInput.name = 'status';
                        statusInput.value = 'alfa';
                        
                        form.appendChild(csrfInput);
                        form.appendChild(tanggalInput);
                        form.appendChild(statusInput);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        }

        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#siswaTable tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#downloadForm').on('submit', function(e) {
            var siswa = $('#siswa').val();
            var rentangWaktu = $('#rentang_waktu').val();

            if (!siswa || !rentangWaktu) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tidak Lengkap',
                    text: 'Silakan pilih siswa dan rentang waktu terlebih dahulu!',
                    confirmButtonText: 'OK'
                });
                return false;
            }
        });

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>

</body>

</html>