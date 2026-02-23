<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pengajuan Instansi - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_admin/css/style.css')}}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">

    <style>
        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }
        .badge-approved {
            background-color: #28a745;
            color: #fff;
        }
        .badge-rejected {
            background-color: #dc3545;
            color: #fff;
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Instansi dari Siswa</h6>
                            <form action="{{ route('admin.pengajuan-instansi.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control" placeholder="Cari instansi atau siswa..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('admin.pengajuan-instansi.index') }}" class="btn btn-secondary btn-sm ml-2">Reset</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat</th>
                                            <th>No HP</th>
                                            <th>Pemilik</th>
                                            <th>Kuota</th>
                                            <th>Jurusan</th>
                                            <th>Status</th>
                                            <th>Tanggal Ajukan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pengajuan as $index => $item)
                                        <tr>
                                            <td>{{ $pengajuan->firstItem() + $index }}</td>
                                            <td>
                                                <strong>{{ $item->siswa->nama }}</strong><br>
                                                <small class="text-muted">{{ $item->siswa->kelas_lengkap }}</small>
                                            </td>
                                            <td>{{ $item->nama_perusahaan }}</td>
                                            <td>{{ Str::limit($item->alamat, 40) }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>{{ $item->pemilik }}</td>
                                            <td>{{ $item->kuota_siswa }}</td>
                                            <td>
                                                @if($item->jurusan_diterima === 'PPLG-BRP-DKV')
                                                    <span class="badge badge-success">Semua</span>
                                                @else
                                                    @php
                                                        $jurusan_list = explode('-', $item->jurusan_diterima);
                                                    @endphp
                                                    <span class="badge badge-info">{{ implode(', ', $jurusan_list) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status == 'pending')
                                                    <span class="badge badge-pending">Pending</span>
                                                @elseif($item->status == 'approved')
                                                    <span class="badge badge-approved">Approved</span>
                                                @else
                                                    <span class="badge badge-rejected">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.pengajuan-instansi.show', $item->id_pengajuan) }}" 
                                                       class="btn btn-info btn-sm" 
                                                       title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    
                                                    @if($item->status == 'pending')
                                                    <button type="button" 
                                                            class="btn btn-success btn-sm" 
                                                            onclick="confirmApprove({{ $item->id_pengajuan }}, '{{ $item->nama_perusahaan }}')"
                                                            title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm" 
                                                            onclick="showRejectModal({{ $item->id_pengajuan }}, '{{ $item->nama_perusahaan }}')"
                                                            title="Tolak">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                @if(request('search'))
                                                    Tidak ditemukan pengajuan dengan kata kunci: "{{ request('search') }}"
                                                @else
                                                    Belum ada pengajuan instansi
                                                @endif
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Menampilkan {{ $pengajuan->firstItem() ?? 0 }} sampai {{ $pengajuan->lastItem() ?? 0 }} 
                                    dari {{ $pengajuan->total() }} data
                                </div>
                                <div>
                                    {{ $pengajuan->links() }}
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

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="formReject" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Anda akan menolak pengajuan: <strong id="namaPerusahaan"></strong></p>
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

    <form id="form-approve" method="POST" style="display: none;">
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
        function confirmApprove(id, nama) {
            Swal.fire({
                title: 'Setujui Pengajuan?',
                html: `Anda akan menyetujui pengajuan instansi:<br><strong>${nama}</strong><br><br><small>Instansi akan dibuat dan siswa akan otomatis ditempatkan</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('form-approve');
                    form.action = `/admin/pengajuan-instansi/${id}/approve`;
                    form.submit();
                }
            });
        }

        function showRejectModal(id, nama) {
            document.getElementById('namaPerusahaan').textContent = nama;
            document.getElementById('formReject').action = `/admin/pengajuan-instansi/${id}/reject`;
            $('#rejectModal').modal('show');
        }
    </script>
</body>
</html>