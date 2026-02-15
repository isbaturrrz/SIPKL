<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Siswa - Mentor</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_mentor/img/')}}" alt="">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>   

            <li class="nav-item active">
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

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.riwayat.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
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
                                    Mentor
                                </span>                             
                            </a>                         
                        </li>
                        @endauth
                    </ul>
                </nav>
            
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Siswa</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-user"></i> Data Pribadi
                                    </h6>
                                </div>
                                <div class="card-body">
                                   <table class="table table-borderless">
                                        <tr>
                                            <td width="40%" class="font-weight-bold">NIPD</td>
                                            <td>: {{ $siswa->nipd ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Nama Lengkap</td>
                                            <td>: {{ $siswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Tempat, Tanggal Lahir</td>
                                            <td>: {{ $siswa->tempat_lahir ?? '-' }}@if($siswa->tgl_lahir), {{ $siswa->tgl_lahir->format('d M Y') }}@endif</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Kelas</td>
                                            <td>: {{ $siswa->kelas_lengkap ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Jurusan</td>
                                            <td>: <span>{{ $siswa->jurusan_lengkap ?? '-' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">No HP</td>
                                            <td>: {{ $siswa->no_hp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Alamat</td>
                                            <td>: {{ $siswa->alamat ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-building"></i> Data PKL
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%" class="font-weight-bold">Instansi</td>
                                            <td>: {{ $siswa->instansi->nama_instansi ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Alamat Instansi</td>
                                            <td>: {{ $siswa->instansi->alamat ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Guru Pembimbing</td>
                                            <td>: {{ $siswa->guru->nama ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Periode PKL</td>
                                            <td>: 
                                                @if($siswa->tanggal_mulai && $siswa->tanggal_selesai)
                                                    {{ \Carbon\Carbon::parse($siswa->tanggal_mulai)->format('d M Y') }} - 
                                                    {{ \Carbon\Carbon::parse($siswa->tanggal_selesai)->format('d M Y') }}
                                                @else
                                                    <span>Belum diatur</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Status Penempatan</td>
                                            <td>: 
                                                @if($siswa->status_penempatan == 'ditempatkan')
                                                    <span class="badge badge-success">Ditempatkan</span>
                                                @elseif($siswa->status_penempatan == 'belum_ditempatkan')
                                                    <span class="badge badge-warning">Belum Ditempatkan</span>
                                                @else
                                                    <span>{{ $siswa->status_penempatan ?? '-' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-chart-pie"></i> Statistik Kehadiran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                Hadir
                                                            </div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                {{ $siswa->total_jurnal_hadir }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                                Izin
                                                            </div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                {{ $siswa->total_jurnal_izin }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="card border-left-warning shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                                Sakit
                                                            </div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                {{ $siswa->total_jurnal_sakit }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-thermometer fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <div class="card border-left-danger shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                                Alfa
                                                            </div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                {{ $siswa->total_jurnal_alfa }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                                        Persentase Kehadiran
                                                    </div>
                                                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                                                        {{ $siswa->persentase_kehadiran }}%
                                                    </div>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar bg-primary" 
                                                             role="progressbar" 
                                                             style="width: {{ $siswa->persentase_kehadiran }}%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                                                        Predikat
                                                    </div>
                                                    <div class="h1 mb-0 font-weight-bold text-gray-800">
                                                        {{ $siswa->predikat }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-2">
                                                        Total Jurnal
                                                    </div>
                                                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                                                        {{ $siswa->total_jurnal_all }}
                                                    </div>
                                                    <small class="text-muted">
                                                        Verified: {{ $siswa->total_jurnal_verified }} | 
                                                        Pending: {{ $siswa->total_jurnal_pending }} | 
                                                        Rejected: {{ $siswa->total_jurnal_rejected }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-clock"></i> Jurnal Terbaru (10 Terakhir)
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jam</th>
                                                    <th>Kehadiran</th>
                                                    <th>Status Verifikasi</th>
                                                    <th>Kegiatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentJurnal as $jurnal)
                                                <tr>
                                                    <td>{{ $jurnal->tgl ? $jurnal->tgl->format('d M Y') : '-' }}</td>
                                                    <td>{{ $jurnal->jam_mulai ?? '-' }} - {{ $jurnal->jam_selesai ?? '-' }}</td>
                                                    <td>
                                                        @if($jurnal->status_kehadiran == 'hadir')
                                                            <span class="badge badge-success">Hadir</span>
                                                        @elseif($jurnal->status_kehadiran == 'izin')
                                                            <span class="badge badge-info">Izin</span>
                                                        @elseif($jurnal->status_kehadiran == 'sakit')
                                                            <span class="badge badge-warning">Sakit</span>
                                                        @elseif($jurnal->status_kehadiran == 'libur')
                                                            <span class="badge badge-secondary">Libur</span>
                                                        @else
                                                            <span class="badge badge-danger">Alfa</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($jurnal->status_verifikasi == 'verified')
                                                            <span class="badge badge-success">Verified</span>
                                                        @elseif($jurnal->status_verifikasi == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @else
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Str::limit($jurnal->kegiatan ?? '-', 50) }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Belum ada jurnal</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <a href="{{ route('mentor.siswa.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
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