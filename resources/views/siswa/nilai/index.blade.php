<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unduh Nilai - Siswa</title>
    <link rel="stylesheet" href="{{ asset('dist_siswa/css/nilai/style.css') }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
</head>

<body id="page-top">
    <div id="page-loader">
        <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL" class="loader-logo">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat Halaman...</div>
    </div>

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
                <a class="nav-link" href="{{ route('siswa.leaderboard.index') }}">
                    <i class="fas fa-trophy"></i>
                    <span>Leaderboard</span>
                </a>
            </li>

            <li class="nav-item active">
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

                    @if($penilaian)
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="info-card">
                                <h5>INFORMASI SISWA</h5>
                                <div class="info-row">
                                    <div class="info-label">Nama</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $siswa->nama }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">NIPD</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $siswa->nipd }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Kelas</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $siswa->kelas_lengkap }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="info-card">
                                <h5>INFORMASI PKL</h5>
                                <div class="info-row">
                                    <div class="info-label">Instansi PKL</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $penilaian->instansi->nama_instansi ?? '-' }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Periode PKL</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ \Carbon\Carbon::parse($penilaian->tanggal_mulai)->format('j F Y') }} - {{ \Carbon\Carbon::parse($penilaian->tanggal_selesai)->format('j F Y') }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Pimpinan</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $penilaian->instansi->pemilik ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nilai-table-card">
                        <div class="nilai-table-header">
                            NILAI AKHIR
                        </div>
                        <table class="nilai-table">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">NILAI AKHIR</th>
                                    <th style="width: 60%;">PREDIKAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 1.5rem; font-weight: 700; color: #1e4179;">
                                        {{ number_format($penilaian->nilai_akhir, 1) }}
                                    </td>
                                    <td>
                                        <span class="predikat-badge">
                                            @if($penilaian->nilai_akhir >= 90) A
                                            @elseif($penilaian->nilai_akhir >= 80) B
                                            @elseif($penilaian->nilai_akhir >= 70) C
                                            @elseif($penilaian->nilai_akhir >= 60) D
                                            @else E
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="nilai-table-card">
                        <div class="nilai-table-header">
                            DETAIL ASPEK PENILAIAN
                        </div>
                        <table class="nilai-table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">No.</th>
                                    <th style="width: 45%;">ASPEK YANG DINILAI</th>
                                    <th style="width: 22.5%;">NILAI</th>
                                    <th style="width: 22.5%;">PREDIKAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td style="text-align: left; padding-left: 2rem;">Kedisiplinan</td>
                                    <td>{{ number_format($penilaian->nilai_kedisiplinan, 0) }}</td>
                                    <td>
                                        @if($penilaian->nilai_kedisiplinan >= 90) A
                                        @elseif($penilaian->nilai_kedisiplinan >= 80) B
                                        @elseif($penilaian->nilai_kedisiplinan >= 70) C
                                        @elseif($penilaian->nilai_kedisiplinan >= 60) D
                                        @else E
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td style="text-align: left; padding-left: 2rem;">Tanggung Jawab</td>
                                    <td>{{ number_format($penilaian->nilai_tanggung_jawab, 0) }}</td>
                                    <td>
                                        @if($penilaian->nilai_tanggung_jawab >= 90) A
                                        @elseif($penilaian->nilai_tanggung_jawab >= 80) B
                                        @elseif($penilaian->nilai_tanggung_jawab >= 70) C
                                        @elseif($penilaian->nilai_tanggung_jawab >= 60) D
                                        @else E
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td style="text-align: left; padding-left: 2rem;">Kreatifitas</td>
                                    <td>{{ number_format($penilaian->nilai_kreatifitas, 0) }}</td>
                                    <td>
                                        @if($penilaian->nilai_kreatifitas >= 90) A
                                        @elseif($penilaian->nilai_kreatifitas >= 80) B
                                        @elseif($penilaian->nilai_kreatifitas >= 70) C
                                        @elseif($penilaian->nilai_kreatifitas >= 60) D
                                        @else E
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td style="text-align: left; padding-left: 2rem;">Komunikasi</td>
                                    <td>{{ number_format($penilaian->nilai_komunikasi, 0) }}</td>
                                    <td>
                                        @if($penilaian->nilai_komunikasi >= 90) A
                                        @elseif($penilaian->nilai_komunikasi >= 80) B
                                        @elseif($penilaian->nilai_komunikasi >= 70) C
                                        @elseif($penilaian->nilai_komunikasi >= 60) D
                                        @else E
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td style="text-align: left; padding-left: 2rem;">Kerjasama</td>
                                    <td>{{ number_format($penilaian->nilai_kerjasama, 0) }}</td>
                                    <td>
                                        @if($penilaian->nilai_kerjasama >= 90) A
                                        @elseif($penilaian->nilai_kerjasama >= 80) B
                                        @elseif($penilaian->nilai_kerjasama >= 70) C
                                        @elseif($penilaian->nilai_kerjasama >= 60) D
                                        @else E
                                        @endif
                                    </td>
                                </tr>
                                <tr class="nilai-akhir-row">
                                    <td colspan="2" style="text-align: center;">JUMLAH</td>
                                    <td>{{ number_format($penilaian->nilai_kedisiplinan + $penilaian->nilai_tanggung_jawab + $penilaian->nilai_kreatifitas + $penilaian->nilai_komunikasi + $penilaian->nilai_kerjasama, 0) }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right mb-4">
                        <a href="{{ route('siswa.nilai.download') }}" class="btn-download">
                            <i class="fas fa-file-pdf"></i>
                            Unduh PDF
                        </a>
                    </div>

                    @else
                    <div class="info-card">
                        <div class="no-data-message">
                            <i class="fas fa-clipboard-list"></i>
                            <h5>Belum Ada Penilaian</h5>
                            <p>Penilaian PKL Anda belum tersedia. Hubungi pembimbing instansi untuk informasi lebih lanjut.</p>
                        </div>
                    </div>
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

    <div class="more-menu-overlay" id="moreMenuOverlay"></div>
    <div class="more-menu" id="moreMenu">
        <a href="{{ route('siswa.jurnal.index') }}" class="more-menu-item">
            <i class="fas fa-history"></i>
            <span>Riwayat Jurnal</span>
        </a>
        <a href="{{ route('siswa.nilai.index') }}" class="more-menu-item active">
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
            <a href="{{ route('siswa.leaderboard.index') }}" class="bottom-nav-item">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
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