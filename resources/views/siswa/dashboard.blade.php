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
    <link rel="stylesheet" href="{{ asset('dist_siswa/css/dashboard/style.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.9.3/dist/dotlottie-wc.js" type="module"></script>
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