<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Input Nilai - Mentor</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }

        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #182151 0%, #3F7FB6 50%, #010B40 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-logo {
            width: 120px;
            height: auto;
            margin-bottom: 2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loader-text {
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 1.5rem;
            letter-spacing: 0.5px;
        }

        .form-control{
            padding: .375rem .20rem;
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

        .table-card {
            background: #fff;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e3e6f0;
        }

        .table-header h5 {
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            font-size: 1.1rem;
        }

        .nilai-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .nilai-table thead {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
        }

        .nilai-table thead th {
            color: #fff;
            font-weight: 700;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            border: none;
            vertical-align: middle;
        }

        .nilai-table tbody tr {
            border-bottom: 1px solid #e3e6f0;
            transition: all 0.2s;
        }

        .nilai-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .nilai-table tbody td {
            padding: 0.875rem 1rem;
            font-size: 0.9rem;
            color: #334155;
            vertical-align: middle;
            border-bottom: 1px solid #e3e6f0;
        }

        .nilai-table tbody td:first-child {
            text-align: center;
            font-weight: 600;
            color: #1a1a1a;
        }

        .nilai-table tfoot td {
            padding: 0.875rem 1rem;
            font-size: 0.9rem;
            font-weight: 700;
            color: #1a1a1a;
            text-align: center;
            background-color: #f8f9fc;
            border-top: 2px solid #e3e6f0;
        }

        .box-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .box-summary .summary-item {
            padding: 1rem 1.5rem;
            text-align: center;
        }

        .box-summary .summary-item:first-child {
            border-right: 1px solid #e3e6f0;
        }

        .box-summary .summary-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 0.25rem;
        }

        .box-summary .summary-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #182151;
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
            cursor: pointer;
        }

        .btn-save-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-save-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
            color: #fff;
        }

        .btn-secondary-custom {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary-custom:hover {
            background: #475569;
            color: #fff;
            text-decoration: none;
            transform: translateY(-2px);
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
            padding: 0 1.5rem 0 1.5rem !important;
            font-size: 0.9rem !important;
            color: #64748b !important;
            line-height: 1.5 !important;
        }

        .swal2-actions {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            gap: 0.75rem !important;
            display: flex !important;
            width: 100% !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4) !important;
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

        .bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 0.5rem 0;
        }

        .bottom-nav-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 100%;
            margin: 0 auto;
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.75rem;
            text-decoration: none;
            color: #64748b;
            font-size: 0.7rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            flex: 1;
            max-width: 80px;
        }

        .bottom-nav-item i {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .bottom-nav-item.active {
            color: #182151;
        }

        .bottom-nav-item.active i {
            transform: scale(1.1);
        }

        .bottom-nav-item span {
            font-size: 0.65rem;
        }

        .more-menu {
            position: fixed;
            bottom: 70px;
            right: 1rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 999;
        }

        .more-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .more-menu-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #334155;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .more-menu-item:hover {
            background: #f8fafc;
            color: #182151;
        }

        .more-menu-item.active {
            background: #f1f5f9;
            color: #182151;
        }

        .more-menu-item i {
            margin-right: 0.75rem;
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .more-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 998;
        }

        .more-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none !important;
            }

            .topbar {
                display: none !important;
            }

            #content-wrapper {
                margin-left: 0 !important;
            }

            .bottom-nav {
                display: block;
            }

            .container-fluid {
                padding: 1rem 1rem 5rem 1rem;
            }

            .sticky-footer {
                display: none;
            }

            .sidebar-brand {
                padding: 1rem 0.5rem !important;
            }

            .sidebar-brand-icon img {
                max-width: 80px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 60px;
            }

            .btn-save-custom {
                width: 100%;
                justify-content: center;
            }

            .btn-secondary-custom {
                justify-content: center;
                width: 100%
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

            .swal2-title {
                font-size: 1.1rem !important;
                padding: 0 1rem !important;
                margin-bottom: 0.5rem !important;
            }

            .swal2-html-container {
                padding: 0 1rem 0 1rem !important;
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

            .bottom-nav-item {
                font-size: 0.65rem;
            }

            .bottom-nav-item i {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 400px) {
            .swal2-popup {
                width: 95% !important;
                max-width: 300px !important;
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
    <div id="page-loader">
        <img src="{{ asset('dist_mentor/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Formulir...</div>
    </div>

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

            <li class="nav-item active">
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

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Data Siswa</h5>
                        </div>
                        <div style="padding: 1.25rem 2rem;">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="100" class="font-weight-bold">Nama</td>
                                    <td>: {{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kelas</td>
                                    <td>: {{ $siswa->kelas_lengkap }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <form id="nilaiForm" action="{{ route('mentor.nilai.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">

                        <div class="table-card">
                            <div class="table-header">
                                <h5>Form Penilaian</h5>
                            </div>
                            <div style="padding: 1.5rem 2rem;">
                                <div class="box-summary">
                                    <div class="summary-item">
                                        <div class="summary-label">Nilai Akhir</div>
                                        <div class="summary-value" id="display-rata-rata">0.00</div>
                                    </div>
                                    <div class="summary-item">
                                        <div class="summary-label">Huruf / Predikat</div>
                                        <div class="summary-value" id="display-huruf">-</div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="nilai-table">
                                        <thead>
                                            <tr>
                                                <th width="50">No</th>
                                                <th>Aspek yang Dinilai</th>
                                                <th width="200">Nilai</th>
                                                <th width="150">Predikat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Kedisiplinan</td>
                                                <td><input type="number" name="nilai_kedisiplinan" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Kreatifitas</td>
                                                <td><input type="number" name="nilai_kreatifitas" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Tanggung Jawab</td>
                                                <td><input type="number" name="nilai_tanggung_jawab" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Kerjasama</td>
                                                <td><input type="number" name="nilai_kerjasama" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Komunikasi</td>
                                                <td><input type="number" name="nilai_komunikasi" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">Rata-Rata</td>
                                                <td id="total-score">0</td>
                                                <td>-</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold text-dark">Keterangan Tambahan (opsional)</label>
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Sangat baik dalam bekerja tim..."></textarea>
                                </div>

                                <div class="mt-4 text-right">
                                    <a href="{{ route('mentor.nilai.index') }}" class="btn-action btn-secondary-custom">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="button" id="btnSimpan" class="btn-action btn-save-custom">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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

    <div class="more-menu-overlay" id="moreMenuOverlay"></div>
    <div class="more-menu" id="moreMenu">
        <a href="{{ route('mentor.riwayat.index') }}" class="more-menu-item">
            <i class="fas fa-history"></i>
            <span>Riwayat Jurnal</span>
        </a>
        <a href="{{ route('mentor.nilai.index') }}" class="more-menu-item active">
            <i class="fas fa-star"></i>
            <span>Nilai Siswa</span>
        </a>
        <a href="#" class="more-menu-item" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <nav class="bottom-nav">
        <div class="bottom-nav-container">
            <a href="{{ route('mentor.dashboard') }}" class="bottom-nav-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('mentor.siswa.index') }}" class="bottom-nav-item">
                <i class="fas fa-users"></i>
                <span>Siswa</span>
            </a>
            <a href="{{ route('mentor.jurnal.index') }}" class="bottom-nav-item">
                <i class="fas fa-clipboard-check"></i>
                <span>Verifikasi</span>
            </a>
            <a href="#" class="bottom-nav-item active" id="moreBtn">
                <i class="fas fa-ellipsis-h"></i>
                <span>Lainnya</span>
            </a>
        </div>
    </nav>

    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('page-loader').classList.add('hidden');
            }, 800);
        });

        const moreBtn = document.getElementById('moreBtn');
        const moreMenu = document.getElementById('moreMenu');
        const moreMenuOverlay = document.getElementById('moreMenuOverlay');

        moreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            moreMenu.classList.toggle('active');
            moreMenuOverlay.classList.toggle('active');
        });

        moreMenuOverlay.addEventListener('click', function() {
            moreMenu.classList.remove('active');
            moreMenuOverlay.classList.remove('active');
        });

        document.querySelectorAll('.more-menu-item').forEach(function(item) {
            item.addEventListener('click', function() {
                moreMenu.classList.remove('active');
                moreMenuOverlay.classList.remove('active');
            });
        });
        
        $(document).ready(function () {
            $('.input-score').on('input', function () {
                let total = 0;
                let count = 0;

                $('.input-score').each(function () {
                    let val = parseFloat($(this).val()) || 0;
                    if (val > 100) { $(this).val(100); val = 100; }

                    total += val;
                    count++;

                    let p = getPredikat(val);
                    $(this).closest('tr').find('.row-predikat').text(val > 0 ? p : '-');
                });

                let rataRata = total / count;
                $('#total-score').text(rataRata.toFixed(2));
                $('#display-rata-rata').text(rataRata.toFixed(2));
                $('#display-huruf').text(rataRata > 0 ? getPredikat(rataRata) : '-');
            });

            function getPredikat(n) {
                if (n >= 90) return 'A';
                if (n >= 80) return 'B';
                if (n >= 70) return 'C';
                if (n >= 60) return 'D';
                return 'E';
            }

            document.getElementById('btnSimpan').addEventListener('click', function (e) {
                e.preventDefault();

                const form = document.getElementById('nilaiForm');
                const inputs = form.querySelectorAll('.input-score');
                let allFilled = true;

                inputs.forEach(function (input) {
                    if (input.value === '' || input.value === null) {
                        allFilled = false;
                    }
                });

                if (!allFilled) {
                    Swal.fire({
                        html: `
                            <div style="padding: 0.5rem 0;">
                                <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                    <i class="fas fa-exclamation-circle" style="font-size: 1.75rem; color: #dc2626;"></i>
                                </div>
                                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Data Belum Lengkap</h3>
                                <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Harap isi semua nilai aspek penilaian sebelum menyimpan.</p>
                            </div>
                        `,
                        showCancelButton: false,
                        confirmButtonText: '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Oke',
                        buttonsStyling: true
                    });
                    return;
                }

                const namaSiswa = "{{ $siswa->nama }}";
                const kelasSiswa = "{{ $siswa->kelas_lengkap }}";
                const nilaiAkhir = $('#display-rata-rata').text();
                const predikat = $('#display-huruf').text();

                Swal.fire({
                    html: `
                        <div style="padding: 0.5rem 0;">
                            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-save" style="font-size: 1.75rem; color: #10b981;"></i>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Simpan Nilai Siswa</h3>
                            <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menyimpan nilai berikut?</p>

                            <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                                <table style="width: 100%; font-size: 0.85rem;">
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 40%;">Nama Siswa:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${namaSiswa}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Kelas:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kelasSiswa}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nilai Akhir:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nilaiAkhir}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Predikat:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${predikat}</td>
                                    </tr>
                                </table>
                            </div>

                            <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                                <p style="font-size: 0.8rem; color: #065f46; margin: 0; font-weight: 600;">
                                    <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                                    Nilai yang disimpan akan tercatat sebagai nilai akhir siswa
                                </p>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-save" style="margin-right: 0.5rem;"></i>Simpan',
                    cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                    reverseButtons: true,
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('nilaiForm').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>