<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Instansi - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
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

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.instansi.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Kelola Instansi</span>
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Instansi</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-info-circle"></i> Informasi Umum
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="font-weight-bold">Nama Instansi</td>
                                            <td>: {{ $instansi->nama_instansi }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Alamat</td>
                                            <td>: {{ $instansi->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">No HP</td>
                                            <td>: {{ $instansi->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Pemilik</td>
                                            <td>: {{ $instansi->pemilik }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Koordinat</td>
                                            <td>: 
                                                @if($instansi->latitude && $instansi->longitude)
                                                    {{ $instansi->latitude }}, {{ $instansi->longitude }}
                                                @else
                                                    <span class="text-muted">Belum diatur</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-users"></i> Informasi Kuota & Jurusan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%" class="font-weight-bold">Jurusan Diterima</td>
                                            <td>: 
                                                @if($instansi->jurusan_diterima === 'PPLG-BRP-DKV')
                                                    <span class="badge badge-success">Semua Jurusan</span>
                                                @else
                                                    @php
                                                        $jurusan_list = explode('-', $instansi->jurusan_diterima);
                                                    @endphp
                                                    @foreach($jurusan_list as $jurusan)
                                                        <span class="badge badge-primary mr-1">{{ $jurusan }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Kuota Siswa</td>
                                            <td>: <span class="badge badge-info">{{ $instansi->kuota_siswa }} Siswa</span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Kuota Terpakai</td>
                                            <td>: 
                                                <span class="badge {{ $instansi->kuota_terpakai >= $instansi->kuota_siswa ? 'badge-danger' : 'badge-warning' }}">
                                                    {{ $instansi->kuota_terpakai }} Siswa
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Sisa Kuota</td>
                                            <td>: 
                                                <span class="badge badge-success">
                                                    {{ $instansi->kuota_siswa - $instansi->kuota_terpakai }} Siswa
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="vertical-align: middle;">Persentase</td>
                                            <td style="vertical-align: middle;">
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">:</span>
                                                    @php
                                                        $percentage = $instansi->kuota_siswa > 0 ? ($instansi->kuota_terpakai / $instansi->kuota_siswa) * 100 : 0;
                                                    @endphp
                                                    <div class="progress flex-grow-1" style="height: 25px;">
                                                        <div class="progress-bar {{ $percentage >= 100 ? 'bg-danger' : ($percentage >= 75 ? 'bg-warning' : 'bg-success') }}" 
                                                            role="progressbar" 
                                                            style="width: {{ min($percentage, 100) }}%;" 
                                                            aria-valuenow="{{ $percentage }}" 
                                                            aria-valuemin="0" 
                                                            aria-valuemax="100">
                                                            {{ number_format($percentage, 1) }}%
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-chalkboard-teacher"></i> Guru Pembimbing
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if($instansi->guru)
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="40%" class="font-weight-bold">ID Guru</td>
                                                <td>: {{ $instansi->guru->id_guru }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Nama Guru</td>
                                                <td>: {{ $instansi->guru->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Email</td>
                                                <td>: {{ $instansi->guru->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">No HP</td>
                                                <td>: {{ $instansi->guru->no_hp ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-user-times fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada guru pembimbing</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-user-tie"></i> Akun Mentor
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if($instansi->mentor)
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="40%" class="font-weight-bold">Nama Akun</td>
                                                <td>: {{ $instansi->mentor->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Username</td>
                                                <td>: <code>{{ $instansi->mentor->username }}</code></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Role</td>
                                                <td>: <span class="badge badge-info">{{ ucfirst($instansi->mentor->role) }}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Status</td>
                                                <td>: <span class="badge badge-success">Aktif</span></td>
                                            </tr>
                                        </table>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada akun mentor</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-clipboard-list"></i> Status & Sumber
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%" class="font-weight-bold">Sumber Data</td>
                                            <td>: 
                                                @if($instansi->is_from_submission)
                                                    <span class="badge badge-info">
                                                        <i class="fas fa-paper-plane"></i> Pengajuan Siswa
                                                    </span>
                                                @else
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-user-shield"></i> Admin
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Dibuat Pada</td>
                                            <td>: {{ $instansi->created_at ? $instansi->created_at->format('d M Y H:i') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Terakhir Diubah</td>
                                            <td>: {{ $instansi->updated_at ? $instansi->updated_at->format('d M Y H:i') : '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-user-graduate"></i> Daftar Siswa PKL
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if($instansi->siswa && $instansi->siswa->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>NIPD</th>
                                                        <th>Nama Siswa</th>
                                                        <th>Jurusan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($instansi->siswa as $index => $siswa)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $siswa->nipd ?? '-' }}</td>
                                                        <td>{{ $siswa->nama ?? '-' }}</td>
                                                        <td>
                                                            <span class="badge badge-primary">{{ $siswa->jurusan ?? '-' }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada siswa PKL</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body text-center">
                            <a href="{{ route('admin.instansi.edit', $instansi->id_instansi) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                            <a href="{{ route('admin.instansi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
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