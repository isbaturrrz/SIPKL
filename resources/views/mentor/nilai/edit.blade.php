<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Nilai - Mentor</title>
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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Nilai Siswa: {{ $siswa->nama }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('mentor.nilai.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">

                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Kreativitas</label>
                                            <input type="number" name="nilai_kreatifitas" class="form-control" value="{{ $siswa->penilaian->nilai_kreatifitas }}" min="0" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Kedisiplinan</label>
                                            <input type="number" name="nilai_kedisiplinan" class="form-control" value="{{ $siswa->penilaian->nilai_kedisiplinan }}" min="0" max="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Tanggung Jawab</label>
                                            <input type="number" name="nilai_tanggung_jawab" class="form-control" value="{{ $siswa->penilaian->nilai_tanggung_jawab }}" min="0" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Kerjasama</label>
                                            <input type="number" name="nilai_kerjasama" class="form-control" value="{{ $siswa->penilaian->nilai_kerjasama }}" min="0" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Komunikasi</label>
                                            <input type="number" name="nilai_komunikasi" class="form-control" value="{{ $siswa->penilaian->nilai_komunikasi }}" min="0" max="100" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold text-dark">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="3">{{ $siswa->penilaian->keterangan }}</textarea>
                                </div>

                                <div class="text-right mt-4">
                                    <a href="{{ route('mentor.nilai.index') }}" class="btn btn-secondary mr-2">Batal</a>
                                    <button type="submit" class="btn btn-primary px-4">Update Nilai</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto text-center">
                    <span>Copyright &copy; COHESION TEAM 2026</span>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
</body>
</html>