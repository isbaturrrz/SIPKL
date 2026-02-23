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
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_admin/img/')}}" alt="">
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

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
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

                <!-- Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Data Siswa</h1>
                        <div>
                            <a href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Main Info Card -->
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
                                                <i class="fas fa-phone text-success"></i> {{ $siswa->no_hp }}
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
                                                <i class="fas fa-map-marker-alt text-danger"></i> {{ $siswa->alamat }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PKL Information Card -->
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
                                                <i class="fas fa-building text-primary"></i> 
                                                {{ $siswa->instansi->nama_instansi }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="detail-label">Alamat Instansi</div>
                                            <div class="detail-value">
                                                <i class="fas fa-map-marker-alt text-danger"></i> 
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
                                                <i class="fas fa-chalkboard-teacher text-info"></i> 
                                                {{ $siswa->guru->nama }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">No HP Guru</div>
                                            <div class="detail-value">
                                                <i class="fas fa-phone text-success"></i> 
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
                                                    <i class="fas fa-calendar-alt text-success"></i> 
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
                                                    <i class="fas fa-calendar-alt text-danger"></i> 
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
                                                <i class="fas fa-hourglass-half text-warning"></i> 
                                                {{ $siswa->tanggal_mulai->diffInDays($siswa->tanggal_selesai) }} hari
                                                ({{ round($siswa->tanggal_mulai->diffInDays($siswa->tanggal_selesai) / 30, 1) }} bulan)
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Summary Card -->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <div class="mb-3">
                                            <i class="fas fa-user-circle fa-5x text-primary"></i>
                                        </div>
                                        <h5 class="font-weight-bold">{{ $siswa->nama }}</h5>
                                        <p class="text-muted mb-2">{{ $siswa->nipd }}</p>
                                        <span class="badge badge-primary badge-custom">
                                            {{ $siswa->kelas }} {{ $siswa->jurusan }} {{ $siswa->rombel }}
                                        </span>
                                    </div>

                                    <hr>

                                    <h6 class="font-weight-bold text-primary mb-3">Informasi Kontak</h6>
                                    <p class="mb-2">
                                        <i class="fas fa-phone text-success"></i>
                                        <small class="ml-2">{{ $siswa->no_hp }}</small>
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-envelope text-info"></i>
                                        <small class="ml-2">{{ $siswa->user->email ?? '-' }}</small>
                                    </p>

                                    <hr>

                                    <h6 class="font-weight-bold text-primary mb-3">Status PKL</h6>
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
                                    <h6 class="font-weight-bold text-primary mb-3">Pembimbing</h6>
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

                            <!-- Action Buttons -->
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
                                          onsubmit="return confirm('Yakin ingin menghapus data siswa {{ $siswa->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block">
                                            <i class="fas fa-trash"></i> Hapus Data
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
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