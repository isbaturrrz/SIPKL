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
            background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
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
           background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
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
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            animation: fadeUp 0.5s ease 0.1s both;
        }

        .streak-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .streak-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ff6b6b 0%, #f38449 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .streak-icon.on {
            animation: fireFlicker 1.5s ease-in-out infinite;
        }

        .streak-icon.hot {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff4757 100%);
            animation: fireFlicker 1s ease-in-out infinite;
        }

        .streak-icon.legendary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            animation: fireGlow 1.5s ease-in-out infinite;
        }

        .streak-icon.off {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            opacity: 0.5;
            animation: none;
        }

        @keyframes fireFlicker {
            0%, 100% { 
                transform: scale(1) rotate(-2deg);
                opacity: 1;
            }
            50% { 
                transform: scale(1.05) rotate(2deg);
                opacity: 0.9;
            }
        }

        @keyframes fireGlow {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
            }
            50% { 
                transform: scale(1.1);
                box-shadow: 0 4px 30px rgba(245, 87, 108, 0.8);
            }
        }

        .streak-title {
            flex: 1;
        }

        .streak-title h3 {
            font-size: 1rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .streak-number {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .streak-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f1f5f9;
        }

        .stat-item {
            text-align: center;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
        }

        .calendar-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f1f5f9;
        }

        .calendar-label {
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }

        .calendar-grid-mini {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }

        .calendar-day-mini {
            aspect-ratio: 1;
            background: #f1f5f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #cbd5e1;
            transition: transform 0.2s ease;
        }

        .calendar-day-mini.filled {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
            color: #fff;
        }

        .calendar-day-mini.alfa {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            color: #fff;
            opacity: 0.6;
        }

        .calendar-day-mini.today {
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.3);
        }

        .calendar-day-mini.today.filled {
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.5);
        }

        .calendar-day-mini.today.alfa {
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.4);
        }

        .calendar-day-mini:hover {
            transform: scale(1.1);
        }

        .motivation-text {
            margin-top: 1rem;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
            color: #475569;
            font-weight: 600;
            font-style: italic;
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

        .calendar-legend {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 600;
        }

        .legend-box {
            width: 16px;
            height: 16px;
            border-radius: 4px;
        }

        .legend-box.filled {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
        }

        .legend-box.alfa {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            opacity: 0.6;
        }

        .legend-box.empty {
            background: #f1f5f9;
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem 1.5rem;
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
                padding: 1.5rem;
            }
            
            .streak-number {
                font-size: 1.5rem;
            }
            
            .calendar-grid-mini {
                gap: 0.25rem;
            }
            
            .calendar-day-mini {
                font-size: 0.65rem;
            }
            
            .stat-value {
                font-size: 1.25rem;
            }

            .calendar-legend {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
                padding: 0.75rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }

            .hero-name {
                font-size: 1.25rem;
            }

            .hero-time {
                font-size: 1.5rem;
            }

            .tempat-name {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body id="page-top">
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
                                        <div class="streak-icon legendary">🏆</div>
                                    @elseif($streakData['fire_status'] == 'hot')
                                        <div class="streak-icon hot">🔥🔥</div>
                                    @elseif($streakData['fire_status'] == 'on')
                                        <div class="streak-icon on">🔥</div>
                                    @else
                                        <div class="streak-icon off">⭕</div>
                                    @endif

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

                                <div class="calendar-section">
                                    <div class="calendar-label">7 Hari Terakhir</div>
                                    <div class="calendar-grid-mini">
                                        @foreach($calendarData as $day)
                                        <script>
                                            console.log('Calendar Data:', @json($calendarData));
                                        </script>
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

                                <div class="motivation-text">
                                    "{{ $streakData['motivational_message'] }}"
                                </div>

                                @if($streakData['has_journal_today'])
                                    <div class="text-center mt-3">
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

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script>
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
    </script>
</body>

</html>