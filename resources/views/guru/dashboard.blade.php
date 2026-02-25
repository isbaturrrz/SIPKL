<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset ('dist_guru/css/style.css')}}">
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
            background: linear-gradient(135deg, #0d1b3e 0%, #1e3a6e 100%);
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
            border-bottom: 2px solid #1e3a6e;;
        }

        .siswa-table {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        }

        .siswa-table .table-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid  #1e3a6e;;
        }

        .siswa-table table {
            font-size: 13px;
        }

        .siswa-table table thead {
            background-color: #f8f9fa;
        }

        .siswa-table table tbody tr:hover {
            background-color: #f1f3f5;
        }

        .badge-hadir {
            background-color: #1dd1a1;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-alfa {
            background-color: #e74a3b;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
        }

        .stat-breakdown {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        .stat-item {
            background: white;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #667eea;
        }

        .stat-item .stat-item-value {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a6e;
            margin-top: 5px;
        }

        .stat-item .stat-item-label {
            font-size: 11px;
            color: #666;
            font-weight: 500;
        }

        .sticky-footer {
            background-color: #fff;
            border-top: 1px solid #e3e6f0;
        }

        .copyright {
            font-size: 0.85rem;
            color: #858796;
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

            .container-fluid {
                padding: 1rem 1.5rem;
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
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guru.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_guru/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>   

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola Siswa</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.jurnal.index') }}">
                    <i class="fas fa-book"></i>
                    <span>Jurnal Siswa</span></a> 
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
                        <h1 class="h3 mb-3 mb-sm-0 text-gray-800">Dashboard Guru</h1>
                    </div>

                    <div class="row mb-4">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Siswa Dibimbing</div>
                                        <div class="stat-value">{{ $totalSiswa }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Kehadiran</div>
                                        <div class="stat-value">{{ $kehadiranGlobal['hadir'] }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-label">Total Ketidakhadiran</div>
                                        <div class="stat-value">{{ $kehadiranGlobal['sakit'] + $kehadiranGlobal['alfa'] + $kehadiranGlobal['izin'] }}</div>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-user-times"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="chart-card">
                                <div class="chart-title">Kehadiran Siswa</div>
                                <div class="stat-breakdown">
                                    <div class="stat-item" style="border-left-color: #1e3a6e;">
                                        <div class="stat-item-label">Hadir</div>
                                        <div class="stat-item-value">{{ $kehadiranGlobal['hadir'] }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #1e3a6e;">
                                        <div class="stat-item-label">Sakit</div>
                                        <div class="stat-item-value">{{ $kehadiranGlobal['sakit'] }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #1e3a6e;">
                                        <div class="stat-item-label">Izin</div>
                                        <div class="stat-item-value">{{ $kehadiranGlobal['izin'] }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #1e3a6e;">
                                        <div class="stat-item-label">Libur</div>
                                        <div class="stat-item-value">{{ $kehadiranGlobal['libur'] }}</div>
                                    </div>
                                    <div class="stat-item" style="border-left-color: #1e3a6e;">
                                        <div class="stat-item-label">Alfa</div>
                                        <div class="stat-item-value">{{ $kehadiranGlobal['alfa'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-8">
                            <div class="chart-card">
                                <div class="chart-title">Grafik Kehadiran Per Bulan (Hadir vs Alfa)</div>
                                <canvas id="chartKehadiran" height="80"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="siswa-table">
                                <div class="table-title">5 Siswa Terbaru</div>
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Hadir</th>
                                                <th>Alfa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($siswaList as $siswa)
                                            <tr>
                                                <td>{{ $siswa->nama }}</td>
                                                <td><span class="badge-hadir">{{ $siswa->hadir }}</span></td>
                                                <td><span class="badge-alfa">{{ $siswa->alfa }}</span></td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Belum ada siswa</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
        var ctx = document.getElementById('chartKehadiran').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Hadir',
                        data: [
                            @foreach(range(1, 12) as $bulan)
                                {{ $kehadiranPerBulan['hadir'][$bulan] ?? 0 }},
                            @endforeach
                        ],
                        borderColor: '#1dd1a1',
                        backgroundColor: 'rgba(29, 209, 161, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#1dd1a1'
                    },
                    {
                        label: 'Tidak Hadir',
                        data: [
                            @foreach(range(1, 12) as $bulan)
                                {{ $kehadiranPerBulan['tidakHadir'][$bulan] ?? 0 }},
                            @endforeach
                        ],
                        borderColor: '#e74a3b',
                        backgroundColor: 'rgba(231, 74, 59, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#e74a3b'
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
    </script>

</body>

</html>