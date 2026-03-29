<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jurnal Siswa - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist_guru/css/style.css') }}">
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

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .topbar .nav-item .nav-link {
            height: 4.375rem;
            display: flex;
            align-items: center;
        }

        #content {
            background-color: #e8eef7;
            min-height: 100vh;
        }

        .stat-card {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            border-radius: 10px;
            padding: 20px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            max-width: 350px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin-top: 10px;
        }

        .stat-card .stat-label {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            opacity: 0.9;
        }

        .stat-card .stat-icon {
            font-size: 28px;
            opacity: 0.5;
        }

        .chart-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #1e3a6e;
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

        .btn-add {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            border: none;
            color: #fff;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(30, 65, 121, 0.3);
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #2c5aa0 0%, #3a6bb5 100%);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.4);
        }

        .search-box select,
        .search-box input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.3s;
        }

        .search-box select:focus,
        .search-box input:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
            outline: none;
        }

        .search-box button {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
            border: none;
            color: #fff;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .search-box button:hover {
            background: #2c5aa0;
        }

        .btn-reset {
            background: #6c757d;
            border: none;
            color: #fff;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-reset:hover {
            background: #5a6268;
            color: #fff;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .jurnal-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .jurnal-table thead {
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
        }

        .jurnal-table thead th {
            color: #fff;
            font-weight: 700;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            border: none;
        }

        .jurnal-table tbody tr {
            border-bottom: 1px solid #e3e6f0;
            transition: all 0.2s;
        }

        .jurnal-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .jurnal-table tbody td {
            padding: 1rem;
            text-align: center;
            font-size: 0.9rem;
            color: #334155;
            vertical-align: middle;
        }

        .jurnal-table tbody td:first-child {
            font-weight: 600;
            color: #1a1a1a;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .badge-danger {
            background: #fecaca;
            color: #991b1b;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin: 0 0.15rem;
        }

        .btn-info {
            background: #4f46e5;
            color: #fff;
        }

        .btn-info:hover {
            background: #4338ca;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-warning {
            background: #f59e0b;
            color: #fff;
        }

        .btn-warning:hover {
            background: #d97706;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
            margin-top: 5px;
        }

        .btn-danger:hover {
            background: #dc2626;
            color: #fff;
            transform: translateY(-1px);
        }

        .pagination-wrapper {
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            margin: 0;
        }

        .page-item .page-link {
            width: 40px;
            height: 40px;
            border: 2px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            padding: 0;
        }

        .page-item .page-link:hover {
            border-color: #2c5aa0;
            color: #2c5aa0;
            background: #f8fafc;
        }

        .page-item.active .page-link {
            background: #2c5aa0;
            color: #fff;
            border-color: #2c5aa0;
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
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
            color: #64748b;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #94a3b8;
            font-size: 0.9rem;
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

        .swal2-icon.swal2-warning {
            border-color: #6495ed !important;
            color: #f59e0b !important;
        }

        .swal2-icon.swal2-info {
            border-color: #3b82f6 !important;
            color: #3b82f6 !important;
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
            padding: 0 1.5rem 1.5rem !important;
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

        .swal2-confirm.swal2-confirm-single {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%) !important;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3) !important;
        }

        .swal2-confirm.swal2-confirm-single:hover {
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4) !important;
        }

        .sticky-footer {
            background-color: #fff;
            border-top: 1px solid #e3e6f0;
        }

        .copyright {
            font-size: 0.85rem;
            color: #858796;
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

            .swal2-popup {
                width: 90% !important;
                max-width: 380px !important;
            }

            .jurnal-table {
                font-size: 0.8rem;
            }

            .jurnal-table thead th,
            .jurnal-table tbody td {
                padding: 0.75rem 0.5rem;
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
                padding: 0 1rem 1.25rem !important;
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

    <div id="page-loader">
        <img src="{{ asset('dist_guru/img/logo.png') }}" alt="Logo" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Halaman...</div>
    </div>

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guru.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_guru/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-th-large"></i>
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

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="{{ route('guru.jurnal.create') }}" class="btn-add">
                            <i class="fas fa-plus"></i> Tambah Jurnal
                        </a>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Jurnal Terverifikasi</div>
                                        <div class="stat-value">{{ $jurnalsVerified->total() }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Jurnal Belum Terverifikasi</div>
                                        <div class="stat-value">{{ $jurnalsUnverified->total() }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Filter Jurnal</h5>
                        </div>
                        <div style="padding: 1.5rem 2rem;">
                            <form method="GET" action="{{ route('guru.jurnal.index') }}">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label style="font-weight: 600; color: #1a1a1a; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Filter Siswa</label>
                                        <div class="search-box">
                                            <select name="siswa_id">
                                                <option value="">-- Semua Siswa --</option>
                                                @foreach($siswaList as $siswa)
                                                <option value="{{ $siswa->id_siswa }}" {{ request('siswa_id') == $siswa->id_siswa ? 'selected' : '' }}>
                                                    {{ $siswa->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label style="font-weight: 600; color: #1a1a1a; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Filter Tanggal</label>
                                        <div class="search-box">
                                            <input type="date" name="tanggal" value="{{ request('tanggal') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label style="font-weight: 600; color: #1a1a1a; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Filter Bulan</label>
                                        <div class="search-box">
                                            <input type="month" name="bulan" value="{{ request('bulan') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="search-box" style="max-width: 100%; display: flex; gap: 0.75rem;">
                                            <button type="submit">
                                                <i class="fas fa-search"></i> Cari
                                            </button>
                                            <a href="{{ route('guru.jurnal.index') }}" class="btn-reset">
                                                <i class="fas fa-sync"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <h5 style="color: #fff;">Data Jurnal Siswa (Belum Terverifikasi)</h5>
                        </div>

                        <div class="table-responsive">
                            @if($jurnalsUnverified->count() > 0)
                            <table class="jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Siswa</th>
                                        <th>Jam</th>
                                        <th>Kehadiran</th>
                                        <th>Kegiatan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jurnalsUnverified as $index => $jurnal)
                                    <tr>
                                        <td>{{ $jurnalsUnverified->firstItem() + $index }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}</td>
                                        <td>{{ $jurnal->siswa->nama }}</td>
                                        <td>{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}</td>
                                        <td>
                                            @if($jurnal->status_kehadiran == 'wfo')
                                                <span class="status-badge badge-success">WFO</span>
                                            @elseif($jurnal->status_kehadiran == 'wfh')
                                                <span class="status-badge badge-success">WFH</span>
                                            @elseif($jurnal->status_kehadiran == 'izin')
                                                <span class="status-badge badge-warning">Izin</span>
                                            @elseif($jurnal->status_kehadiran == 'sakit')
                                                <span class="status-badge badge-info">Sakit</span>
                                            @elseif($jurnal->status_kehadiran == 'libur')
                                                <span class="status-badge badge-secondary">Libur</span>
                                            @else
                                                <span class="status-badge badge-danger">Alfa</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($jurnal->kegiatan, 50) }}</td>
                                        <td>
                                            <span class="status-badge badge-warning">Pending</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('guru.jurnal.edit', $jurnal->id_jurnal) }}" class="btn-action btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('guru.jurnal.destroy', $jurnal->id_jurnal) }}" method="POST" class="d-inline delete-form"
                                                  data-tanggal="{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}"
                                                  data-siswa="{{ $jurnal->siswa->nama }}"
                                                  data-jam="{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}"
                                                  data-kegiatan="{{ Str::limit($jurnal->kegiatan, 60) }}"
                                                  data-status="Belum Terverifikasi">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-danger btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h5>Tidak Ada Data</h5>
                                <p>Tidak ada data jurnal yang belum terverifikasi</p>
                            </div>
                            @endif
                        </div>
                        
                        @if($jurnalsUnverified->hasPages())
                        <div class="pagination-wrapper">
                            <div class="pagination-info">
                                Menampilkan {{ $jurnalsUnverified->firstItem() ?? 0 }} - {{ $jurnalsUnverified->lastItem() ?? 0 }} dari {{ $jurnalsUnverified->total() }} data
                            </div>
                            <div class="pagination">
                                @if($jurnalsUnverified->onFirstPage())
                                <span class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </span>
                                @else
                                <span class="page-item">
                                    <a href="{{ $jurnalsUnverified->previousPageUrl() }}" class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </span>
                                @endif

                                @foreach($jurnalsUnverified->getUrlRange(1, $jurnalsUnverified->lastPage()) as $page => $url)
                                <span class="page-item {{ $page == $jurnalsUnverified->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </span>
                                @endforeach

                                @if($jurnalsUnverified->hasMorePages())
                                <span class="page-item">
                                    <a href="{{ $jurnalsUnverified->nextPageUrl() }}" class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </span>
                                @else
                                <span class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="table-card">
                        <div class="table-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <h5 style="color: #fff;">Data Jurnal Siswa (Terverifikasi Pembimbing Instansi)</h5>
                        </div>

                        <div class="table-responsive">
                            @if($jurnalsVerified->count() > 0)
                            <table class="jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Siswa</th>
                                        <th>Jam</th>
                                        <th>Kehadiran</th>
                                        <th>Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jurnalsVerified as $index => $jurnal)
                                    <tr>
                                        <td>{{ $jurnalsVerified->firstItem() + $index }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}</td>
                                        <td>{{ $jurnal->siswa->nama }}</td>
                                        <td>{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}</td>
                                        <td>
                                            @if($jurnal->status_kehadiran == 'wfo')
                                                <span class="status-badge badge-success">WFO</span>
                                            @elseif($jurnal->status_kehadiran == 'wfh')
                                                <span class="status-badge badge-success">WFH</span>
                                            @elseif($jurnal->status_kehadiran == 'izin')
                                                <span class="status-badge badge-warning">Izin</span>
                                            @elseif($jurnal->status_kehadiran == 'sakit')
                                                <span class="status-badge badge-info">Sakit</span>
                                            @elseif($jurnal->status_kehadiran == 'libur')
                                                <span class="status-badge badge-secondary">Libur</span>
                                            @else
                                                <span class="status-badge badge-danger">Alfa</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($jurnal->kegiatan, 50) }}</td>
                                        <td>
                                            <a href="{{ route('guru.jurnal.show', $jurnal->id_jurnal) }}" class="btn-action btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('guru.jurnal.destroy', $jurnal->id_jurnal) }}" method="POST" class="d-inline delete-form"
                                                  data-tanggal="{{ \Carbon\Carbon::parse($jurnal->tgl)->format('d/m/Y') }}"
                                                  data-siswa="{{ $jurnal->siswa->nama }}"
                                                  data-jam="{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}"
                                                  data-kegiatan="{{ Str::limit($jurnal->kegiatan, 60) }}"
                                                  data-status="Terverifikasi">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-danger btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h5>Tidak Ada Data</h5>
                                <p>Tidak ada data jurnal yang terverifikasi</p>
                            </div>
                            @endif
                        </div>
                        
                        @if($jurnalsVerified->hasPages())
                        <div class="pagination-wrapper">
                            <div class="pagination-info">
                                Menampilkan {{ $jurnalsVerified->firstItem() ?? 0 }} - {{ $jurnalsVerified->lastItem() ?? 0 }} dari {{ $jurnalsVerified->total() }} data
                            </div>
                            <div class="pagination">
                                @if($jurnalsVerified->onFirstPage())
                                <span class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </span>
                                @else
                                <span class="page-item">
                                    <a href="{{ $jurnalsVerified->previousPageUrl() }}" class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </span>
                                @endif

                                @foreach($jurnalsVerified->getUrlRange(1, $jurnalsVerified->lastPage()) as $page => $url)
                                <span class="page-item {{ $page == $jurnalsVerified->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </span>
                                @endforeach

                                @if($jurnalsVerified->hasMorePages())
                                <span class="page-item">
                                    <a href="{{ $jurnalsVerified->nextPageUrl() }}" class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </span>
                                @else
                                <span class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
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

    <div class="more-menu-overlay" id="moreMenuOverlay"></div>

    <div class="more-menu" id="moreMenu">
        <a href="#" class="more-menu-item" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <nav class="bottom-nav">
        <div class="bottom-nav-container">
            <a href="{{ route('guru.dashboard') }}" class="bottom-nav-item">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('guru.siswa.index') }}" class="bottom-nav-item">
                <i class="fas fa-users"></i>
                <span>Siswa</span>
            </a>
            <a href="{{ route('guru.jurnal.index') }}" class="bottom-nav-item active">
                <i class="fas fa-book"></i>
                <span>Jurnal</span>
            </a>
            <a href="#" class="bottom-nav-item" id="moreBtn">
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
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

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('.delete-form');
                const tanggal = form.getAttribute('data-tanggal');
                const siswa = form.getAttribute('data-siswa');
                const status = form.getAttribute('data-status');

                const confirmHTML = `
                    <div style="padding: 0.5rem 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-book" style="font-size: 1.75rem; color: #dc2626;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Hapus Jurnal</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menghapus jurnal berikut?</p>
                        
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                            <table style="width: 100%; font-size: 0.85rem;">
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Tanggal:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${tanggal}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nama Siswa:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${siswa}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${status}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                            <p style="font-size: 0.8rem; color: #991b1b; margin: 0; font-weight: 600;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                Data yang dihapus tidak dapat dikembalikan
                            </p>
                        </div>
                    </div>
                `;

                Swal.fire({
                    html: confirmHTML,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-trash-alt" style="margin-right: 0.5rem;"></i>Ya, Hapus',
                    cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                    reverseButtons: true,
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

</body>

</html>