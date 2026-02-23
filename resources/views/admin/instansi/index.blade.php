<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kelola Instansi - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
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

            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Data Instansi</h1>
                        <a href="{{ route('admin.instansi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Instansi
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cari Instansi</h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.instansi.index') }}">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input type="text" name="search" class="form-control" 
                                               placeholder="Cari nama instansi, pemilik, alamat..." 
                                               value="{{ request('search') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label>Filter Jurusan</label>
                                        <select name="jurusan" class="form-control">
                                            <option value="">-- Semua Jurusan --</option>
                                            <option value="PPLG" {{ request('jurusan') == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                                            <option value="BRP" {{ request('jurusan') == 'BRP' ? 'selected' : '' }}>BRP</option>
                                            <option value="DKV" {{ request('jurusan') == 'DKV' ? 'selected' : '' }}>DKV</option>
                                            <option value="PPLG-BRP-DKV" {{ request('jurusan') == 'PPLG-BRP-DKV' ? 'selected' : '' }}>Semua Jurusan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Filter Sumber</label>
                                        <select name="sumber" class="form-control">
                                            <option value="">-- Semua Sumber --</option>
                                            <option value="admin" {{ request('sumber') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="pengajuan" {{ request('sumber') == 'pengajuan' ? 'selected' : '' }}>Pengajuan Siswa</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Filter Kuota</label>
                                        <select name="kuota" class="form-control">
                                            <option value="">-- Semua --</option>
                                            <option value="tersedia" {{ request('kuota') == 'tersedia' ? 'selected' : '' }}>Kuota Tersedia</option>
                                            <option value="penuh" {{ request('kuota') == 'penuh' ? 'selected' : '' }}>Kuota Penuh</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                        <a href="{{ route('admin.instansi.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-sync"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Instansi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="3%">No</th>
                                            <th>Nama Instansi</th>
                                            <th>Pemilik</th>
                                            <th>No HP</th>
                                            <th>Jurusan</th>
                                            <th>Kuota</th>
                                            <th>Guru</th>
                                            <th>Sumber</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($instansi as $index => $item)
                                        <tr>
                                            <td>{{ $instansi->firstItem() + $index }}</td>
                                            <td>{{ $item->nama_instansi }}</td>
                                            <td>{{ $item->pemilik }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>
                                                @if($item->jurusan_diterima === 'PPLG-BRP-DKV')
                                                    <span class="badge badge-success">Semua Jurusan</span>
                                                @else
                                                    @php
                                                        $jurusan_list = explode('-', $item->jurusan_diterima);
                                                    @endphp
                                                    <span class="badge badge-primary">{{ implode(', ', $jurusan_list) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $item->kuota_terpakai >= $item->kuota_siswa ? 'badge-danger' : 'badge-info' }}">
                                                    {{ $item->kuota_terpakai }}/{{ $item->kuota_siswa }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->guru)
                                                    <span class="badge badge-success">{{ $item->guru->nama }}</span>
                                                @else
                                                    <span class="badge badge-secondary">Belum ada</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->is_from_submission)
                                                    <span class="badge badge-info">Pengajuan</span>
                                                @else
                                                    <span class="badge badge-success">Admin</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.instansi.show', $item->id_instansi) }}" 
                                                   class="btn btn-info btn-sm" 
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.instansi.edit', $item->id_instansi) }}" 
                                                   class="btn btn-warning btn-sm"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.instansi.destroy', $item->id_instansi) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Belum ada data instansi</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Menampilkan {{ $instansi->firstItem() ?? 0 }} - {{ $instansi->lastItem() ?? 0 }} 
                                    dari {{ $instansi->total() }} data
                                </div>
                                <div>
                                    {{ $instansi->appends(request()->query())->links() }}
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
</body>
</html>