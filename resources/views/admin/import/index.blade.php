<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Import Data - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_admin/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">

    <style>
        .import-card {
            transition: transform 0.2s;
        }
        .import-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .custom-file-label::after {
            content: "Browse";
        }
        .info-box {
            background: #f8f9fc;
            border-left: 4px solid #4e73df;
            padding: 15px;
            margin-bottom: 20px;
        }
        .info-box ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
        .info-box li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
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

            <li class="nav-item active">
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
                    <h1 class="h3 mb-4 text-gray-800">
                        Import Data
                    </h1>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Perhatian!</strong> {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle"></i> <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow import-card h-100">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-user-graduate"></i> Import Siswa
                                    </h6>
                                    <a href="{{ route('admin.import.template.siswa') }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-download"></i> Template
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="info-box">
                                        <strong><i class="fas fa-info-circle"></i> Kolom Wajib:</strong>
                                        <ul class="mt-2 small">
                                            <li><code>nipd</code> → Username</li>
                                            <li><code>nama</code></li>
                                            <li><code>tgl_lahir</code> → Password</li>
                                            <li><code>kelas</code> (X, XI, XII)</li>
                                            <li><code>jurusan</code> (PPLG, BRP, DKV)</li>
                                        </ul>
                                    </div>

                                    <div class="alert alert-info small">
                                        <strong><i class="fas fa-key"></i> Login:</strong><br>
                                        Username = <strong>NIPD</strong><br>
                                        Password = <strong>YYYY-MM-DD</strong>
                                    </div>

                                    <form action="{{ route('admin.import.siswa') }}" method="POST" enctype="multipart/form-data" id="form-import-siswa">
                                        @csrf
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-siswa" name="file" required accept=".xlsx,.xls,.csv">
                                                <label class="custom-file-label" for="file-siswa">Pilih file...</label>
                                            </div>
                                            <small class="form-text text-muted">
                                                Format: .xlsx, .xls, .csv (Max: 5MB)
                                            </small>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block" id="btn-import-siswa">
                                            <i class="fas fa-upload"></i> Import Siswa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <div class="card shadow import-card h-100">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-success text-white">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-building"></i> Import Instansi
                                    </h6>
                                    <a href="{{ route('admin.import.template.instansi') }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-download"></i> Template
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="info-box">
                                        <strong><i class="fas fa-info-circle"></i> Kolom Wajib:</strong>
                                        <ul class="mt-2 small">
                                            <li><code>nama_instansi</code></li>
                                        </ul>
                                        <strong class="mt-2 d-block">Kolom Opsional:</strong>
                                        <ul class="small">
                                            <li><code>alamat</code></li>
                                            <li><code>latitude</code></li>
                                            <li><code>longitude</code></li>
                                            <li><code>no_hp</code></li>
                                            <li><code>pemilik</code></li>
                                            <li><code>kuota_siswa</code></li>
                                            <li><code>jurusan_diterima</code></li>
                                            <li><code>id_guru</code></li>
                                        </ul>
                                    </div>

                                    <div class="alert alert-warning small">
                                        <strong><i class="fas fa-user-tie"></i> Auto Create Mentor:</strong><br>
                                        Username = <strong>nama_instansi</strong><br>
                                        Password = <strong>@mentor123</strong>
                                    </div>

                                    <form action="{{ route('admin.import.instansi') }}" method="POST" enctype="multipart/form-data" id="form-import-instansi">
                                        @csrf
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-instansi" name="file" required accept=".xlsx,.xls,.csv">
                                                <label class="custom-file-label" for="file-instansi">Pilih file...</label>
                                            </div>
                                            <small class="form-text text-muted">
                                                Format: .xlsx, .xls, .csv (Max: 5MB)
                                            </small>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block" id="btn-import-instansi">
                                            <i class="fas fa-upload"></i> Import Instansi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <div class="card shadow import-card h-100">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-warning text-white">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-chalkboard-teacher"></i> Import Guru
                                    </h6>
                                    <a href="{{ route('admin.import.template.guru') }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-download"></i> Template
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="info-box">
                                        <strong><i class="fas fa-info-circle"></i> Kolom Wajib:</strong>
                                        <ul class="mt-2 small">
                                            <li><code>nama</code></li>
                                            <li><code>email</code> → Username</li>
                                            <li><code>tgl_lahir</code> → Password</li>
                                        </ul>
                                        <strong class="mt-2 d-block">Kolom Opsional:</strong>
                                        <ul class="small">
                                            <li><code>tempat_lahir</code></li>
                                            <li><code>no_hp</code></li>
                                            <li><code>id_instansi</code></li>
                                        </ul>
                                    </div>

                                    <div class="alert alert-info small">
                                        <strong><i class="fas fa-key"></i> Login:</strong><br>
                                        Username = <strong>Email</strong><br>
                                        Password = <strong>YYYY-MM-DD</strong>
                                    </div>

                                    <form action="{{ route('admin.import.guru') }}" method="POST" enctype="multipart/form-data" id="form-import-guru">
                                        @csrf
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-guru" name="file" required accept=".xlsx,.xls,.csv">
                                                <label class="custom-file-label" for="file-guru">Pilih file...</label>
                                            </div>
                                            <small class="form-text text-muted">
                                                Format: .xlsx, .xls, .csv (Max: 5MB)
                                            </small>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-block text-white" id="btn-import-guru">
                                            <i class="fas fa-upload"></i> Import Guru
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-info text-white">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-book"></i> Panduan Import Data
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-primary">Langkah-langkah Import:</h6>
                                    <ol>
                                        <li>Klik tombol <strong>"Template"</strong> untuk download template Excel</li>
                                        <li>Buka file template dengan Microsoft Excel atau Google Sheets</li>
                                        <li>Isi data sesuai format yang sudah ditentukan</li>
                                        <li>Pastikan <strong>tidak ada kolom wajib yang kosong</strong></li>
                                        <li>Hapus baris contoh setelah selesai mengisi data</li>
                                        <li>Simpan file dalam format <code>.xlsx</code></li>
                                        <li>Upload file dan klik tombol <strong>"Import"</strong></li>
                                        <li>Tunggu proses import selesai dan periksa notifikasi</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-danger">Hal Penting:</h6>
                                    <ul>
                                        <li><strong>Siswa:</strong>
                                            <ul>
                                                <li>NIPD harus unique (tidak boleh sama)</li>
                                                <li>Username = NIPD, Password = Tanggal Lahir</li>
                                                <li>Format tanggal: YYYY-MM-DD</li>
                                                <li>Kelas: X, XI, atau XII</li>
                                            </ul>
                                        </li>
                                        <li><strong>Instansi:</strong>
                                            <ul>
                                                <li>Otomatis membuat akun Mentor</li>
                                                <li>Username mentor = nama instansi (slug)</li>
                                                <li>Password mentor = @mentor123</li>
                                                <li>Email mentor = username@sipkl.com</li>
                                            </ul>
                                        </li>
                                        <li><strong>Guru:</strong>
                                            <ul>
                                                <li>Email harus unique</li>
                                                <li>Username = Email, Password = Tanggal Lahir</li>
                                                <li>Format tanggal: YYYY-MM-DD</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="alert alert-warning mt-3 mb-0">
                                <strong><i class="fas fa-exclamation-triangle"></i> Perhatian:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Baris pertama Excel harus berisi header/nama kolom</li>
                                    <li>Data duplikat akan dilewati (tidak diimport)</li>
                                    <li>Format tanggal harus: <strong>YYYY-MM-DD</strong> (contoh: 2005-01-15)</li>
                                    <li>Proses import besar (>100 baris) mungkin memakan waktu</li>
                                </ul>
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

    <script>
        document.querySelectorAll('.custom-file-input').forEach(input => {
            input.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || 'Pilih file...';
                const label = e.target.nextElementSibling;
                label.textContent = fileName;
            });
        });

        document.getElementById('form-import-siswa').addEventListener('submit', function() {
            const btn = document.getElementById('btn-import-siswa');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengimport...';
            btn.disabled = true;
        });

        document.getElementById('form-import-instansi').addEventListener('submit', function() {
            const btn = document.getElementById('btn-import-instansi');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengimport...';
            btn.disabled = true;
        });

        document.getElementById('form-import-guru').addEventListener('submit', function() {
            const btn = document.getElementById('btn-import-guru');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengimport...';
            btn.disabled = true;
        });
    </script>
</body>
</html>