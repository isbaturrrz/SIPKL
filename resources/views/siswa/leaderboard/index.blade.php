<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Leaderboard - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_siswa/css/style.css') }}">
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

        .container-fluid {
            padding: 1.5rem 2rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1a1a1a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-title i {
            color: #FFD700;
            font-size: 1.5rem;
        }

        .personal-stats-card {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
            border-radius: 12px;
            padding: 2rem;
            color: #fff;
            box-shadow: 0 4px 20px rgba(30, 65, 121, 0.25);
            margin-bottom: 1.5rem;
        }

        .stats-header {
            margin-bottom: 1.5rem;
        }

        .stats-header h5 {
            color: #fff;
            font-weight: 700;
            font-size: 1.15rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
        }

        .stat-box {
            text-align: center;
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 600;
        }

        .leaderboard-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .podium-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .podium-item {
            text-align: center;
            padding: 2rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .podium-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .podium-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .podium-item.first {
            background: linear-gradient(135deg, #FFF9E6 0%, #FFE6B3 100%);
            border: 2px solid #FFD700;
            order: 2;
        }

        .podium-item.first::before {
            background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);
        }

        .podium-item.second {
            background: linear-gradient(135deg, #F5F5F5 0%, #E8E8E8 100%);
            border: 2px solid #C0C0C0;
            order: 1;
            margin-top: 1rem;
        }

        .podium-item.second::before {
            background: linear-gradient(90deg, #C0C0C0 0%, #A8A8A8 100%);
        }

        .podium-item.third {
            background: linear-gradient(135deg, #FFF0E6 0%, #FFE0CC 100%);
            border: 2px solid #CD7F32;
            order: 3;
            margin-top: 1rem;
        }

        .podium-item.third::before {
            background: linear-gradient(90deg, #CD7F32 0%, #B87333 100%);
        }

        .medal {
            font-size: 3.5rem;
            margin-bottom: 0.75rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .rank-number {
            font-size: 1.3rem;
            font-weight: 800;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .student-name {
            font-size: 1.15rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5rem;
            min-height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .student-class {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .poin-badge {
            display: inline-block;
            padding: 0.6rem 1.25rem;
            border-radius: 20px;
            font-weight: 800;
            font-size: 1.05rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .poin-badge.gold {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #1e293b;
        }

        .poin-badge.silver {
            background: linear-gradient(135deg, #C0C0C0 0%, #A8A8A8 100%);
            color: #1e293b;
        }

        .poin-badge.bronze {
            background: linear-gradient(135deg, #CD7F32 0%, #B87333 100%);
            color: #fff;
        }

        .ranking-list {
            margin-top: 2rem;
        }

        .list-header, .list-row {
            display: grid;
            grid-template-columns: 80px 1fr 200px 120px;
            gap: 1rem;
            padding: 1rem 1.5rem;
            align-items: center;
        }

        .list-header {
            background: #f8fafc;
            border-radius: 8px;
            font-weight: 700;
            color: #64748b;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .list-row {
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s ease;
            border-radius: 8px;
        }

        .list-row:hover {
            background: #f8fafc;
            transform: translateX(5px);
        }

        .list-row.highlight-me {
            background: linear-gradient(135deg, #182151 11%, #3F7FB6 75%, #010B40 100%);
            border-left: 4px solid #FFD700;
            color: #fff;
            box-shadow: 0 2px 8px rgba(30, 65, 121, 0.2);
        }

        .list-row.highlight-me .col-name,
        .list-row.highlight-me .col-class {
            color: #fff;
        }

        .list-row.highlight-me .rank-badge {
            background: #fff;
            color: #1e293b;
        }

        .list-row.highlight-me .poin-value {
            color: #FFD700;
        }

        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: #f1f5f9;
            border-radius: 50%;
            font-weight: 800;
            color: #1e293b;
            font-size: 1.1rem;
        }

        .col-name {
            font-weight: 700;
            color: #1e293b;
            font-size: 1rem;
        }

        .col-class {
            color: #64748b;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .poin-value {
            font-weight: 800;
            font-size: 1.2rem;
            color: #667eea;
        }

        .no-data {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .no-data-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .no-data-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #64748b;
        }

        .sticky-footer {
            background-color: #fff;
            border-top: 1px solid #e3e6f0;
        }

        .copyright {
            font-size: 0.85rem;
            color: #858796;
        }

        .animation-fadeUp {
            animation: fadeUp 0.5s ease both;
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .personal-stats-card {
                padding: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .podium-section {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .podium-item.first,
            .podium-item.second,
            .podium-item.third {
                order: initial;
                margin-top: 0;
            }

            .medal {
                font-size: 2.5rem;
            }

            .student-name {
                font-size: 1rem;
                min-height: auto;
            }

            .list-header, .list-row {
                grid-template-columns: 60px 1fr 90px;
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
            }

            .col-class {
                display: none;
            }

            .rank-badge {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .poin-value {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.25rem;
            }

            .medal {
                font-size: 2rem;
            }

            .poin-badge {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
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
        <div class="loader-text">Memuat Leaderboard...</div>
    </div>

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('siswa.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
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

            <li class="nav-item active">
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
                            <div class="personal-stats-card animation-fadeUp">
                                <div class="stats-header">
                                    <h5>
                                        Statistik Anda Di {{ $instansiNama }}
                                    </h5>
                                </div>
                                <div class="stats-grid">
                                    <div class="stat-box">
                                        <div class="stat-icon">🏆</div>
                                        <div class="stat-value">{{ $myPoin }}</div>
                                        <div class="stat-label">Total Poin</div>
                                    </div>
                                    <div class="stat-box">
                                        <div class="stat-icon">📊</div>
                                        <div class="stat-value">#{{ $myRank }}</div>
                                        <div class="stat-label">Ranking Instansi</div>
                                    </div>
                                    <div class="stat-box">
                                        <div class="stat-icon">⚡</div>
                                        <div class="stat-value">{{ $consistencyRate }}%</div>
                                        <div class="stat-label">Konsistensi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="leaderboard-card animation-fadeUp" style="animation-delay: 0.1s;">
                                @if(count($leaderboard) >= 3)
                                <div class="podium-section">
                                    <div class="podium-item second">
                                        <div class="medal">🥈</div>
                                        <div class="rank-number">#2</div>
                                        <div class="student-name">{{ $leaderboard[1]['nama'] }}</div>
                                        <div class="student-class">{{ $leaderboard[1]['kelas'] }}</div>
                                        <div class="poin-badge silver">{{ $leaderboard[1]['poin'] }} poin</div>
                                    </div>
                                    
                                    <div class="podium-item first">
                                        <div class="medal">🥇</div>
                                        <div class="rank-number">#1</div>
                                        <div class="student-name">{{ $leaderboard[0]['nama'] }}</div>
                                        <div class="student-class">{{ $leaderboard[0]['kelas'] }}</div>
                                        <div class="poin-badge gold">{{ $leaderboard[0]['poin'] }} poin</div>
                                    </div>
                                    
                                    <div class="podium-item third">
                                        <div class="medal">🥉</div>
                                        <div class="rank-number">#3</div>
                                        <div class="student-name">{{ $leaderboard[2]['nama'] }}</div>
                                        <div class="student-class">{{ $leaderboard[2]['kelas'] }}</div>
                                        <div class="poin-badge bronze">{{ $leaderboard[2]['poin'] }} poin</div>
                                    </div>
                                </div>
                                @endif

                                @if(count($leaderboard) > 0)
                                <div class="ranking-list">
                                    <div class="list-header">
                                        <div class="col-rank">Rank</div>
                                        <div class="col-name">Nama Siswa</div>
                                        <div class="col-class">Kelas</div>
                                        <div class="col-poin">Poin</div>
                                    </div>

                                    @foreach($leaderboard as $item)
                                        @if(count($leaderboard) <= 3 || $item['rank'] > 3)
                                        <div class="list-row {{ $item['is_me'] ? 'highlight-me' : '' }}">
                                            <div class="col-rank">
                                                <span class="rank-badge">{{ $item['rank'] }}</span>
                                            </div>
                                            <div class="col-name">
                                                {{ $item['nama'] }}
                                            </div>
                                            <div class="col-class">{{ $item['kelas'] }}</div>
                                            <div class="col-poin">
                                                <span class="poin-value">{{ $item['poin'] }}</span>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                @else
                                <div class="no-data">
                                    <div class="no-data-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <div class="no-data-text">
                                        Belum ada data leaderboard
                                    </div>
                                    <p style="margin-top: 1rem; color: #94a3b8;">
                                        Mulai isi jurnal untuk masuk ke leaderboard!
                                    </p>
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
            <a href="{{ route('siswa.dashboard') }}" class="bottom-nav-item">
                <i class="fas fa-th-large"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('siswa.jurnal.create') }}" class="bottom-nav-item">
                <i class="fas fa-pen-square"></i>
                <span>Jurnal</span>
            </a>
            <a href="{{ route('siswa.leaderboard.index') }}" class="bottom-nav-item active">
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