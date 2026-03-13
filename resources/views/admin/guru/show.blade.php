<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Guru - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
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

         .btn-warning {
             background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
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
        }

        @media (max-width: 480px) {
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }
        }

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
        .badge-custom {
            font-size: 0.9rem;
            padding: 8px 15px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_admin/img/logo.png')}}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
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

            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Data Guru</h1>
                        <div>
                            <a href="{{ route('admin.guru.edit', $guru->id_guru) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pribadi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">Nama Lengkap</div>
                                            <div class="detail-value">
                                                <i class="fas fa-user text-primary"></i> {{ $guru->nama }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Email</div>
                                            <div class="detail-value">
                                                <i class="fas fa-envelope text-success"></i> {{ $guru->email }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">Tempat Lahir</div>
                                            <div class="detail-value">
                                                <i class="fas fa-map-marker-alt text-danger"></i> {{ $guru->tempat_lahir }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Tanggal Lahir</div>
                                            <div class="detail-value">
                                                <i class="fas fa-calendar text-info"></i> 
                                                {{ \Carbon\Carbon::parse($guru->tgl_lahir)->format('d F Y') }}
                                                <span class="text-muted">({{ \Carbon\Carbon::parse($guru->tgl_lahir)->age }} tahun)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-label">No HP</div>
                                            <div class="detail-value">
                                                <i class="fas fa-phone text-success"></i> {{ $guru->no_hp }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-label">Instansi yang Dibimbing</div>
                                            <div class="detail-value">
                                                @if($guru->instansi && $guru->instansi->count() > 0)
                                                    @foreach($guru->instansi as $inst)
                                                        <span class="badge badge-success badge-custom mb-1">
                                                            <i class="fas fa-building"></i> {{ $inst->nama_instansi }}
                                                        </span><br>
                                                    @endforeach
                                                    <small class="text-muted mt-2 d-block">
                                                        ({{ $guru->instansi->count() }} instansi)
                                                    </small>
                                                @else
                                                    <span class="badge badge-secondary badge-custom">
                                                        <i class="fas fa-exclamation-circle"></i> Belum Ditugaskan
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Instansi yang Dibimbing</h6>
                                </div>
                                <div class="card-body">
                                    @if($guru->instansi && $guru->instansi->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Nama Instansi</th>
                                                        <th>Alamat</th>
                                                        <th>No HP</th>
                                                        <th>Kuota</th>
                                                        <th>Jurusan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($guru->instansi as $index => $inst)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $inst->nama_instansi }}</td>
                                                        <td>{{ $inst->alamat }}</td>
                                                        <td>{{ $inst->no_hp }}</td>
                                                        <td>{{ $inst->kuota_terpakai }}/{{ $inst->kuota_siswa }}</td>
                                                        <td>
                                                            <span class="badge badge-info">{{ $inst->jurusan_diterima }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge badge-success badge-custom">
                                                <i class="fas fa-building"></i> Total: {{ $guru->instansi->count() }} Instansi
                                            </span>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-building fa-3x text-gray-300 mb-3"></i>
                                            <p class="text-gray-500">Belum membimbing instansi manapun</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa Bimbingan</h6>
                                </div>
                                <div class="card-body">
                                    @if($guru->siswa && $guru->siswa->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Nama Siswa</th>
                                                        <th>NIPD</th>
                                                        <th>Kelas</th>
                                                        <th>Jurusan</th>
                                                        <th>Instansi PKL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($guru->siswa as $index => $siswa)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $siswa->nama }}</td>
                                                        <td>{{ $siswa->nipd }}</td>
                                                        <td>{{ $siswa->kelas }}</td>
                                                        <td>{{ $siswa->jurusan }}</td>
                                                        <td>
                                                            @if($siswa->instansi)
                                                                <span class="badge badge-success">{{ $siswa->instansi->nama_instansi }}</span>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                                            <p class="text-gray-500">Belum ada siswa bimbingan</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <div class="mb-3">
                                            <i class="fas fa-chalkboard-teacher fa-5x text-primary"></i>
                                        </div>
                                        <h5 class="font-weight-bold">{{ $guru->nama }}</h5>
                                        <p class="text-muted mb-2">{{ $guru->email }}</p>
                                    </div>

                                    <hr>

                                    <h6 class="font-weight-bold text-primary mb-3">Informasi Kontak</h6>
                                    <p class="mb-2">
                                        <i class="fas fa-phone text-success"></i>
                                        <small class="ml-2">{{ $guru->no_hp }}</small>
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-envelope text-info"></i>
                                        <small class="ml-2">{{ $guru->email }}</small>
                                    </p>

                                    <hr>

                                    <h6 class="font-weight-bold text-primary mb-3">Status Penugasan</h6>
                                    @if($guru->instansi && $guru->instansi->count() > 0)
                                        <div class="alert alert-success">
                                            <i class="fas fa-check-circle"></i> 
                                            <strong>Sudah Ditugaskan</strong>
                                            <p class="mb-0 mt-2 small">Membimbing {{ $guru->instansi->count() }} instansi</p>
                                        </div>
                                        <div class="list-group">
                                            @foreach($guru->instansi as $inst)
                                                <div class="list-group-item">
                                                    <small>{{ $inst->nama_instansi }}</small>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> 
                                            <strong>Belum Ditugaskan</strong>
                                        </div>
                                    @endif

                                    <hr>

                                    <h6 class="font-weight-bold text-primary mb-3">Siswa Bimbingan</h6>
                                    <div class="alert alert-info">
                                        <i class="fas fa-users"></i>
                                        <strong>{{ $guru->siswa ? $guru->siswa->count() : 0 }} Siswa</strong>
                                        <p class="mb-0 mt-2 small">Total siswa yang dibimbing</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('admin.guru.edit', $guru->id_guru) }}" 
                                       class="btn btn-warning btn-block mb-2">
                                        <i class="fas fa-edit"></i> Edit Data
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $guru->id_guru) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
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