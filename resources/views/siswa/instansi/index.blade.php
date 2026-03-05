<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pilih Instansi - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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

        .page-header {
            background: #fff;
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .page-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin: 0;
        }

        .btn-ajukan {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-ajukan:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
            color: #fff;
            text-decoration: none;
        }

        .search-box {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin-top: 1rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 3rem 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .search-box input:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
            outline: none;
        }

        .search-box button {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            background: #1e4179;
            border: none;
            color: #fff;
            padding: 0 1.25rem;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-box button:hover {
            background: #2c5aa0;
        }

        .alert-custom {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
        }

        .alert-info-custom {
            background: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }

        .alert-warning-custom {
            background: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        .instansi-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1.5rem;
            align-items: center;
            transition: all 0.3s;
        }

        .instansi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
        }

        .instansi-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e8eef7 0%, #d1dce8 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #1e4179;
            flex-shrink: 0;
        }

        .instansi-info {
            flex: 1;
        }

        .instansi-name {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .instansi-address {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .instansi-meta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #475569;
        }

        .kuota-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .kuota-available {
            background: #d1fae5;
            color: #065f46;
        }

        .kuota-limited {
            background: #fef3c7;
            color: #92400e;
        }

        .kuota-full {
            background: #fecaca;
            color: #991b1b;
        }

        .instansi-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-end;
        }

        .btn-pilih {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .btn-pilih:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            color: #fff;
        }

        .btn-pilih:disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e3e6f0;
        }

        .rejected-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 1rem;
            border-left: 4px solid #dc2626;
        }

        .rejected-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .rejected-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .rejected-status {
            padding: 0.35rem 0.75rem;
            background: #fecaca;
            color: #991b1b;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .rejected-reason {
            background: #fef2f2;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 0.75rem;
        }

        .rejected-reason-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #991b1b;
            margin-bottom: 0.5rem;
        }

        .rejected-reason-text {
            font-size: 0.9rem;
            color: #7f1d1d;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .swal2-popup {
            border-radius: 16px !important;
            padding: 0 !important;
            width: 90% !important;
            max-width: 500px !important;
        }

        .swal2-html-container {
            margin: 0 !important;
            padding: 1rem 1.5rem !important;
        }

        .swal2-actions {
            margin: 0 !important;
            padding: 1rem 1.5rem 1.5rem !important;
            gap: 0.75rem !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            color: #fff !important;
            padding: 0.75rem 2rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4) !important;
        }

        .swal2-cancel {
            background: #fff !important;
            color: #64748b !important;
            padding: 0.75rem 2rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
            border: 2px solid #e2e8f0 !important;
            margin: 0 !important;
            flex: 1 !important;
        }

        .swal2-cancel:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #475569 !important;
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

            .instansi-card {
                flex-direction: column;
                text-align: center;
            }

            .instansi-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .instansi-meta {
                justify-content: center;
            }

            .instansi-actions {
                width: 100%;
                align-items: stretch;
            }

            .btn-pilih {
                width: 100%;
            }

            .page-header-top {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .swal2-popup {
                width: 95% !important;
            }

            .swal2-html-container {
                padding: 1.5rem 1rem !important;
            }

            .swal2-actions {
                flex-direction: column !important;
                padding: 1rem !important;
            }

            .swal2-confirm,
            .swal2-cancel {
                padding: 0.65rem 1.5rem !important;
                font-size: 0.9rem !important;
                width: 100% !important;
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

        @media (max-width: 380px) {
            .swal2-confirm,
            .swal2-cancel {
                padding: 0.6rem 1.25rem !important;
                font-size: 0.85rem !important;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('siswa.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.jurnal.create') }}">
                    <i class="fas fa-pen-square"></i>
                    <span>Catat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.jurnal.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.nilai.index') }}">
                    <i class="fas fa-download"></i>
                    <span>Unduh Nilai</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('siswa.instansi.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Pilih Instansi</span>
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
                        <li class="nav-item">
                            <span class="nav-link text-gray-600 font-weight-bold"></span>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="page-header">
                        <div class="page-header-top">
                            <h1 class="page-title">Pilih Instansi PKL</h1>
                            @if(!$hasInstansi && !$pengajuanPending)
                            <a href="{{ route('siswa.instansi.create') }}" class="btn-ajukan">
                                <i class="fas fa-plus-circle"></i>
                                Ajukan Instansi
                            </a>
                            @endif
                        </div>
                        
                        @if(!$hasInstansi && !$pengajuanPending)
                        <form action="{{ route('siswa.instansi.index') }}" method="GET">
                            <div class="search-box">
                                <input type="text" name="search" placeholder="Cari instansi..." value="{{ $search }}">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>

                    @if($hasInstansi)
                    <div class="alert-info-custom">
                        <i class="fas fa-info-circle ml-1"></i>
                        <span>Anda sudah memiliki instansi PKL. Tidak dapat memilih instansi lagi.</span>
                    </div>
                    @endif

                    @if($pengajuanPending)
                    <div class="alert-warning-custom">
                        <i class="fas fa-clock"></i>
                        <span>Pengajuan instansi Anda sedang diproses oleh admin. Mohon tunggu...</span>
                    </div>
                    @endif

                    @if($pengajuanRejected->count() > 0)
                    <div class="section-title">
                        <i class="fas fa-times-circle"></i> Pengajuan Ditolak
                    </div>
                    @foreach($pengajuanRejected as $rejected)
                    <div class="rejected-card">
                        <div class="rejected-header">
                            <div class="rejected-name">{{ $rejected->nama_perusahaan }}</div>
                            <div class="rejected-status">Ditolak</div>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $rejected->alamat }}
                        </div>
                        @if($rejected->keterangan_reject)
                        <div class="rejected-reason">
                            <div class="rejected-reason-label">Alasan Penolakan:</div>
                            <div class="rejected-reason-text">{{ $rejected->keterangan_reject }}</div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    @endif

                    @if(!$hasInstansi && !$pengajuanPending)
                    <div class="section-title">
                        <i class="fas fa-building"></i> Daftar Instansi Tersedia
                    </div>

                    @if($instansiList->count() > 0)
                        @foreach($instansiList as $instansi)
                        <div class="instansi-card">
                            <div class="instansi-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="instansi-info">
                                <div class="instansi-name">{{ $instansi->nama_instansi }}</div>
                                <div class="instansi-address">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $instansi->alamat }}
                                </div>
                                <div class="instansi-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-industry"></i>
                                        Bidang: {{ $instansi->jurusan_diterima ?? 'Pemasaran' }}
                                    </div>
                                </div>
                            </div>
                            <div class="instansi-actions">
                                @php
                                    $sisaTempat = $instansi->kuota_siswa - $instansi->kuota_terpakai;
                                    $persenKuota = ($instansi->kuota_terpakai / $instansi->kuota_siswa) * 100;
                                    $jurusanMatch = $instansi->jurusan_match ?? false;
                                @endphp
                                
                                @if(!$jurusanMatch)
                                    <span class="kuota-badge kuota-full">Jurusan Tidak Sesuai</span>
                                    <button type="button" class="btn-pilih" disabled>Pilih</button>
                                @elseif($sisaTempat > 0)
                                    <span class="kuota-badge {{ $persenKuota >= 80 ? 'kuota-limited' : 'kuota-available' }}">
                                        {{ $sisaTempat }} / {{ $instansi->kuota_siswa }} Sisa Kuota
                                    </span>
                                    <button type="button" class="btn-pilih" onclick="confirmPilih('{{ $instansi->id_instansi }}', '{{ $instansi->nama_instansi }}')">
                                        Pilih
                                    </button>
                                @else
                                    <span class="kuota-badge kuota-full">Penuh</span>
                                    <button type="button" class="btn-pilih" disabled>Pilih</button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="fas fa-building"></i>
                            <h5>Tidak Ada Instansi Tersedia</h5>
                            <p>{{ $search ? 'Tidak ditemukan instansi dengan kata kunci: "' . $search . '"' : 'Belum ada instansi yang tersedia saat ini' }}</p>
                        </div>
                    @endif
                    @endif
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © COHESION TEAM 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <form id="form-pilih-instansi" action="" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmPilih(id, nama) {
            Swal.fire({
                html: `
                    <div style="padding: 1rem 0;">
                        <h3 style="font-size: 1.5rem; font-weight: 800; color: #1a1a1a; margin-bottom: 0.75rem;">Pilih Instansi?</h3>
                        <p style="font-size: 1rem; color: #64748b; margin-bottom: 1rem;">Anda akan memilih instansi:</p>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #1e4179; margin-bottom: 1rem;">${nama}</p>
                        <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 0.75rem 1rem; border-radius: 8px; margin-top: 1.5rem;">
                            <p style="font-size: 0.875rem; color: #92400e; margin: 0; font-weight: 600;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                Anda hanya bisa memilih instansi 1 kali!
                            </p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>Ya, Pilih',
                cancelButtonText: '<i class="fas fa-times-circle" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('form-pilih-instansi');
                    form.action = `/siswa/instansi/pilih/${id}`;
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>