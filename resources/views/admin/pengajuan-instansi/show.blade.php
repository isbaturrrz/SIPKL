<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Pengajuan - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_admin/css/style.css')}}">
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
        }

        @media (max-width: 480px) {
            .sidebar-brand-icon img {
                max-width: 60px;
            }

            .sidebar.toggled .sidebar-brand-icon img {
                max-width: 45px;
            }
        }

        .detail-label {
            font-weight: 700;
            color: #6c757d;
            width: 200px;
        }
        .detail-value {
            color: #212529;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_admin/img/logo.png')}}" alt="">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
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

            <li class="nav-item active">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600">
                                    Halo {{ Auth::user()->name }}
                                </span>                             
                            </a>                         
                        </li>
                        @endauth
                    </ul>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Pengajuan Instansi</h1>
                        <a href="{{ route('admin.pengajuan-instansi.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Siswa</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="detail-label">Nama</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">NIPD</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->nipd }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Kelas</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->kelas_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Jurusan</td>
                                            <td class="detail-value">: {{ $pengajuan->siswa->jurusan_lengkap }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Instansi</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="detail-label">Nama Perusahaan</td>
                                            <td class="detail-value">: {{ $pengajuan->nama_perusahaan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Pemilik</td>
                                            <td class="detail-value">: {{ $pengajuan->pemilik }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">No HP</td>
                                            <td class="detail-value">: {{ $pengajuan->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Kuota Siswa</td>
                                            <td class="detail-value">: {{ $pengajuan->kuota_siswa }} siswa</td>
                                        </tr>
                                        <tr>
                                            <td class="detail-label">Jurusan Diterima</td>
                                            <td class="detail-value">
                                                : @if($pengajuan->jurusan_diterima === 'PPLG-BRP-DKV')
                                                    <span class="badge badge-success">Semua Jurusan</span>
                                                @else
                                                    @php
                                                        $jurusan_list = explode('-', $pengajuan->jurusan_diterima);
                                                    @endphp
                                                    <span class="badge badge-info">{{ implode(', ', $jurusan_list) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Lengkap</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="detail-label">Alamat</td>
                                    <td class="detail-value">: {{ $pengajuan->alamat }}</td>
                                </tr>
                                @if($pengajuan->latitude && $pengajuan->longitude)
                                <tr>
                                    <td class="detail-label">Koordinat</td>
                                    <td class="detail-value">: {{ $pengajuan->latitude }}, {{ $pengajuan->longitude }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="detail-label">Status</td>
                                    <td class="detail-value">
                                        : @if($pengajuan->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($pengajuan->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($pengajuan->status == 'rejected' && $pengajuan->keterangan_reject)
                                <tr>
                                    <td class="detail-label">Alasan Penolakan</td>
                                    <td class="detail-value">: {{ $pengajuan->keterangan_reject }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="detail-label">Tanggal Pengajuan</td>
                                    <td class="detail-value">: {{ $pengajuan->created_at->format('d F Y, H:i') }}</td>
                                </tr>
                            </table>

                            @if($pengajuan->status == 'pending')
                            <div class="mt-4 d-flex gap-2">
                                <button type="button" 
                                        class="btn btn-success" 
                                        onclick="confirmApprove()">
                                    <i class="fas fa-check"></i> Setujui Pengajuan
                                </button>
                                <button type="button" 
                                        class="btn btn-danger ml-2" 
                                        data-toggle="modal" 
                                        data-target="#rejectModal">
                                    <i class="fas fa-times"></i> Tolak Pengajuan
                                </button>
                            </div>
                            @endif
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

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pengajuan-instansi.reject', $pengajuan->id_pengajuan) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Anda akan menolak pengajuan: <strong>{{ $pengajuan->nama_perusahaan }}</strong></p>
                        <div class="form-group">
                            <label for="keterangan_reject">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea class="form-control" 
                                      id="keterangan_reject" 
                                      name="keterangan_reject" 
                                      rows="3" 
                                      required
                                      placeholder="Contoh: Data tidak lengkap, alamat tidak jelas, dll"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="form-approve" action="{{ route('admin.pengajuan-instansi.approve', $pengajuan->id_pengajuan) }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmApprove() {
            Swal.fire({
                title: 'Setujui Pengajuan?',
                html: `Anda akan menyetujui pengajuan instansi:<br><strong>{{ $pengajuan->nama_perusahaan }}</strong><br><br><small>Instansi akan dibuat dan siswa akan otomatis ditempatkan</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-approve').submit();
                }
            });
        }
    </script>
</body>
</html>