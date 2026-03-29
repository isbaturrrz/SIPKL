<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kelola User - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
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

        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
            
            #content-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
            }
            
            .topbar {
                padding-left: 1rem !important;
            }
        }

        .hamburger-menu {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #5a5c69;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .hamburger-menu:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 991px) {
            .hamburger-menu {
                display: block;
            }
            
            #sidebarToggleTop {
                display: none;
            }
        }

        #content {
            background-color: #e8eef7;
            min-height: 100vh;
        }

        .topbar {
            background-color: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
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

        .search-box {
            position: relative;
            max-width: 350px;
        }

        .search-box input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            padding-right: 3rem;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.3s;
        }

        .search-box input:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
            outline: none;
        }

        .search-box select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.3s;
        }

        .search-box select:focus {
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

        .badge-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
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
            margin-top: 8px;
        }

        .btn-danger:hover {
            background: #dc2626;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #9ca3af;
            color: #fff;
            margin-top: 8px;
        }

        .btn-secondary:hover {
            background: #6b7280;
            color: #fff;
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

            .table-header {
                flex-direction: column;
                gap: 1rem;
            }

            .search-box {
                max-width: 100%;
            }

            .jurnal-table {
                font-size: 0.8rem;
            }

            .jurnal-table thead th,
            .jurnal-table tbody td {
                padding: 0.75rem 0.5rem;
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

        .mobile-nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0d1b3e 0%, #1e3a6e 100%);
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        .mobile-nav-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .mobile-nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .mobile-nav-header .logo img {
            max-width: 120px;
            height: auto;
        }

        .close-nav-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-nav-btn:hover {
            transform: rotate(90deg);
            background: rgba(255, 255, 255, 0.2);
        }

        .mobile-nav-content {
            height: calc(100% - 80px - 80px);
            overflow-y: auto;
            padding: 2rem;
        }

        .mobile-nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav-menu li {
            margin-bottom: 0.5rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.4s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-nav-menu li:nth-child(1) { animation-delay: 0.05s; }
        .mobile-nav-menu li:nth-child(2) { animation-delay: 0.1s; }
        .mobile-nav-menu li:nth-child(3) { animation-delay: 0.15s; }
        .mobile-nav-menu li:nth-child(4) { animation-delay: 0.2s; }
        .mobile-nav-menu li:nth-child(5) { animation-delay: 0.25s; }
        .mobile-nav-menu li:nth-child(6) { animation-delay: 0.3s; }
        .mobile-nav-menu li:nth-child(7) { animation-delay: 0.35s; }
        .mobile-nav-menu li:nth-child(8) { animation-delay: 0.4s; }
        .mobile-nav-menu li:nth-child(9) { animation-delay: 0.45s; }

        .mobile-nav-menu a {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.25rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .mobile-nav-menu a i {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .mobile-nav-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(10px);
            color: white;
        }

        .mobile-nav-menu a:hover i {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .mobile-nav-menu .active a {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .mobile-nav-menu .active a i {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        .mobile-nav-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
        }

        .user-info i {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1.2rem;
        }

        .user-info .user-details {
            flex: 1;
        }

        .user-info .user-name {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .user-info .user-role {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .logout-mobile {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .logout-mobile:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        @media (max-width: 768px) {
            .mobile-nav-menu a {
                font-size: 1.3rem;
                padding: 1rem 1.2rem;
            }
            
            .mobile-nav-menu a i {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
            
            .mobile-nav-content {
                padding: 1.5rem;
            }
            
            .mobile-nav-header {
                padding: 1rem 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .mobile-nav-menu a {
                font-size: 1.15rem;
                padding: 0.9rem 1rem;
                gap: 1rem;
            }
            
            .mobile-nav-menu a i {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .mobile-nav-content {
                padding: 1rem;
            }
            
            .mobile-nav-header {
                padding: 0.8rem 1rem;
            }
            
            .close-nav-btn {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }
        }

        @media (max-width: 400px) {
            .mobile-nav-menu a {
                font-size: 1rem;
                padding: 0.8rem 0.8rem;
            }
            
            .mobile-nav-menu a i {
                width: 38px;
                height: 38px;
                font-size: 0.9rem;
            }
            
            .user-info i {
                width: 40px;
                height: 40px;
            }
            
            .user-info .user-name {
                font-size: 0.9rem;
            }
        }

        body.menu-open {
            overflow: hidden;
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
            border-color: #f59e0b !important;
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

        @media (max-width: 768px) {
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_admin/img/logo.png')}}" alt="IPKL">
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

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.instansi.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Kelola Instansi</span>
                </a> 
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pengajuan-instansi.index') }}">
                    <i class="fas fa-inbox"></i>
                    <span>Pengajuan Instansi</span>
                </a> 
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.guru.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Kelola Guru</span>
                </a>    
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola User</span>
                </a>    
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.import.index') }}">
                    <i class="fas fa-file-import"></i>
                    <span>Import Data</span>
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
                    <button class="hamburger-menu" id="hamburgerMenuBtn">
                        <i class="fa fa-bars"></i>
                    </button>

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
                        <h1 class="h3 mb-0 text-gray-800" style="font-weight: 700;">Data User</h1>
                        <a href="{{ route('admin.user.create') }}" class="btn-add">
                            <i class="fas fa-plus"></i> Tambah User
                        </a>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Cari User</h5>
                        </div>
                        <div style="padding: 1.5rem 2rem;">
                            <form method="GET" action="{{ route('admin.user.index') }}">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <div class="search-box" style="max-width: 100%;">
                                            <input type="text" name="search" placeholder="Cari nama, username, email..." value="{{ request('search') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="search-box" style="max-width: 100%;">
                                            <select name="filter_role">
                                                <option value="">-- Semua Role --</option>
                                                <option value="admin" {{ request('filter_role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="guru" {{ request('filter_role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                                <option value="mentor" {{ request('filter_role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="search-box" style="max-width: 100%; display: flex; gap: 0.75rem;">
                                            <button type="submit">
                                                <i class="fas fa-search"></i> Cari
                                            </button>
                                            <a href="{{ route('admin.user.index') }}" class="btn-reset">
                                                <i class="fas fa-sync"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h5>Daftar User</h5>
                        </div>

                        <div class="table-responsive">
                            @if($users->count() > 0)
                            <table class="jurnal-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->role == 'admin')
                                                <span class="status-badge badge-danger">Admin</span>
                                            @elseif($user->role == 'guru')
                                                <span class="status-badge badge-success">Guru</span>
                                            @elseif($user->role == 'mentor')
                                                <span class="status-badge badge-warning">Mentor</span>
                                            @else
                                                <span class="status-badge badge-info">Siswa</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $user->id) }}" class="btn-action btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn-action btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($user->id != auth()->id())
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" 
                                                  method="POST" 
                                                  class="d-inline delete-form"
                                                  data-nama="{{ $user->name }}"
                                                  data-username="{{ $user->username }}"
                                                  data-email="{{ $user->email }}"
                                                  data-role="{{ $user->role }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-danger btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @else
                                            <button class="btn-action btn-secondary" disabled>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h5>Belum Ada Data User</h5>
                                <p>Belum ada user yang terdaftar dalam sistem.</p>
                            </div>
                            @endif
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

    <div class="mobile-nav-overlay" id="mobileNavOverlay">
        <div class="mobile-nav-header">
            <div class="logo">
                <img src="{{asset('dist_admin/img/logo.png')}}" alt="IPKL">
            </div>
            <button class="close-nav-btn" id="closeNavBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-nav-content">
            <ul class="mobile-nav-menu">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                    <a href="{{ route('admin.siswa.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Kelola Siswa</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.instansi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.instansi.index') }}">
                        <i class="fas fa-building"></i>
                        <span>Kelola Instansi</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.pengajuan-instansi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pengajuan-instansi.index') }}">
                        <i class="fas fa-inbox"></i>
                        <span>Pengajuan Instansi</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                    <a href="{{ route('admin.guru.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Kelola Guru</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Kelola User</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.import*') ? 'active' : '' }}">
                    <a href="{{ route('admin.import.index') }}">
                        <i class="fas fa-file-import"></i>
                        <span>Import Data</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.sistem*') ? 'active' : '' }}">
                    <a href="{{ route('admin.sistem.index') }}">
                        <i class="fas fa-cogs"></i>
                        <span>Kelola Sistem</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="mobile-nav-footer">
            @auth
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
                <a href="#" class="logout-mobile" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @endauth
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const mobileOverlay = document.getElementById('mobileNavOverlay');
        const hamburgerBtn = document.getElementById('hamburgerMenuBtn');
        const closeNavBtn = document.getElementById('closeNavBtn');

        function openMobileMenu() {
            mobileOverlay.classList.add('active');
            document.body.classList.add('menu-open');
        }

        function closeMobileMenu() {
            mobileOverlay.classList.remove('active');
            document.body.classList.remove('menu-open');
        }

        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', openMobileMenu);
        }

        if (closeNavBtn) {
            closeNavBtn.addEventListener('click', closeMobileMenu);
        }

        mobileOverlay.addEventListener('click', function(e) {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });

        const mobileMenuLinks = document.querySelectorAll('.mobile-nav-menu a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(() => {
                    closeMobileMenu();
                }, 100);
            });
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('.delete-form');
                const nama = form.getAttribute('data-nama');
                const username = form.getAttribute('data-username');
                const email = form.getAttribute('data-email');
                const role = form.getAttribute('data-role');

                let roleBadge = '';
                if (role === 'admin') {
                    roleBadge = '<span style="background: #fee2e2; color: #dc2626; padding: 0.4rem 1rem; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Admin</span>';
                } else if (role === 'guru') {
                    roleBadge = '<span style="background: #d1fae5; color: #065f46; padding: 0.4rem 1rem; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Guru</span>';
                } else if (role === 'mentor') {
                    roleBadge = '<span style="background: #fef3c7; color: #d97706; padding: 0.4rem 1rem; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Mentor</span>';
                } else {
                    roleBadge = '<span style="background: #dbeafe; color: #1e40af; padding: 0.4rem 1rem; border-radius: 6px; font-size: 0.8rem; font-weight: 700;">Siswa</span>';
                }

                const confirmHTML = `
                    <div style="padding: 0.5rem 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-users" style="font-size: 1.75rem; color: #dc2626;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Hapus User</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menghapus user berikut?</p>
                        
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                            <table style="width: 100%; font-size: 0.85rem;">
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 30%;">Nama:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nama}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Username:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${username}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Email:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${email}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Role:</td>
                                    <td style="padding: 0.4rem 0;">${roleBadge}</td>
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