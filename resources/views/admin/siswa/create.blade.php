<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Siswa - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
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
                <a class="nav-link" href="#">
                    <i class="fas fa-building"></i>
                    <span>Kelola Instansi</span>
                </a> 
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Kelola Guru</span>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data Siswa</h1>
                    </div>

                    <!-- Form Tambah Siswa -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Input Siswa</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.siswa.store') }}" method="POST">
                                @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Oops! Ada kesalahan:</strong>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <div class="row">
                                    <!-- NIPD -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nipd">NIPD <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nipd') is-invalid @enderror" 
                                                id="nipd" name="nipd" value="{{ old('nipd') }}" 
                                                placeholder="Masukkan NIPD (Max 9 karakter)" maxlength="9" required>
                                            @error('nipd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">NIPD akan digunakan sebagai username login siswa</small>
                                        </div>
                                    </div>

                                    <!-- Nama Lengkap -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                                id="nama" name="nama" value="{{ old('nama') }}" 
                                                placeholder="Masukkan nama lengkap" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Tempat Lahir -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                                id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" 
                                                placeholder="Masukkan tempat lahir" required>
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                                                id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                            @error('tgl_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Tanggal lahir akan digunakan sebagai password login siswa (format: YYYY-MM-DD)</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- No HP -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp">No HP <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                                id="no_hp" name="no_hp" value="{{ old('no_hp') }}" 
                                                placeholder="Contoh: 08123456789" maxlength="13" required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kelas -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kelas">Kelas <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" 
                                                id="kelas" name="kelas" value="{{ old('kelas') }}" 
                                                placeholder="Contoh: 12" maxlength="5" required>
                                            @error('kelas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Jurusan -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="jurusan">Jurusan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" 
                                                id="jurusan" name="jurusan" value="{{ old('jurusan') }}" 
                                                placeholder="Contoh: RPL" required>
                                            @error('jurusan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="form-group">
                                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                        id="alamat" name="alamat" rows="3" 
                                        placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Guru Pembimbing -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_guru">Guru Pembimbing</label>
                                            <select class="form-control @error('id_guru') is-invalid @enderror" 
                                                id="id_guru" name="id_guru">
                                                <option value="">-- Pilih Guru Pembimbing --</option>
                                                @foreach($guru as $g)
                                                    <option value="{{ $g->id_guru }}" {{ old('id_guru') == $g->id_guru ? 'selected' : '' }}>
                                                        {{ $g->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_guru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Instansi -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_instansi">Instansi Prakerin</label>
                                            <select class="form-control @error('id_instansi') is-invalid @enderror" 
                                                id="id_instansi" name="id_instansi">
                                                <option value="">-- Pilih Instansi --</option>
                                                @foreach($instansi as $i)
                                                    <option value="{{ $i->id_instansi }}" {{ old('id_instansi') == $i->id_instansi ? 'selected' : '' }}>
                                                        {{ $i->nama_instansi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_instansi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="form-group">
                                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Data
                                    </button>
                                </div>
                            </form>
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