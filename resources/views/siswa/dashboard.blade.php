<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_siswa/css/style.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.9.3/dist/dotlottie-wc.js" type="module"></script>

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

        .container-fluid {
            padding: 1.5rem 2rem;
        }

        .hero-card {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
            border-radius: 12px;
            padding: 2rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(30, 65, 121, 0.25);
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .hero-info {
            flex: 1;
            min-width: 250px;
            z-index: 1;
        }

        .hero-date {
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hero-name {
            color: #fff;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
        }

        .hero-school {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-class {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .hero-time-wrapper {
            z-index: 1;
            text-align: right;
        }

        .hero-time {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            font-variant-numeric: tabular-nums;
            letter-spacing: 3px;
        }

        .journal-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem 2.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .journal-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #f1f5f9;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .journal-top-text h5 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .journal-top-text p {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0;
        }

        .btn-catat-jurnal {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3);
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-catat-jurnal:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4);
            text-decoration: none;
        }

        .btn-catat-jurnal i {
            font-size: 1rem;
        }

        .pkl-section {
            text-align: center;
            padding: 1rem 0;
        }

        .tempat-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }

        .tempat-name {
            font-size: 2rem;
            font-weight: 800;
            color: #1e4179;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }

        .tempat-address {
            font-size: 0.95rem;
            color: #475569;
            font-weight: 500;
        }

        .no-instansi {
            text-align: center;
            padding: 3rem 2rem;
        }

        .no-instansi-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .no-instansi-text {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .sticky-footer {
            background-color: #fff;
            border-top: 1px solid #e3e6f0;
        }

        .copyright {
            font-size: 0.85rem;
            color: #858796;
        }

        .hero-card {
            animation: fadeUp 0.5s ease both;
        }

        .journal-card {
            animation: fadeUp 0.5s ease 0.15s both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .streak-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            animation: fadeUp 0.5s ease 0.1s both;
            position: relative;
            overflow: hidden;
        }

        .streak-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .streak-icon-wrapper {
            flex-shrink: 0;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 20px;
            padding: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
        }

        .streak-icon-wrapper.legendary {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe4e4 100%);
            box-shadow: 0 8px 25px rgba(245, 87, 108, 0.2);
        }

        .streak-icon-wrapper.hot {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.2);
        }

        .streak-icon-wrapper.on {
            background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
            box-shadow: 0 6px 20px rgba(255, 142, 83, 0.15);
        }

        .streak-icon-wrapper.off {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            opacity: 0.7;
        }

        .streak-icon-wrapper dotlottie-wc {
            width: 100px !important;
            height: 100px !important;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .streak-icon-wrapper dotlottie-wc.loaded {
            opacity: 1;
        }

        .lottie-loader {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 4px solid #f1f5f9;
            border-top: 4px solid #ff6b6b;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            opacity: 1;
            transition: opacity 0.4s ease;
        }

        .lottie-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .streak-content {
            flex: 1;
            min-width: 0;
        }

        .streak-status {
            display: inline-block;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }

        .streak-status.filled {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }

        .streak-status.empty {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        .streak-title h3 {
            font-size: 1.25rem;
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .streak-number {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .streak-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
        }

        .stat-label {
            font-size: 0.75rem;
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
        }

        .calendar-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
        }

        .calendar-label {
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 700;
            margin-bottom: 1.25rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .calendar-grid-mini {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.625rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .calendar-day-mini {
            aspect-ratio: 1;
            background: #f8fafc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #cbd5e1;
            transition: all 0.2s ease;
            position: relative;
            border: 2px solid transparent;
        }

        .calendar-day-mini.filled {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
        }

        .calendar-day-mini.alfa {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            color: #fff;
            opacity: 0.7;
            box-shadow: 0 2px 8px rgba(100, 116, 139, 0.2);
        }

        .calendar-day-mini.today {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .calendar-day-mini.today.filled {
            border-color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.4), 0 2px 8px rgba(255, 107, 107, 0.3);
        }

        .calendar-day-mini.today.alfa {
            border-color: #fff;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.4), 0 2px 8px rgba(100, 116, 139, 0.2);
        }

        .calendar-day-mini:hover {
            transform: scale(1.1);
        }

        .calendar-legend {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 600;
        }

        .legend-box {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .legend-box.filled {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
        }

        .legend-box.alfa {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            opacity: 0.7;
        }

        .legend-box.empty {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
        }

        .motivation-text {
            margin-top: 1.5rem;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
            border-left: 4px solid #667eea;
            border-radius: 10px;
            text-align: left;
            font-size: 0.95rem;
            color: #475569;
            font-weight: 600;
            font-style: italic;
            line-height: 1.6;
        }

        .btn-view-leaderboard {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-view-leaderboard:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
            text-decoration: none;
        }

        .leaderboard-action {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f1f5f9;
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

            .hero-card {
                padding: 1.5rem 1.75rem;
            }

            .hero-name {
                font-size: 1.5rem;
            }

            .hero-school {
                font-size: 0.9rem;
            }

            .hero-class {
                font-size: 0.8rem;
            }

            .hero-time {
                font-size: 1.75rem;
                letter-spacing: 2px;
            }

            .hero-time-wrapper {
                text-align: left;
                width: 100%;
            }

            .journal-card {
                padding: 1.5rem 1.75rem;
            }

            .journal-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-catat-jurnal {
                width: 100%;
                justify-content: center;
            }

            .tempat-name {
                font-size: 1.5rem;
            }

            .tempat-address {
                font-size: 0.85rem;
            }

            .no-instansi {
                padding: 2rem 1.5rem;
            }

            .no-instansi-icon {
                font-size: 3rem;
            }

            .streak-card {
                padding: 1.75rem;
            }

            .streak-header {
                flex-direction: column;
                text-align: center;
                gap: 1.25rem;
            }

            .streak-icon-wrapper {
                width: 100px;
                height: 100px;
                margin: 0 auto;
            }

            .streak-icon-wrapper dotlottie-wc {
                width: 80px !important;
                height: 80px !important;
            }

            .lottie-loader {
                width: 50px;
                height: 50px;
            }

            .streak-content {
                text-align: center;
            }

            .streak-title h3 {
                font-size: 1.1rem;
            }

            .streak-number {
                font-size: 1.85rem;
            }

            .streak-stats {
                gap: 1rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .calendar-grid-mini {
                gap: 0.375rem;
            }

            .calendar-day-mini {
                font-size: 0.7rem;
                border-radius: 8px;
            }

            .calendar-legend {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .motivation-text {
                font-size: 0.875rem;
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-name {
                font-size: 1.25rem;
            }

            .hero-time {
                font-size: 1.5rem;
            }

            .tempat-name {
                font-size: 1.25rem;
            }

            .streak-card {
                padding: 1.5rem;
            }

            .streak-icon-wrapper {
                width: 90px;
                height: 90px;
            }

            .streak-icon-wrapper dotlottie-wc {
                width: 70px !important;
                height: 70px !important;
            }

            .lottie-loader {
                width: 45px;
                height: 45px;
                border-width: 3px;
            }

            .streak-number {
                font-size: 1.65rem;
            }

            .calendar-grid-mini {
                gap: 0.25rem;
            }

            .calendar-day-mini {
                font-size: 0.65rem;
            }

            .legend-box {
                width: 16px;
                height: 16px;
            }

            .bottom-nav-item {
                font-size: 0.65rem;
            }

            .bottom-nav-item i {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="page-loader">
        <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Dashboard...</div>
    </div>

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('siswa.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
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
                <a class="nav-link" href="{{ route('siswa.leaderboard.index') }}">
                    <i class="fas fa-trophy"></i>
                    <span>Leaderboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.nilai.index') }}">
                    <i class="fas fa-download"></i>
                    <span>Unduh Nilai</span>
                </a>
            </li>

            <li class="nav-item">
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
                            <a class="nav-item">
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-card">
                                <div class="hero-info">
                                    <div class="hero-date" id="heroDate"></div>
                                    <div class="hero-name">{{ $nama }}</div>
                                    <div class="hero-school">SMK BUDI BAKTI CIWIDEY</div>
                                    <div class="hero-class">{{ $kelas_lengkap }} | {{ $jurusan_lengkap }}</div>
                                </div>
                                <div class="hero-time-wrapper">
                                    <div class="hero-time" id="heroTime"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="streak-card">
                                <div class="streak-header">
                                    @if($streakData['fire_status'] == 'legendary')
                                        <div class="streak-icon-wrapper legendary">
                                            <div class="lottie-loader"></div>
                                            <dotlottie-wc
                                                src="https://lottie.host/b93685a0-183e-46f7-97f7-b4e1502aa822/crQxmFuumo.lottie"
                                                autoplay
                                                loop>
                                            </dotlottie-wc>
                                        </div>
                                    @elseif($streakData['fire_status'] == 'hot')
                                        <div class="streak-icon-wrapper hot">
                                            <div class="lottie-loader"></div>
                                            <dotlottie-wc
                                                src="https://lottie.host/c018130f-a078-4da8-b8dd-f020e81acd7a/Is0IwATulD.lottie"
                                                autoplay
                                                loop>
                                            </dotlottie-wc>
                                        </div>
                                    @elseif($streakData['fire_status'] == 'on')
                                        <div class="streak-icon-wrapper on">
                                            <div class="lottie-loader"></div>
                                            <dotlottie-wc
                                                src="https://lottie.host/dd0792e3-889a-4a79-b892-dc1d2ffd3814/1nqZaNpIVz.lottie"
                                                autoplay
                                                loop>
                                            </dotlottie-wc>
                                        </div>
                                    @else
                                        <div class="streak-icon-wrapper off">
                                            <div class="lottie-loader"></div>
                                            <dotlottie-wc
                                                src="https://lottie.host/50e60ce8-513e-44cf-a1c0-3b11116ed584/PMQBDrVssl.lottie"
                                                autoplay
                                                loop>
                                            </dotlottie-wc>
                                        </div>
                                    @endif

                                    <div class="streak-content">
                                        <div class="streak-title">
                                            <h3>
                                                @if($streakData['has_journal_today'])
                                                    Jurnal Hari Ini Sudah Terisi!
                                                @else
                                                    Belum Isi Jurnal Hari Ini
                                                @endif
                                            </h3>
                                            <div class="streak-number">{{ $streakData['total_poin'] }} Poin</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="calendar-section">
                                    <div class="calendar-label">7 Hari Terakhir</div>
                                    <div class="calendar-grid-mini">
                                        @foreach($calendarData as $day)
                                            <div class="calendar-day-mini 
                                                @if($day['is_alfa'])
                                                    alfa
                                                @elseif($day['has_journal'])
                                                    filled
                                                @endif
                                                @if($day['is_today']) today @endif">
                                                {{ $day['day_name'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="calendar-legend">
                                        <div class="legend-item">
                                            <div class="legend-box filled"></div>
                                            <span>Hadir</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-box alfa"></div>
                                            <span>Alfa</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-box empty"></div>
                                            <span>Kosong</span>
                                        </div>
                                    </div>
                                </div>

                                @if($streakData['has_journal_today'])
                                    <div class="leaderboard-action">
                                        <a href="{{ route('siswa.leaderboard.index') }}" class="btn-catat-jurnal">
                                            <i class="fas fa-trophy"></i>
                                            Lihat Leaderboard
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="journal-card">
                                <div class="journal-top">
                                    <div class="journal-top-text">
                                        <h5>Sudah mengisi jurnal hari ini?</h5>
                                        <p>Jika belum yuk segera catat jurnalmu!</p>
                                    </div>
                                    <a href="{{ route('siswa.jurnal.create') }}" class="btn-catat-jurnal">
                                        <i class="fas fa-pen"></i>
                                        Catat Jurnal
                                    </a>
                                </div>

                                @if($has_instansi)
                                    <div class="pkl-section">
                                        <div class="tempat-label">Tempat PKL</div>
                                        <div class="tempat-name">{{ $instansi_nama }}</div>
                                        <div class="tempat-address">{{ $instansi_alamat }}</div>
                                    </div>
                                @else
                                    <div class="no-instansi">
                                        <div class="no-instansi-icon">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="no-instansi-text">
                                            Anda belum memiliki instansi PKL
                                        </div>
                                        <a href="{{ route('siswa.instansi.index') }}" class="btn-catat-jurnal">
                                            <i class="fas fa-building"></i>
                                            Pilih Instansi
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

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

    <div class="more-menu-overlay" id="moreMenuOverlay"></div>
    <div class="more-menu" id="moreMenu">
        <a href="{{ route('siswa.jurnal.index') }}" class="more-menu-item">
            <i class="fas fa-history"></i>
            <span>Riwayat Jurnal</span>
        </a>
        <a href="{{ route('siswa.nilai.index') }}" class="more-menu-item">
            <i class="fas fa-download"></i>
            <span>Unduh Nilai</span>
        </a>
        <a href="{{ route('siswa.instansi.index') }}" class="more-menu-item">
            <i class="fas fa-building"></i>
            <span>Pilih Instansi</span>
        </a>
        <a href="#" class="more-menu-item" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <nav class="bottom-nav">
        <div class="bottom-nav-container">
            <a href="{{ route('siswa.dashboard') }}" class="bottom-nav-item active">
                <i class="fas fa-th-large"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('siswa.jurnal.create') }}" class="bottom-nav-item">
                <i class="fas fa-pen-square"></i>
                <span>Jurnal</span>
            </a>
            <a href="{{ route('siswa.leaderboard.index') }}" class="bottom-nav-item">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
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

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('page-loader').classList.add('hidden');
            }, 800);
        });

        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('heroTime').textContent = h + ':' + m;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const d = now;
            document.getElementById('heroDate').textContent =
                d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
        }
        updateClock();
        setInterval(updateClock, 1000);

        window.addEventListener('load', function() {
            setTimeout(function() {
                const lottieElements = document.querySelectorAll('dotlottie-wc');
                const loaders = document.querySelectorAll('.lottie-loader');
                
                lottieElements.forEach(function(lottie) {
                    lottie.classList.add('loaded');
                });
                
                loaders.forEach(function(loader) {
                    loader.classList.add('hidden');
                });
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
    </script>
</body>

</html>