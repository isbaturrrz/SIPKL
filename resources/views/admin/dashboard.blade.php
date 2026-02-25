<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">

    <style>
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            padding: 20px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
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
        }
        .chart-card .chart-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #667eea;
        }
        .info-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        }
        .info-card .info-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #667eea;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #ecf0f1;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-item-label {
            font-weight: 500;
            color: #555;
        }
        .info-item-value {
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
        }
        .stat-breakdown {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }
        .stat-item {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #667eea;
        }
        .stat-item .stat-item-value {
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
            margin-top: 5px;
        }
        .stat-item .stat-item-label {
            font-size: 11px;
            color: #666;
            font-weight: 500;
        }
        .instansi-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .instansi-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #ecf0f1;
        }
        .instansi-item:last-child {
            border-bottom: none;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_admin/img/')}}" alt="">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
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

            <li class="nav-item">
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

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>                  

                    <ul class="navbar-nav ml-auto">

                        @auth
                        <li class="nav-item">                             
                            <a class="nav-link" href="#">                                 
                                <span class="mr-2 d-none d-lg-inline text-gray-600 ">
                                    Halo {{ Auth::user()->name }}
                                </span>                             
                            </a>                         
                        </li>
                        @endauth

                    </ul>

                </nav>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-3 mb-sm-0 text-gray-800">Dashboard Admin</h1>
                    </div>

                    <div class="row mb-4">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Siswa</div>
                                        <div class="stat-value">{{ $totalSiswa }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Guru</div>
                                        <div class="stat-value">{{ $totalGuru }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Instansi</div>
                                        <div class="stat-value">{{ $totalInstansi }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total User</div>
                                        <div class="stat-value">{{ $totalUser }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="chart-card">
                                <div class="chart-title">Statistik Penempatan Siswa</div>
                                <div class="stat-breakdown">
                                    <div class="stat-item">
                                        <i class="fas fa-check-circle" style="color: #1dd1a1; font-size: 20px;"></i>
                                        <div class="stat-item-label">Sudah Ditempatkan</div>
                                        <div class="stat-item-value">{{ $siswaAktif }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #f6c23e;">
                                        <i class="fas fa-times-circle" style="color: #f6c23e; font-size: 20px;"></i>
                                        <div class="stat-item-label">Belum Ditempatkan</div>
                                        <div class="stat-item-value">{{ $siswaBeluDitempatkan }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #36b9cc;">
                                        <i class="fas fa-scroll" style="color: #36b9cc; font-size: 20px;"></i>
                                        <div class="stat-item-label">Total Jurnal</div>
                                        <div class="stat-item-value">{{ $totalJurnal }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #e74a3b;">
                                        <i class="fas fa-calendar-today" style="color: #e74a3b; font-size: 20px;"></i>
                                        <div class="stat-item-label">Jurnal Hari Ini</div>
                                        <div class="stat-item-value">{{ $jurnalHariIni }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-8">
                            <div class="chart-card">
                                <div class="chart-title">Penempatan Siswa per Jurusan</div>
                                <canvas id="chartPenempatan" height="100"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="info-card">
                                <div class="info-title">Data Siswa per Jurusan Tahun Ajaran 2025</div>
                                @foreach($jurusanList as $jurusan)
                                <div class="info-item">
                                    <span class="info-item-label">{{ $jurusan }}</span>
                                    <span class="info-item-value">{{ $siswaPerJurusanTotal[$jurusan] }} Siswa</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-6">
                            <div class="chart-card">
                                <div class="chart-title">Sebaran Siswa per Jurusan</div>
                                <canvas id="chartJurusan" height="80"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="info-card">
                                <div class="info-title">5 Instansi dengan Siswa Terbanyak</div>
                                <div class="instansi-list">
                                    @forelse($instansiData as $instansi)
                                    <div class="instansi-item">
                                        <span>{{ $instansi->nama_instansi }}</span>
                                        <span class="badge badge-primary">{{ $instansi->jumlah_siswa }} Siswa</span>
                                    </div>
                                    @empty
                                    <div class="text-center text-muted py-3">
                                        Belum ada data instansi
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="chart-card">
                                <div class="chart-title">Trend Jurnal Per Bulan</div>
                                <canvas id="chartTrend" height="60"></canvas>
                            </div>
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

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <script>
        // Chart Penempatan
        var ctx = document.getElementById('chartPenempatan').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($jurusanList) !!},
                datasets: [
                    {
                        label: 'Belum ditempatkan',
                        data: [
                            @foreach($jurusanList as $jurusan)
                                {{ $chartData[$jurusan]['belum_ditempatkan'] }},
                            @endforeach
                        ],
                        backgroundColor: '#e74a3b',
                        borderColor: '#c0392b',
                        borderWidth: 1
                    },
                    {
                        label: 'Sudah ditempatkan',
                        data: [
                            @foreach($jurusanList as $jurusan)
                                {{ $chartData[$jurusan]['sudah_ditempatkan'] }},
                            @endforeach
                        ],
                        backgroundColor: '#1dd1a1',
                        borderColor: '#10ac84',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 50
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });

        // Chart Jurusan
        var ctx2 = document.getElementById('chartJurusan').getContext('2d');
        var chartJurusan = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($jurusanList) !!},
                datasets: [{
                    data: [
                        @foreach($jurusanList as $jurusan)
                            {{ $siswaJurusanData[$jurusan] }},
                        @endforeach
                    ],
                    backgroundColor: ['#667eea', '#f093fb', '#4facfe'],
                    borderColor: ['#5568d3', '#d876ba', '#2e88e0'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });

        // Chart Trend
        var ctx3 = document.getElementById('chartTrend').getContext('2d');
        var chartTrend = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jurnal',
                    data: [
                        @foreach(range(1, 12) as $bulan)
                            {{ $jurnalPerBulan[$bulan] ?? 0 }},
                        @endforeach
                    ],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#667eea'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>