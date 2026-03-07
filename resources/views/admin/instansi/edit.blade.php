<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Instansi - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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

        #map {
            height: 400px;
            width: 100%;
            margin-top: 10px;
            border-radius: 5px;
        }

        .swal2-popup {
            border-radius: 16px !important;
            padding: 0 !important;
            width: 85% !important;
            max-width: 450px !important;
        }

        .swal2-icon {
            width: 60px !important;
            height: 60px !important;
            margin: 1.5rem auto 1rem !important;
            border-width: 3px !important;
        }

        .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }

        .swal2-icon .swal2-icon-content {
            font-size: 2.5rem !important;
        }

        .swal2-title {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #1a1a1a !important;
            padding: 0 1.5rem !important;
            margin-bottom: 0.75rem !important;
            line-height: 1.3 !important;
        }

        .swal2-html-container {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            font-size: 0.9rem !important;
            color: #64748b !important;
            line-height: 1.5 !important;
        }

        .swal2-actions {
            margin: 0 !important;
            padding: 0 1.5rem 1.5rem !important;
            gap: 0.75rem !important;
            display: flex !important;
            width: 100% !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%) !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4) !important;
        }

        .swal2-cancel {
            background: #fff !important;
            color: #64748b !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: 2px solid #e2e8f0 !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-cancel:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #475569 !important;
        }

        .swal2-styled:focus {
            box-shadow: none !important;
        }

        .btn-primary{
             background: linear-gradient(135deg,#182151 11%,#3F7FB6 75%,#010B40 100% );
        }

        @media (max-width: 768px) {
            .swal2-popup {
                width: 90% !important;
                max-width: 380px !important;
            }
        }

        @media (max-width: 576px) {
            .swal2-popup {
                width: 92% !important;
                max-width: 340px !important;
            }
            
            .swal2-icon {
                width: 56px !important;
                height: 56px !important;
                margin: 1.25rem auto 0.75rem !important;
            }
            
            .swal2-title {
                font-size: 1.1rem !important;
                padding: 0 1rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .swal2-html-container {
                padding: 0 1rem 1.25rem !important;
                font-size: 0.85rem !important;
            }
            
            .swal2-actions {
                padding: 0 1rem 1.25rem !important;
                gap: 0.5rem !important;
            }
            
            .swal2-confirm,
            .swal2-cancel {
                padding: 0.6rem 1.25rem !important;
                font-size: 0.85rem !important;
            }
        }

        @media (max-width: 400px) {
            .swal2-popup {
                width: 95% !important;
                max-width: 300px !important;
            }
            
            .swal2-icon {
                width: 48px !important;
                height: 48px !important;
                margin: 1rem auto 0.5rem !important;
            }
            
            .swal2-title {
                font-size: 1rem !important;
                padding: 0 0.75rem !important;
            }
            
            .swal2-html-container {
                padding: 0 0.75rem 1rem !important;
                font-size: 0.8rem !important;
            }
            
            .swal2-actions {
                padding: 0 0.75rem 1rem !important;
                flex-direction: column !important;
                gap: 0.5rem !important;
            }
            
            .swal2-confirm,
            .swal2-cancel {
                padding: 0.55rem 1rem !important;
                font-size: 0.8rem !important;
                width: 100% !important;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_admin/img/logo.png')}}" alt="IPKL">
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Data Instansi</h1>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Edit Instansi</h6>
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

                            <form action="{{ route('admin.instansi.update', $instansi->id_instansi) }}" method="POST" id="instansiForm">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_instansi">Nama Instansi <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                class="form-control @error('nama_instansi') is-invalid @enderror" 
                                                id="nama_instansi" 
                                                name="nama_instansi" 
                                                value="{{ old('nama_instansi', $instansi->nama_instansi) }}"
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
                                                value="{{ old('no_hp', $instansi->no_hp) }}"
                                                placeholder="Masukkan nomor HP (maksimal 13 digit)"
                                                maxlength="13" 
                                                pattern="[0-9]+" 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
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
                                                value="{{ old('pemilik', $instansi->pemilik) }}"
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
                                                value="{{ old('kuota_siswa', $instansi->kuota_siswa) }}"
                                                min="1"
                                                required>
                                            @error('kuota_siswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Kuota terpakai saat ini: <strong>{{ $instansi->kuota_terpakai }}</strong> siswa
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="jurusan_diterima">Jurusan yang Diterima <span class="text-danger">*</span></label>
                                            <select name="jurusan_diterima" 
                                                    id="jurusan_diterima" 
                                                    class="form-control @error('jurusan_diterima') is-invalid @enderror" 
                                                    required>
                                                <option value="">-- Pilih Jurusan yang Diterima --</option>
                                                
                                                <optgroup label="Satu Jurusan">
                                                    <option value="PPLG" {{ old('jurusan_diterima', $instansi->jurusan_diterima) == 'PPLG' ? 'selected' : '' }}>
                                                        PPLG (Pengembangan Perangkat Lunak dan Gim)
                                                    </option>
                                                    <option value="BRP" {{ old('jurusan_diterima', $instansi->jurusan_diterima) == 'BRP' ? 'selected' : '' }}>
                                                        BRP (Broadcasting dan Perfilman)
                                                    </option>
                                                    <option value="DKV" {{ old('jurusan_diterima', $instansi->jurusan_diterima) == 'DKV' ? 'selected' : '' }}>
                                                        DKV (Desain Komunikasi Visual)
                                                    </option>
                                                </optgroup>
                                                
                                                <optgroup label="Dua Jurusan">
                                                    <option value="PPLG-BRP" {{ old('jurusan_diterima', $instansi->jurusan_diterima) == 'PPLG-BRP' ? 'selected' : '' }}>
                                                        PPLG dan BRP
                                                    </option>
                                                    <option value="PPLG-DKV" {{ old('jurusan_diterima', $instansi->jurusan_diterima) == 'PPLG-DKV' ? 'selected' : '' }}>
                                                        PPLG dan DKV
                                                    </option>
                                                    <option value="BRP-DKV" {{ old('jurusan_diterima', $instansi->jurusan_diterima) == 'BRP-DKV' ? 'selected' : '' }}>
                                                        BRP dan DKV
                                                    </option>
                                                </optgroup>
                                                
                                                <optgroup label="Semua Jurusan">
                                                    <option value="PPLG-BRP-DKV" {{ old('jurusan_diterima', $instansi->jurusan_diterima) == 'PPLG-BRP-DKV' ? 'selected' : '' }}>
                                                        Semua Jurusan (PPLG, BRP, DKV)
                                                    </option>
                                                </optgroup>
                                            </select>
                                            @error('jurusan_diterima')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle"></i> Pilih jurusan yang dapat diterima di instansi ini
                                            </small>
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
                                            required>{{ old('alamat', $instansi->alamat) }}</textarea>
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
                                                value="{{ old('latitude', $instansi->latitude) }}"
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
                                                value="{{ old('longitude', $instansi->longitude) }}"
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
                                        <i class="fas fa-info-circle"></i> Klik pada peta untuk memperbarui lokasi instansi
                                    </small>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <a href="{{ route('admin.instansi.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                     <button type="button" id="btnUpdate" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Data
                                    </button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var existingLat = {{ $instansi->latitude ?? '-6.914744' }};
        var existingLng = {{ $instansi->longitude ?? '107.609810' }};

        var map = L.map('map').setView([existingLat, existingLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        if (existingLat && existingLng) {
            marker = L.marker([existingLat, existingLng]).addTo(map);
        }

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

        function getJurusanLabel(value) {
            const jurusanLabels = {
                'PPLG': 'PPLG',
                'BRP': 'BRP',
                'DKV': 'DKV',
                'PPLG-BRP': 'PPLG dan BRP',
                'PPLG-DKV': 'PPLG dan DKV',
                'BRP-DKV': 'BRP dan DKV',
                'PPLG-BRP-DKV': 'Semua Jurusan'
            };
            return jurusanLabels[value] || value;
        }

        document.getElementById('btnUpdate').addEventListener('click', function(e) {
            e.preventDefault();
            
            const namaInstansi = document.getElementById('nama_instansi').value;
            const pemilik = document.getElementById('pemilik').value;
            const noHp = document.getElementById('no_hp').value;
            const kuotaSiswa = document.getElementById('kuota_siswa').value;
            const jurusanValue = document.getElementById('jurusan_diterima').value;
            const jurusanLabel = getJurusanLabel(jurusanValue);
            const guruSelect = document.getElementById('id_guru');
            const guruText = guruSelect.options[guruSelect.selectedIndex].text;
            const alamat = document.getElementById('alamat').value;

            const confirmHTML = `
                <div style="padding: 0.5rem 0;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-building" style="font-size: 1.75rem; color: #f59e0b;"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Update Instansi</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin mengupdate data instansi berikut?</p>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left; max-height: 300px; overflow-y: auto;">
                        <table style="width: 100%; font-size: 0.85rem;">
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Nama Instansi:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${namaInstansi}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Pemilik:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${pemilik}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">No HP:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${noHp}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Kuota Siswa:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kuotaSiswa} siswa</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Jurusan:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${jurusanLabel}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Guru:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${guruText}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Alamat:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${alamat.substring(0, 50)}${alamat.length > 50 ? '...' : ''}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                        <p style="font-size: 0.8rem; color: #92400e; margin: 0; font-weight: 600;">
                            <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                            Data instansi akan diperbarui
                        </p>
                    </div>
                </div>
            `;

            Swal.fire({
                html: confirmHTML,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-save" style="margin-right: 0.5rem;"></i>Ya, Update',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('instansiForm').submit();
                }
            });
        });
    </script>
</body>
</html>