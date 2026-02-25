<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jurnal Siswa - Guru</title>

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
            background-color: #e8eef7;
            min-height: 100vh;
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
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4) !important;
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

        .swal2-confirm.swal2-confirm-single {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%) !important;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3) !important;
        }

        .swal2-confirm.swal2-confirm-single:hover {
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4) !important;
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

            .swal2-popup {
                width: 90% !important;
                max-width: 380px !important;
            }
        }

        @media (max-width: 576px) {
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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-3 mb-sm-0 text-gray-800">Jurnal Siswa</h1>
                        <a href="{{ route('guru.jurnal.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Jurnal
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Jurnal Terverifikasi
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $jurnalsVerified->total() }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Jurnal Belum Terverifikasi
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $jurnalsUnverified->total() }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Filter Jurnal</h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('guru.jurnal.index') }}">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label>Filter Siswa</label>
                                        <select name="siswa_id" class="form-control">
                                            <option value="">-- Semua Siswa --</option>
                                            @foreach($siswaList as $siswa)
                                            <option value="{{ $siswa->id_siswa }}" {{ request('siswa_id') == $siswa->id_siswa ? 'selected' : '' }}>
                                                {{ $siswa->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Filter Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Filter Bulan</label>
                                        <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                        <a href="{{ route('guru.jurnal.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-sync"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Data Jurnal Siswa (Belum Terverifikasi)</h6>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">Tanggal</th>
                                            <th width="18%">Nama Siswa</th>
                                            <th width="12%">Jam</th>
                                            <th width="10%">Kehadiran</th>
                                            <th width="20%">Kegiatan</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jurnalsUnverified as $index => $jurnal)
                                        <tr>
                                            <td class="text-center">{{ $jurnalsUnverified->firstItem() + $index }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}</td>
                                            <td>{{ $jurnal->siswa->nama }}</td>
                                            <td class="text-center">{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}</td>
                                            <td class="text-center">
                                                @if($jurnal->status_kehadiran == 'wfo')
                                                    <span class="badge badge-success">WFO</span>
                                                @elseif($jurnal->status_kehadiran == 'wfh')
                                                    <span class="badge badge-success">WFH</span>
                                                @elseif($jurnal->status_kehadiran == 'izin')
                                                    <span class="badge badge-warning">Izin</span>
                                                @elseif($jurnal->status_kehadiran == 'sakit')
                                                    <span class="badge badge-info">Sakit</span>
                                                @elseif($jurnal->status_kehadiran == 'libur')
                                                    <span class="badge badge-secondary">Libur</span>
                                                @else
                                                    <span class="badge badge-danger">Alfa</span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($jurnal->kegiatan, 50) }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('guru.jurnal.edit', $jurnal->id_jurnal) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('guru.jurnal.destroy', $jurnal->id_jurnal) }}" method="POST" class="d-inline delete-form"
                                                      data-tanggal="{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}"
                                                      data-siswa="{{ $jurnal->siswa->nama }}"
                                                      data-jam="{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}"
                                                      data-kegiatan="{{ Str::limit($jurnal->kegiatan, 60) }}"
                                                      data-status="Belum Terverifikasi">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="py-4">
                                                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                                                    <p class="text-gray-500">Tidak ada data jurnal yang belum terverifikasi</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Menampilkan {{ $jurnalsUnverified->firstItem() ?? 0 }} - {{ $jurnalsUnverified->lastItem() ?? 0 }} 
                                    dari {{ $jurnalsUnverified->total() }} data
                                </div>
                                <div>
                                    {{ $jurnalsUnverified->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Data Jurnal Siswa (Terverifikasi Pembimbing Instansi)</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">Tanggal</th>
                                            <th width="18%">Nama Siswa</th>
                                            <th width="12%">Jam</th>
                                            <th width="10%">Kehadiran</th>
                                            <th width="18%">Kegiatan</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jurnalsVerified as $index => $jurnal)
                                        <tr>
                                            <td class="text-center">{{ $jurnalsVerified->firstItem() + $index }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}</td>
                                            <td>{{ $jurnal->siswa->nama }}</td>
                                            <td class="text-center">{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}</td>
                                            <td class="text-center">
                                                @if($jurnal->status_kehadiran == 'wfo')
                                                    <span class="badge badge-success">WFO</span>
                                                @elseif($jurnal->status_kehadiran == 'wfh')
                                                    <span class="badge badge-success">WFH</span>
                                                @elseif($jurnal->status_kehadiran == 'izin')
                                                    <span class="badge badge-warning">Izin</span>
                                                @elseif($jurnal->status_kehadiran == 'sakit')
                                                    <span class="badge badge-info">Sakit</span>
                                                @elseif($jurnal->status_kehadiran == 'libur')
                                                    <span class="badge badge-secondary">Libur</span>
                                                @else
                                                    <span class="badge badge-danger">Alfa</span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($jurnal->kegiatan, 50) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('guru.jurnal.show', $jurnal->id_jurnal) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('guru.jurnal.destroy', $jurnal->id_jurnal) }}" method="POST" class="d-inline delete-form"
                                                      data-tanggal="{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}"
                                                      data-siswa="{{ $jurnal->siswa->nama }}"
                                                      data-jam="{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}"
                                                      data-kegiatan="{{ Str::limit($jurnal->kegiatan, 60) }}"
                                                      data-status="Terverifikasi">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div class="py-4">
                                                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                                                    <p class="text-gray-500">Tidak ada data jurnal yang terverifikasi</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Menampilkan {{ $jurnalsVerified->firstItem() ?? 0 }} - {{ $jurnalsVerified->lastItem() ?? 0 }} 
                                    dari {{ $jurnalsVerified->total() }} data
                                </div>
                                <div>
                                    {{ $jurnalsVerified->appends(request()->query())->links() }}
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
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('.delete-form');
                const tanggal = form.getAttribute('data-tanggal');
                const siswa = form.getAttribute('data-siswa');
                const status = form.getAttribute('data-status');

                const confirmHTML = `
                    <div style="padding: 0.5rem 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-book" style="font-size: 1.75rem; color: #dc2626;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Hapus Jurnal</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menghapus jurnal berikut?</p>
                        
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                            <table style="width: 100%; font-size: 0.85rem;">
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Tanggal:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${tanggal}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nama Siswa:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${siswa}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${status}</td>
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
                `;

                Swal.fire({
                    html: confirmHTML,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-trash-alt" style="margin-right: 0.5rem;"></i>Ya, Hapus',
                    cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                    reverseButtons: true,
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

</body>

</html>