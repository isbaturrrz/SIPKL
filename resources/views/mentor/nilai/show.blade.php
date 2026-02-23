<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Nilai - Mentor</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_mentor/img/')}}" alt="">
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
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Nilai: {{ $siswa->nama }}</h6>
                            <a href="{{ route('mentor.nilai.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="font-weight-bold">Informasi Siswa</h5>
                                    <p class="mb-1 text-dark">Nama: <strong>{{ $siswa->nama }}</strong></p>
                                    <p class="text-dark">Kelas: <strong>{{ $siswa->kelas }}</strong></p>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <div class="bg-light p-3 border rounded shadow-sm">
                                        <h6 class="text-primary font-weight-bold mb-0 text-uppercase small">Rata-rata Nilai Akhir</h6>
                                        <h1 class="font-weight-bold text-dark mb-0">{{ $siswa->penilaian->nilai_akhir }}</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Kedisiplinan</th>
                                            <th>Kreativitas</th>
                                            <th>Tanggung Jawab</th>
                                            <th>Kerjasama</th>
                                            <th>Komunikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="h4 font-weight-bold">{{ $siswa->penilaian->nilai_kedisiplinan }}</td>
                                            <td class="h4 font-weight-bold">{{ $siswa->penilaian->nilai_kreatifitas }}</td>
                                            <td class="h4 font-weight-bold">{{ $siswa->penilaian->nilai_tanggung_jawab }}</td>
                                            <td class="h4 font-weight-bold">{{ $siswa->penilaian->nilai_kerjasama }}</td>
                                            <td class="h4 font-weight-bold">{{ $siswa->penilaian->nilai_komunikasi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <h6 class="font-weight-bold text-primary">Keterangan:</h6>
                                <p class="border p-3 rounded bg-light text-dark">
                                    {{ $siswa->penilaian->keterangan ?? 'Tidak ada keterangan.' }}
                                </p>
                            </div>

                            <div class="mt-4 text-right">
                                <a href="{{ route('mentor.nilai.edit', $siswa->id_siswa) }}" class="btn btn-warning">
                                    <i class="fas fa-edit mr-1"></i> Edit Nilai
                                </a>
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
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
</body>
</html>