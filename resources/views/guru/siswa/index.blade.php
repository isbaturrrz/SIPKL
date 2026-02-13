<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kelola Siswa - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist_guru/css/style.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    
    <style>
        .performance-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            margin-right: 5px;
        }
        .badge-hadir {
            background-color: #1cc88a;
            color: white;
        }
        .badge-izin {
            background-color: #f6c23e;
            color: white;
        }
        .badge-sakit {
            background-color: #36b9cc;
            color: white;
        }
        .badge-libur {
            background-color: #858796;
            color: white;
        }
        .badge-alfa {
            background-color: #e74a3b;
            color: white;
        }
        .action-btn {
            padding: 5px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        .action-btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_guru/img/') }}" alt="">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('guru.siswa.index') }}">
                    <i class="fas fa-cart-plus"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.jurnal.index') }}">
                    <i class="fas fa-cart-arrow-down"></i>
                    <span>Jurnal Siswa</span>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600">
                                    Halo {{ Auth::user()->name }}
                                </span>
                            </a>
                        </li>
                        @endauth

                    </ul>

                </nav>
               
                <div class="container-fluid">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! session('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! session('error') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>   
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('guru.siswa.index') }}">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="siswa">Siswa*</label>
                                        <select name="siswa" id="siswa" class="form-control">
                                            <option value="">--Pilih Siswa--</option>
                                            @foreach($siswaList as $siswa)
                                            <option value="{{ $siswa->id_siswa }}">{{ $siswa->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="rentang_waktu">Rentang Waktu*</label>
                                        <select name="rentang_waktu" id="rentang_waktu" class="form-control">
                                            <option value="">--Pilih Bulan--</option>
                                            <option value="januari">Januari</option>
                                            <option value="februari">Februari</option>
                                            <option value="maret">Maret</option>
                                            <option value="april">April</option>
                                            <option value="mei">Mei</option>
                                            <option value="juni">Juni</option>
                                            <option value="juli">Juli</option>
                                            <option value="agustus">Agustus</option>
                                            <option value="september">September</option>
                                            <option value="oktober">Oktober</option>
                                            <option value="november">November</option>
                                            <option value="desember">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-primary btn-block">
                                            <i class="fas fa-download"></i> Unduh Pdf
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari siswa...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead style="background-color: #4e73df; color: white;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Hadir</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Libur</th>
                                            <th>Alfa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="siswaTable">
                                        @forelse($siswaList as $index => $siswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->kelas }} {{ $siswa->jurusan }}</td>
                                            <td>
                                                <span class="performance-badge badge-hadir">{{ $siswa->hadir }}</span>
                                            </td>
                                            <td>
                                                <span class="performance-badge badge-sakit">{{ $siswa->sakit }}</span>
                                            </td>
                                            <td>
                                                <span class="performance-badge badge-izin">{{ $siswa->izin }}</span>
                                            </td>
                                            <td>
                                                <span class="performance-badge badge-libur">{{ $siswa->libur }}</span>
                                            </td>
                                            <td>
                                                <span class="performance-badge badge-alfa">{{ $siswa->alfa }}</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger" onclick="showDetailModal({{ $siswa->id_siswa }}, '{{ $siswa->nama }}')">
                                                    <i class="fas fa-calendar-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada siswa yang dibimbing</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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

    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="detailModalLabel">
                        <i class="fas fa-user-times"></i> Tandai Siswa Alfa
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateStatusForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="font-weight-bold" id="modalSiswaName"></p>
                        
                        <div class="form-group">
                            <label for="tanggal">Tanggal Bolos <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="tanggal" 
                                   id="tanggal" 
                                   class="form-control" 
                                   max="{{ date('Y-m-d') }}"
                                   required>
                            <small class="form-text text-muted">Pilih tanggal saat siswa bolos/alfa</small>
                        </div>
                        
                        <input type="hidden" name="status" value="alfa">
                        
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Perhatian!</strong> Tindakan ini akan menandai siswa sebagai <strong>ALFA</strong> pada tanggal yang dipilih.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-check"></i> Tandai Alfa
                        </button>
                    </div>
                </form>
            </div>
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
        function showDetailModal(siswaId, siswaName) {
            $('#modalSiswaName').text('Nama Siswa: ' + siswaName);
            $('#updateStatusForm').attr('action', '/guru/siswa/' + siswaId + '/update-status');
            $('#tanggal').val(''); 
            $('#detailModal').modal('show');
        }

        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#siswaTable tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>

</body>

</html>