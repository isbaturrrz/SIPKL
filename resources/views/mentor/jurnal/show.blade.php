<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Jurnal - Mentor</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <style>
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
        .verification-box {
            background: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
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

            <li class="nav-item active">
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
                                    Halo {{ Auth::user()->name }}
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

                        <div class="verification-box">
                            <h5 class="font-weight-bold mb-3">Verifikasi Jurnal Siswa</h5>
                            
                            @if($jurnal->status_verifikasi == 'pending')
                                <div>
                                    <form action="{{ route('mentor.jurnal.verify', $jurnal->id_jurnal) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-lg px-5 mr-2" onclick="return confirm('Verifikasi jurnal ini?')">
                                            <i class="fas fa-check"></i> Verified
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-lg px-5" data-toggle="modal" data-target="#rejectModal">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </div>
                            @elseif($jurnal->status_verifikasi == 'verified')
                                <div class="alert alert-success mb-0">
                                    <h5><i class="fas fa-check-circle"></i> Jurnal Terverifikasi</h5>
                                    <p class="mb-0">Diverifikasi oleh: <strong>{{ $jurnal->verifiedBy->name ?? '-' }}</strong></p>
                                    <small>{{ $jurnal->verified_at ? $jurnal->verified_at->format('d M Y H:i') : '-' }}</small>
                                </div>
                            @else
                                <div class="alert alert-danger mb-0">
                                    <h5><i class="fas fa-times-circle"></i> Jurnal Ditolak</h5>
                                    <p class="mb-0">Ditolak oleh: <strong>{{ $jurnal->verifiedBy->name ?? '-' }}</strong></p>
                                    <small class="d-block mb-2">{{ $jurnal->verified_at ? $jurnal->verified_at->format('d M Y H:i') : '-' }}</small>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewRejectModal">
                                        <i class="fas fa-info-circle"></i> Lihat Keterangan
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('mentor.jurnal.index') }}" class="btn btn-secondary">
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

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-times-circle"></i> Tolak Jurnal
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('mentor.jurnal.reject', $jurnal->id_jurnal) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keterangan_reject">Keterangan Penolakan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('keterangan_reject') is-invalid @enderror" 
                                      id="keterangan_reject" 
                                      name="keterangan_reject" 
                                      rows="5" 
                                      placeholder="Masukkan alasan penolakan jurnal..."
                                      required></textarea>
                            @error('keterangan_reject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-check"></i> Tolak Jurnal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewRejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle"></i> Keterangan Penolakan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h6 class="font-weight-bold">Alasan Penolakan:</h6>
                        <p class="mb-0">{{ $jurnal->keterangan_reject ?? '-' }}</p>
                    </div>
                    <div class="text-muted">
                        <small>
                            <i class="fas fa-user"></i> Ditolak oleh: {{ $jurnal->verifiedBy->name ?? '-' }}<br>
                            <i class="fas fa-clock"></i> Waktu: {{ $jurnal->verified_at ? $jurnal->verified_at->format('d M Y H:i') : '-' }}
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                </div>
            </div>
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