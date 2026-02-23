<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Input Nilai - Mentor</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <style>
        .table-nilai th { vertical-align: middle; text-align: center; background-color: #f8f9fc; }
        .box-summary { border: 1px solid #e3e6f0; margin-bottom: 20px; }
        .box-summary .label { background-color: #f8f9fc; font-weight: bold; padding: 10px; border-bottom: 1px solid #e3e6f0; }
        .box-summary .value { padding: 15px; font-size: 1.5rem; font-weight: bold; }
    </style>
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
                    <span class="ml-3 font-weight-bold text-primary">Input Nilai Siswa</span>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="100">Nama</td>
                                            <td class="font-weight-bold">: {{ $siswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jurusan</td>
                                            <td class="font-weight-bold">: {{ $siswa->jurusan }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('mentor.nilai.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
                        
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penilaian</h6>
                            </div>
                            <div class="card-body">
                                <div class="row no-gutters text-center box-summary">
                                    <div class="col-6 border-right">
                                        <div class="label text-dark">NILAI AKHIR</div>
                                        <div class="value text-primary" id="display-rata-rata">0.00</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="label text-dark">HURUF / PREDIKAT</div>
                                        <div class="value text-primary" id="display-huruf">-</div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-nilai">
                                        <thead>
                                            <tr>
                                                <th width="50">No</th>
                                                <th>ASPEK YANG DINILAI</th>
                                                <th width="200">NILAI (0-100)</th>
                                                <th width="150">PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>Kedisiplinan</td>
                                                <td><input type="number" name="nilai_kedisiplinan" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>Kretifitas</td>
                                                <td><input type="number" name="nilai_kreatifitas" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>Tanggung Jawab</td>
                                                <td><input type="number" name="nilai_tanggung_jawab" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>Kerjasama</td>
                                                <td><input type="number" name="nilai_kerjasama" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td>Komunikasi</td>
                                                <td><input type="number" name="nilai_komunikasi" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-light font-weight-bold text-center">
                                                <td colspan="2">RATA-RATA</td>
                                                <td id="total-score">0</td>
                                                <td>-</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold text-dark">Keterangan Tambahan</label>
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Sangat baik dalam bekerja tim..."></textarea>
                                </div>

                                <div class="mt-4 text-right">
                                    <a href="{{ route('mentor.nilai.index') }}" class="btn btn-secondary shadow-sm">Kembali</a>
                                    <button type="submit" class="btn btn-primary shadow-sm">
                                        <i class="fas fa-save mr-1"></i> Simpan Nilai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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

    <script>
        $(document).ready(function() {
            $('.input-score').on('input', function() {
                let total = 0;
                let count = 0;

                $('.input-score').each(function() {
                    let val = parseFloat($(this).val()) || 0;
                    if(val > 100) { $(this).val(100); val = 100; }
                    
                    total += val;
                    count++;

                    let p = getPredikat(val);
                    $(this).closest('tr').find('.row-predikat').text(val > 0 ? p : '-');
                });

                let rataRata = total / count;
                $('#total-score').text(rataRata.toFixed(2));
                $('#display-rata-rata').text(rataRata.toFixed(2));
                $('#display-huruf').text(rataRata > 0 ? getPredikat(rataRata) : '-');
            });

            function getPredikat(n) {
                if (n >= 90) return 'A';
                if (n >= 80) return 'B';
                if (n >= 70) return 'C';
                if (n >= 60) return 'D';
                return 'E';
            }
        });
    </script>
</body>
</html>