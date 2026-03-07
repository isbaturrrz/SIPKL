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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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

        .detail-card {
            border: none;
            border-radius: 8px;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .detail-header {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
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

        .foto-kegiatan-box {
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin-top: 15px;
        }

        .foto-kegiatan-box img {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .foto-kegiatan-box img:hover {
            transform: scale(1.02);
        }

        .foto-kegiatan-box small {
            display: block;
            margin-top: 10px;
            color: #6c757d;
        }

        .modal-foto {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-foto-content {
            position: relative;
            margin: auto;
            padding: 20px;
            width: 90%;
            max-width: 900px;
            top: 50%;
            transform: translateY(-50%);
        }

        .modal-foto-content img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .modal-foto-close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10000;
            transition: color 0.3s;
        }

        .modal-foto-close:hover,
        .modal-foto-close:focus {
            color: #f1f5f9;
        }

        #map {
            width: 100%;
            height: 350px;
            border-radius: 8px;
            border: 1px solid #d1d3e2;
            margin-top: 15px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .btn-verify-custom {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-verify-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
            color: #fff;
        }

        .btn-reject-custom {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .btn-reject-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4);
            color: #fff;
        }

        .btn-secondary-custom {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary-custom:hover {
            background: #475569;
            color: #fff;
        }

        .swal2-popup {
            border-radius: 16px !important;
            padding: 0 !important;
            width: 85% !important;
            max-width: 450px !important;
        }

        .swal2-icon {
            width: 60px !important;
            height: 60px !important;
            margin: 1.5rem auto 1rem !important;
            border-width: 3px !important;
        }

        .swal2-icon.swal2-success {
            border-color: #10b981 !important;
        }

        .swal2-icon.swal2-success [class^='swal2-success-line'] {
            background-color: #10b981 !important;
        }

        .swal2-icon.swal2-success .swal2-success-ring {
            border-color: rgba(16, 185, 129, 0.3) !important;
        }

        .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark {
            display: block !important;
        }

        .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
            display: block !important;
            position: absolute !important;
            height: 3px !important;
            width: 30px !important;
            background-color: #ef4444 !important;
            border-radius: 2px !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark-line-left {
            top: 28px !important;
            left: 15px !important;
            transform: rotate(45deg) !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark-line-right {
            top: 28px !important;
            right: 15px !important;
            transform: rotate(-45deg) !important;
        }

        .swal2-icon .swal2-icon-content {
            font-size: 2.5rem !important;
        }

        .swal2-title {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #1a1a1a !important;
            padding: 0 1.5rem !important;
            margin-bottom: 0.75rem !important;
            line-height: 1.3 !important;
        }

        .swal2-html-container {
            margin: 0 !important;
            padding: 0 1.5rem 0 1.5rem!important;
            font-size: 0.9rem !important;
            color: #64748b !important;
            line-height: 1.5 !important;
        }

        .swal2-input,
        .swal2-textarea {
            border: 2px solid #e2e8f0 !important;
            border-radius: 8px !important;
            padding: 0.75rem !important;
            font-size: 0.9rem !important;
            margin: 0 0.75rem 1rem 0.75rem !important;
        }

        .swal2-input:focus,
        .swal2-textarea:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .swal2-actions {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            gap: 0.75rem !important;
            display: flex !important;
            width: 100% !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4)!important;
        }

        .swal2-confirm.swal2-confirm-reject {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3) !important;
        }

        .swal2-confirm.swal2-confirm-reject:hover {
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4) !important;
        }

        .swal2-cancel {
            background: #fff !important;
            color: #64748b !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: 2px solid #e2e8f0 !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-cancel:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #475569 !important;
        }

        .swal2-styled:focus {
            box-shadow: none !important;
        }

        .swal2-validation-message {
            background: #fef2f2 !important;
            border: 1px solid #fecaca !important;
            color: #991b1b !important;
            border-radius: 8px !important;
            padding: 0.75rem !important;
            margin: 0.5rem 0 0 0 !important;
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

            .verification-box {
                padding: 15px;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .foto-kegiatan-box img {
                max-width: 100%;
            }

            .modal-foto-content {
                width: 95%;
                padding: 10px;
            }

            .modal-foto-close {
                font-size: 30px;
                top: 5px;
                right: 15px;
            }

            .swal2-popup {
                width: 90% !important;
                max-width: 380px !important;
            }
        }

        @media (max-width: 576px) {
            .swal2-popup {
                width: 92% !important;
                max-width: 340px !important;
            }
            
            .swal2-icon {
                width: 56px !important;
                height: 56px !important;
                margin: 1.25rem auto 0.75rem !important;
            }
            
            .swal2-title {
                font-size: 1.1rem !important;
                padding: 0 1rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .swal2-html-container {
                padding: 0 1rem 0 1rem!important;
                font-size: 0.85rem !important;
            }
            
            .swal2-actions {
                padding: 0 1rem 1.25rem !important;
                gap: 0.5rem !important;
            }
            
            .swal2-confirm,
            .swal2-cancel {
                padding: 0.6rem 1.25rem !important;
                font-size: 0.85rem !important;
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

        @media (max-width: 400px) {
            .swal2-popup {
                width: 95% !important;
                max-width: 300px !important;
            }
            
            .swal2-icon {
                width: 48px !important;
                height: 48px !important;
                margin: 1rem auto 0.5rem !important;
            }
            
            .swal2-title {
                font-size: 1rem !important;
                padding: 0 0.75rem !important;
            }
            
            .swal2-html-container {
                padding: 0 0.75rem 1rem !important;
                font-size: 0.8rem !important;
            }
            
            .swal2-actions {
                padding: 0 0.75rem 1rem !important;
                flex-direction: column !important;
                gap: 0.5rem !important;
            }
            
            .swal2-confirm,
            .swal2-cancel {
                padding: 0.55rem 1rem !important;
                font-size: 0.8rem !important;
                width: 100% !important;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('mentor.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_mentor/img/logo.png')}}" alt="IPKL">
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
                <a class="nav-link" href="{{ route('mentor.nilai.index') }}">
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
                                    <h5 class="mb-1 font-weight-bold">Detail Jurnal Siswa</h5>
                                    <small>{{ $jurnal->tgl ? $jurnal->tgl->format('l, d F Y') : '-' }}</small>
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
                                        @if($jurnal->status_kehadiran == 'wfo')
                                            <span class="badge badge-success">WFO</span>
                                        @elseif($jurnal->status_kehadiran == 'wfh')
                                            <span class="badge badge-success">WFH</span>
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
                                <label class="font-weight-bold">Waktu</label>
                                <input type="text" class="form-control" value="{{ $jurnal->verified_at->format('d F Y H:i') }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Kegiatan yang Dilakukan :</label>
                            <div class="textarea-detail">
                                {{ $jurnal->kegiatan ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Manfaat yang Didapat :</label>
                            <div class="textarea-detail">
                                {{ $jurnal->manfaat ?? '-' }}
                            </div>
                        </div>

                        @if($jurnal->foto_kegiatan)
                        <div class="mb-3">
                            <label class="font-weight-bold">Bukti Foto Kegiatan :</label>
                            <div class="foto-kegiatan-box">
                                <img src="{{ asset('storage/' . $jurnal->foto_kegiatan) }}" 
                                     alt="Foto Kegiatan" 
                                     onclick="openModal()">
                                <small>
                                    <i class="fas fa-info-circle"></i> Klik foto untuk memperbesar
                                </small>
                            </div>
                        </div>
                        @endif

                        @if($jurnal->latitude && $jurnal->longitude)
                        <div class="mb-4">
                            <label class="font-weight-bold">Lokasi Presensi :</label>
                            <div id="map"></div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> Koordinat: {{ $jurnal->latitude }}, {{ $jurnal->longitude }}
                                </small>
                            </div>
                        </div>
                        @endif

                        <div class="verification-box">
                            <h5 class="font-weight-bold mb-3">Verifikasi Jurnal Siswa</h5>
                            
                            @if($jurnal->status_verifikasi == 'pending')
                                <div>
                                    <form id="verifyForm" action="{{ route('mentor.jurnal.verify', $jurnal->id_jurnal) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="button" id="btnVerify" class="btn-action btn-verify-custom">
                                            <i class="fas fa-check"></i> Verified
                                        </button>
                                    </form>
                                    <button type="button" id="btnReject" class="btn-action btn-reject-custom">
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
                            <a href="{{ route('mentor.jurnal.index') }}" class="btn-action btn-secondary-custom">
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

    <div id="modalFoto" class="modal-foto">
        <span class="modal-foto-close" onclick="closeModal()">&times;</span>
        <div class="modal-foto-content">
            <img src="{{ asset('storage/' . ($jurnal->foto_kegiatan ?? '')) }}" alt="Foto Kegiatan">
        </div>
    </div>

    <form id="rejectForm" action="{{ route('mentor.jurnal.reject', $jurnal->id_jurnal) }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="keterangan_reject" id="rejectReason">
    </form>

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
    
    @if($jurnal->latitude && $jurnal->longitude)
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const lat = {{ $jurnal->latitude }};
        const lng = {{ $jurnal->longitude }};
        
        const map = L.map('map').setView([lat, lng], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        L.marker([lat, lng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(map).bindPopup('<b>Lokasi Presensi</b>').openPopup();
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openModal() {
            document.getElementById('modalFoto').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalFoto').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalFoto');
            if (event.target == modal) {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        document.getElementById('btnVerify')?.addEventListener('click', function(e) {
            e.preventDefault();
            
            const siswa = "{{ $jurnal->siswa->nama ?? '-' }}";
            const tanggal = "{{ $jurnal->tgl ? $jurnal->tgl->format('d/m/Y') : '-' }}";
            const jam = "{{ $jurnal->jam_mulai ?? '00:00' }} - {{ $jurnal->jam_selesai ?? '00:00' }}";

            const confirmHTML = `
                <div style="padding: 0.5rem 0;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-check-circle" style="font-size: 1.75rem; color: #10b981;"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Verifikasi Jurnal Siswa</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin memverifikasi jurnal berikut?</p>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                        <table style="width: 100%; font-size: 0.85rem;">
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Nama Siswa:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${siswa}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Tanggal:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${tanggal}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Jam:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${jam}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                        <p style="font-size: 0.8rem; color: #065f46; margin: 0; font-weight: 600;">
                            <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                            Jurnal yang diverifikasi akan masuk ke riwayat
                        </p>
                    </div>
                </div>
            `;

            Swal.fire({
                html: confirmHTML,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Ya, Verifikasi',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('verifyForm').submit();
                }
            });
        });

        document.getElementById('btnReject')?.addEventListener('click', function(e) {
            e.preventDefault();
            
            const siswa = "{{ $jurnal->siswa->nama ?? '-' }}";
            const tanggal = "{{ $jurnal->tgl ? $jurnal->tgl->format('d/m/Y') : '-' }}";

            Swal.fire({
                html: `
                    <div style="padding: 0.5rem 0 0 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-times-circle" style="font-size: 1.75rem; color: #dc2626;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Tolak Jurnal Siswa</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 0.5rem;">Nama Siswa: <strong>${siswa}</strong></p>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Tanggal: <strong>${tanggal}</strong></p>
                    </div>
                `,
                input: 'textarea',
                inputPlaceholder: 'Masukkan alasan penolakan jurnal...',
                inputAttributes: {
                    'aria-label': 'Alasan penolakan',
                    'style': 'min-height: 100px; padding: 10px;'
                },
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Tolak Jurnal',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true,
                customClass: {
                    confirm: 'swal2-confirm-reject'
                },
                inputValidator: (value) => {
                    if (!value) {
                        return 'Alasan penolakan harus diisi!';
                    }
                    if (value.length < 10) {
                        return 'Alasan penolakan minimal 10 karakter!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('rejectReason').value = result.value;
                    document.getElementById('rejectForm').submit();
                }
            });
        });
    </script>
</body>
</html>