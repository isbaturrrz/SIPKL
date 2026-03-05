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
            transition: transform 0.2s;
        }

        .table-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e3e6f0;
        }

        .table-header h5 {
            font-weight: 700;
            color: #1a1a1a;
            display: flex;
            margin: 0;
            font-size: 1.1rem;
        }

        .card-header-primary {
            background: linear-gradient(135deg, #2c5aa0 0%, #1e4179 100%);
        }

        .card-header-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .card-header-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .card-header-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .card-header-primary h5,
        .card-header-success h5,
        .card-header-warning h5,
        .card-header-info h5 {
            color: #fff;
        }

        .btn-template {
            background: #fff;
            color: #334155;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-template:hover {
            background: #f8fafc;
            color: #1a1a1a;
            transform: translateY(-1px);
        }

        .info-box {
            background: #f8fafc;
            border-left: 4px solid #2c5aa0;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0 8px 8px 0;
        }

        .info-box ul {
            margin-bottom: 0;
            padding-left: 1.25rem;
        }

        .info-box li {
            margin-bottom: 0.35rem;
            font-size: 0.85rem;
            color: #334155;
        }

        .info-box code {
            background: #e2e8f0;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            color: #1e4179;
            font-weight: 600;
        }

        .custom-file-input:focus ~ .custom-file-label {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
        }

        .custom-file-label {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .custom-file-label::after {
            background: #e8eef7;
            border-left: 2px solid #e2e8f0;
            border-radius: 0 6px 6px 0;
            padding: 0.6rem 1rem;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%);
            border: none;
            color: #fff;
            padding: 0.65rem 1.5rem;
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

        .btn-success {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            border: none;
            color: #fff;
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
            transition: all 0.3s;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
            border: none;
            color: #fff;
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(217, 119, 6, 0.3);
            transition: all 0.3s;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.4);
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 0.85rem 1.25rem;
            margin-bottom: 1rem;
            font-size: 0.85rem;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="font-weight: 700;">Import Data</h1>
                    </div>

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
                            <div class="table-card h-100">
                                <div class="table-header card-header-primary d-flex justify-content-between align-items-center">
                                    <h5>
                                        <span>Import Siswa</span>
                                    </h5>
                                    <a href="{{ route('admin.import.template.siswa') }}" class="btn-template">
                                        <i class="fas fa-download"></i> Template
                                    </a>
                                </div>
                                <div style="padding: 1.5rem 2rem;">

                                    <div class="alert alert-info">
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
                            <div class="table-card h-100">
                                <div class="table-header card-header-success d-flex justify-content-between align-items-center">
                                    <h5>
                                        <span>Import Instansi</span>
                                    </h5>
                                    <a href="{{ route('admin.import.template.instansi') }}" class="btn-template">
                                        <i class="fas fa-download"></i> Template
                                    </a>
                                </div>
                                <div style="padding: 1.5rem 2rem;">

                                    <div class="alert alert-warning">
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
                            <div class="table-card h-100">
                                <div class="table-header card-header-warning d-flex justify-content-between align-items-center">
                                    <h5>
                                        <span>Import Guru</span>
                                    </h5>
                                    <a href="{{ route('admin.import.template.guru') }}" class="btn-template">
                                        <i class="fas fa-download"></i> Template
                                    </a>
                                </div>
                                <div style="padding: 1.5rem 2rem;">

                                    <div class="alert alert-info">
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
                                        <button type="submit" class="btn btn-warning btn-block" id="btn-import-guru">
                                            <i class="fas fa-upload"></i> Import Guru
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header card-header-primary">
                            <h5>
                                <span>Panduan Import Data</span>
                            </h5>
                        </div>
                        <div style="padding: 1.5rem 2rem;">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold" style="color: #2c5aa0;">Langkah-langkah Import:</h6>
                                    <ol style="font-size: 0.9rem; color: #334155; line-height: 1.8;">
                                        <li>Klik tombol <strong>"Template"</strong> untuk download template Excel</li>
                                        <li>Buka file template dengan Microsoft Excel atau Google Sheets</li>
                                        <li>Isi data sesuai format yang sudah ditentukan</li>
                                        <li>Pastikan <strong>tidak ada kolom wajib yang kosong</strong></li>
                                        <li>Hapus baris contoh setelah selesai mengisi data</li>
                                        <li>Simpan file dalam format <code style="background: #e2e8f0; padding: 0.2rem 0.5rem; border-radius: 4px;">.xlsx</code></li>
                                        <li>Upload file dan klik tombol <strong>"Import"</strong></li>
                                        <li>Tunggu proses import selesai dan periksa notifikasi</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold" style="color: #dc2626;">Hal Penting:</h6>
                                    <ul style="font-size: 0.9rem; color: #334155; line-height: 1.8;">
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