<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Instansi - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top: 10px;
            border-radius: 5px;
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

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.instansi.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Kelola Instansi</span>
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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Instansi</h6>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('admin.instansi.store') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_instansi">Nama Instansi <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('nama_instansi') is-invalid @enderror" 
                                                   id="nama_instansi" 
                                                   name="nama_instansi" 
                                                   value="{{ old('nama_instansi') }}"
                                                   placeholder="Contoh: PT Maju Jaya"
                                                   required>
                                            @error('nama_instansi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp">No HP Instansi <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('no_hp') is-invalid @enderror" 
                                                   id="no_hp" 
                                                   name="no_hp" 
                                                   value="{{ old('no_hp') }}"
                                                   placeholder="Contoh: 081234567890"
                                                   maxlength="13"
                                                   required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pemilik">Nama Pemilik/Pimpinan <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('pemilik') is-invalid @enderror" 
                                                   id="pemilik" 
                                                   name="pemilik" 
                                                   value="{{ old('pemilik') }}"
                                                   placeholder="Contoh: Budi Santoso"
                                                   required>
                                            @error('pemilik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kuota_siswa">Kuota Siswa <span class="text-danger">*</span></label>
                                            <input type="number" 
                                                   class="form-control @error('kuota_siswa') is-invalid @enderror" 
                                                   id="kuota_siswa" 
                                                   name="kuota_siswa" 
                                                   value="{{ old('kuota_siswa') }}"
                                                   placeholder="Contoh: 10"
                                                   min="1"
                                                   required>
                                            @error('kuota_siswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Jumlah maksimal siswa yang dapat diterima</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_guru">Guru Pembimbing</label>
                                        <select class="form-control @error('id_guru') is-invalid @enderror" 
                                                id="id_guru" 
                                                name="id_guru">
                                            <option value="">-- Pilih Guru Pembimbing --</option>
                                            @foreach($guru as $g)
                                                <option value="{{ $g->id_guru }}" 
                                                    {{ old('id_guru', $instansi->id_guru ?? '') == $g->id_guru ? 'selected' : '' }}>
                                                    {{ $g->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_guru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle"></i> Hanya menampilkan guru yang belum membimbing instansi lain
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" 
                                              name="alamat" 
                                              rows="3"
                                              placeholder="Contoh: Jl. Merdeka No. 123, Bandung"
                                              required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitude">Latitude (GPS)</label>
                                            <input type="text" 
                                                   class="form-control @error('latitude') is-invalid @enderror" 
                                                   id="latitude" 
                                                   name="latitude" 
                                                   value="{{ old('latitude') }}"
                                                   placeholder=""
                                                   readonly>
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitude">Longitude (GPS)</label>
                                            <input type="text" 
                                                   class="form-control @error('longitude') is-invalid @enderror" 
                                                   id="longitude" 
                                                   name="longitude" 
                                                   value="{{ old('longitude') }}"
                                                   placeholder=""
                                                   readonly>
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Pilih Lokasi Tepat</label>
                                    <div id="map"></div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Klik pada peta untuk menandai lokasi instansi
                                    </small>
                                </div>

                                <hr>

                                <div class="alert alert-info">
                                    <strong><i class="fas fa-info-circle"></i> Informasi:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Akun mentor akan otomatis dibuat setelah data instansi disimpan</li>
                                        <li>Username mentor: <strong>nama_instansi</strong> (huruf kecil, spasi diganti underscore)</li>
                                        <li>Password default mentor: <strong>mentor123</strong></li>
                                        <li>Mentor dapat login menggunakan akun tersebut</li>
                                    </ul>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Data
                                    </button>
                                    <a href="{{ route('admin.instansi.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
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

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.914744, 107.609810], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        });
    </script>
</body>
</html>