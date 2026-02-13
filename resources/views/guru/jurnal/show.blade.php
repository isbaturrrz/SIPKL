<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detail Jurnal - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist_guru/css/style.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    
    <style>
        .detail-label {
            font-weight: 600;
            color: #4e73df;
        }
        .detail-value {
            color: #5a5c69;
        }
        .map-container {
            height: 400px;
            width: 100%;
            border-radius: 0.35rem;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_guru/img/logo.png') }}" alt="">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Jurnal Siswa</h1>
                        <a href="{{ route('guru.jurnal.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-header py-3 bg-primary">
                                    <h6 class="m-0 font-weight-bold text-white">
                                        <i class="fas fa-user"></i> Informasi Siswa
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <p class="detail-label mb-1">Nama Siswa</p>
                                        <p class="detail-value">{{ $jurnal->siswa->nama }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="detail-label mb-1">NIPD</p>
                                        <p class="detail-value">{{ $jurnal->siswa->nipd ?? '-' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="detail-label mb-1">Kelas</p>
                                        <p class="detail-value">{{ $jurnal->siswa->kelas ?? '-' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="detail-label mb-1">Instansi PKL</p>
                                        <p class="detail-value">{{ $jurnal->siswa->instansi->nama_instansi ?? '-' }}</p>
                                    </div>
                                    <div class="mb-0">
                                        <p class="detail-label mb-1">Alamat Instansi</p>
                                        <p class="detail-value">{{ $jurnal->siswa->instansi->alamat ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-header py-3 bg-success">
                                    <h6 class="m-0 font-weight-bold text-white">
                                        <i class="fas fa-clipboard-list"></i> Detail Jurnal
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <p class="detail-label mb-1">Tanggal</p>
                                            <p class="detail-value">
                                                <i class="fas fa-calendar-alt text-primary"></i> 
                                                {{ \Carbon\Carbon::parse($jurnal->tgl)->isoFormat('dddd, D MMMM Y') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="detail-label mb-1">Waktu Kegiatan</p>
                                            <p class="detail-value">
                                                <i class="fas fa-clock text-primary"></i> 
                                                {{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }} WIB
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="detail-label mb-1">Status Kehadiran</p>
                                            <p class="detail-value">
                                                @if($jurnal->status_kehadiran == 'hadir')
                                                    <span class="badge badge-success badge-lg">
                                                        <i class="fas fa-check-circle"></i> Hadir
                                                    </span>
                                                @elseif($jurnal->status_kehadiran == 'izin')
                                                    <span class="badge badge-warning badge-lg">
                                                        <i class="fas fa-info-circle"></i> Izin
                                                    </span>
                                                @elseif($jurnal->status_kehadiran == 'sakit')
                                                    <span class="badge badge-info badge-lg">
                                                        <i class="fas fa-medkit"></i> Sakit
                                                    </span>
                                                @elseif($jurnal->status_kehadiran == 'libur')
                                                    <span class="badge badge-secondary badge-lg">
                                                        <i class="fas fa-calendar-times"></i> Libur
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger badge-lg">
                                                        <i class="fas fa-times-circle"></i> Alfa
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="detail-label mb-1">Lokasi Kerja</p>
                                            <p class="detail-value">
                                                @if($jurnal->status_kehadiran == 'hadir')
                                                    @if($jurnal->wfh)
                                                        <span class="badge badge-info badge-lg">
                                                            <i class="fas fa-home"></i> Work From Home
                                                        </span>
                                                    @else
                                                        <span class="badge badge-primary badge-lg">
                                                            <i class="fas fa-building"></i> Kantor
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-secondary badge-lg">
                                                        <i class="fas fa-home"></i> Rumah
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <p class="detail-label mb-1">Kegiatan</p>
                                            <div class="detail-value p-3 bg-light rounded">
                                                {{ $jurnal->kegiatan }}
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <p class="detail-label mb-1">Manfaat yang Didapat</p>
                                            <div class="detail-value p-3 bg-light rounded">
                                                {{ $jurnal->manfaat }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 bg-info">
                                    <h6 class="m-0 font-weight-bold text-white">
                                        <i class="fas fa-check-double"></i> Informasi Verifikasi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <p class="detail-label mb-1">Status Verifikasi</p>
                                            <p class="detail-value">
                                                @if($jurnal->status_verifikasi == 'verified')
                                                    <span class="badge badge-success badge-lg">
                                                        <i class="fas fa-check-circle"></i> Terverifikasi
                                                    </span>
                                                @elseif($jurnal->status_verifikasi == 'rejected')
                                                    <span class="badge badge-danger badge-lg">
                                                        <i class="fas fa-times-circle"></i> Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning badge-lg">
                                                        <i class="fas fa-hourglass-half"></i> Menunggu
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <p class="detail-label mb-1">Diinput Oleh</p>
                                            <p class="detail-value">
                                                @if($jurnal->input_by == 'siswa')
                                                    <span class="badge badge-primary">
                                                        <i class="fas fa-user-graduate"></i> Siswa
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        <i class="fas fa-chalkboard-teacher"></i> Guru
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        @if($jurnal->status_verifikasi == 'verified')
                                        <div class="col-md-3 mb-3">
                                            <p class="detail-label mb-1">Diverifikasi Oleh</p>
                                            <p class="detail-value">
                                                @if($jurnal->verified_by == 'guru')
                                                    <span class="badge badge-secondary">
                                                        <i class="fas fa-chalkboard-teacher"></i> Guru Pembimbing
                                                    </span>
                                                @elseif($jurnal->verified_by == 'pembimbing_instansi')
                                                    <span class="badge badge-primary">
                                                        <i class="fas fa-user-tie"></i> Pembimbing Instansi
                                                    </span>
                                                @else
                                                    {{ $jurnal->verified_by ?? '-' }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <p class="detail-label mb-1">Waktu Verifikasi</p>
                                            <p class="detail-value">
                                                {{ $jurnal->verified_at ? \Carbon\Carbon::parse($jurnal->verified_at)->isoFormat('D MMMM Y, HH:mm') : '-' }}
                                            </p>
                                        </div>
                                        @endif
                                        @if($jurnal->status_verifikasi == 'rejected' && $jurnal->keterangan_reject)
                                        <div class="col-md-12 mb-3">
                                            <p class="detail-label mb-1">Keterangan Penolakan</p>
                                            <div class="alert alert-danger">
                                                <i class="fas fa-exclamation-triangle"></i> 
                                                {{ $jurnal->keterangan_reject }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($jurnal->latitude && $jurnal->longitude)
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 bg-warning">
                                    <h6 class="m-0 font-weight-bold text-white">
                                        <i class="fas fa-map-marker-alt"></i> Lokasi Absensi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <p class="detail-label mb-1">Koordinat</p>
                                        <p class="detail-value">
                                            <i class="fas fa-compass text-danger"></i> 
                                            Latitude: {{ $jurnal->latitude }}, Longitude: {{ $jurnal->longitude }}
                                        </p>
                                    </div>
                                    <div id="map" class="map-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

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

    @if($jurnal->latitude && $jurnal->longitude)
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <script>
        var map = L.map('map').setView([{{ $jurnal->latitude }}, {{ $jurnal->longitude }}], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([{{ $jurnal->latitude }}, {{ $jurnal->longitude }}]).addTo(map);
        marker.bindPopup("<b>Lokasi Absensi</b><br>{{ $jurnal->siswa->nama }}<br>{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}").openPopup();
    </script>
    @endif

</body>

</html>