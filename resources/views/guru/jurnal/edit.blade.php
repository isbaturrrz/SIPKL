<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Jurnal Siswa - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist_guru/css/style.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_guru/img/logo.png') }}" alt="">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('guru.jurnal.index') }}">
                    <i class="fas fa-book"></i>
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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Jurnal Siswa</h1>
                        <a href="{{ route('guru.jurnal.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
                        </a>
                    </div>

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <ul class="mb-0 pl-3">
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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Edit Jurnal</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('guru.jurnal.update', $jurnal->id_jurnal) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="id_siswa">Pilih Siswa <span class="text-danger">*</span></label>
                                    <select class="form-control @error('id_siswa') is-invalid @enderror" id="id_siswa" name="id_siswa" required>
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach($siswaList as $siswa)
                                        <option value="{{ $siswa->id_siswa }}" {{ old('id_siswa', $jurnal->id_siswa) == $siswa->id_siswa ? 'selected' : '' }}>
                                            {{ $siswa->nama }} - {{ $siswa->instansi->nama_instansi ?? 'Tidak ada instansi' }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tgl">Tanggal <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl" name="tgl" value="{{ old('tgl', $jurnal->tgl) }}" required>
                                            @error('tgl')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jam_mulai">Jam Mulai <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', $jurnal->jam_mulai) }}" required>
                                            @error('jam_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jam_selesai">Jam Selesai <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', $jurnal->jam_selesai) }}" required>
                                            @error('jam_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status_kehadiran">Status Kehadiran <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status_kehadiran') is-invalid @enderror" id="status_kehadiran" name="status_kehadiran" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="wfo" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'wfo' ? 'selected' : '' }}>WFO (Work From Office)</option>
                                        <option value="wfh" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'wfh' ? 'selected' : '' }}>WFH (Work From Home)</option>
                                        <option value="izin" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="sakit" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="libur" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'libur' ? 'selected' : '' }}>Libur</option>
                                        <option value="alfa" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'alfa' ? 'selected' : '' }}>Alfa</option>
                                    </select>
                                    @error('status_kehadiran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kegiatan">Kegiatan <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" rows="4" required>{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
                                    @error('kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="manfaat">Manfaat <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('manfaat') is-invalid @enderror" id="manfaat" name="manfaat" rows="4" required>{{ old('manfaat', $jurnal->manfaat) }}</textarea>
                                    @error('manfaat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('guru.jurnal.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                            </form>
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>