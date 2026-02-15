<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Jurnal - Riwayat</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
            border-radius: 5px;
        }
        .detail-card {
            border: 2px solid #4e73df;
            border-radius: 8px;
            padding: 20px;
            background: white;
        }
        .detail-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: 600;
            width: 150px;
            flex-shrink: 0;
        }
        .info-value {
            flex-grow: 1;
        }
        .section-divider {
            border-top: 2px dashed #e3e6f0;
            margin: 20px 0;
        }
        .textarea-detail {
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-radius: 5px;
            padding: 15px;
            min-height: 100px;
            width: 100%;
        }
    </style>
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

            <li class="nav-item">
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

            <li class="nav-item active">
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
                    <div class="detail-card">
                        <div class="detail-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $jurnal->tgl ? $jurnal->tgl->format('l, d F Y') : '-' }}</h5>
                                    <small>{{ $jurnal->jam_mulai ?? '00:00' }} WIB</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-row">
                                    <div class="info-label">Instansi</div>
                                    <div class="info-value">: {{ $jurnal->siswa->instansi->nama_instansi ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-row">
                                    <div class="info-label">Status</div>
                                    <div class="info-value">: 
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" value="{{ $jurnal->siswa->nama ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="text" class="form-control" value="{{ $jurnal->tgl ? $jurnal->tgl->format('d F Y') : '-' }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Jam Mulai</label>
                                <input type="text" class="form-control" value="{{ $jurnal->jam_mulai ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Jam Selesai</label>
                                <input type="text" class="form-control" value="{{ $jurnal->jam_selesai ?? '-' }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Kegiatan yang Dilakukan :</label>
                            <div class="textarea-detail">
                                {{ $jurnal->kegiatan ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="font-weight-bold">Manfaat yang Didapat :</label>
                            <div class="textarea-detail">
                                {{ $jurnal->manfaat ?? '-' }}
                            </div>
                        </div>

                        @if($jurnal->latitude && $jurnal->longitude)
                        <div class="mb-4">
                            <label class="font-weight-bold">Lokasi Absensi :</label>
                            <div id="map"></div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-map-marker-alt"></i> Koordinat: {{ $jurnal->latitude }}, {{ $jurnal->longitude }}
                            </small>
                        </div>
                        @endif

                        <div class="section-divider"></div>

                       <div class="card border-left-success shadow mb-3">
                            <div class="card-body">
                                <h6 class="font-weight-bold mb-3">
                                    <i class="fas fa-check-circle"></i> Status Verifikasi
                                </h6>
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <td width="30%" class="font-weight-bold">Status</td>
                                        <td>: 
                                            <span class="badge badge-success badge-lg">
                                                <i class="fas fa-check-circle"></i> Terverifikasi
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Diverifikasi Oleh</td>
                                        <td>
                                            @if(!$item->verifiedBy)
                                                -
                                            @elseif($item->verifiedBy->role == 'mentor')
                                                {{ $item->verifiedBy->name }}
                                            @else
                                                Guru Pembimbing
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Waktu Verifikasi</td>
                                        <td>: {{ $jurnal->verified_at ? $jurnal->verified_at->format('d M Y H:i') : '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('mentor.riwayat.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
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

    @if($jurnal->latitude && $jurnal->longitude)
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var lat = {{ $jurnal->latitude }};
        var lng = {{ $jurnal->longitude }};
        
        var map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup('<b>Lokasi Absensi</b><br>{{ $jurnal->siswa->nama ?? '' }}')
            .openPopup();
    </script>
    @endif
</body>
</html>