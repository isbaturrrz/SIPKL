<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajukan Instansi - Siswa</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
        }

        #content {
            background-color: #e8eef7;
            min-height: 100vh;
        }

        .topbar {
            background-color: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .form-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .form-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #e3e6f0;
            margin-bottom: 2rem;
        }

        .form-header-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .form-header-text h4 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin: 0;
        }

        .form-header-text p {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0.25rem 0 0 0;
        }

        .form-group label {
            font-weight: 700;
            color: #334155;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-group label .required {
            color: #dc2626;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.1);
        }

        .form-control.is-invalid {
            border-color: #dc2626;
        }

        .invalid-feedback {
            font-size: 0.85rem;
            color: #dc2626;
            margin-top: 0.5rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e3e6f0;
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            color: #fff;
        }

        .btn-cancel {
            background: #fff;
            color: #64748b;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #475569;
            text-decoration: none;
        }

        .info-box {
            background: #dbeafe;
            border-left: 4px solid #3b82f6;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .info-box-title {
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-box-text {
            font-size: 0.9rem;
            color: #1e40af;
            margin: 0;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 1.5rem;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('siswa.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('dist_siswa/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.jurnal.create') }}">
                    <i class="fas fa-pen-square"></i>
                    <span>Catat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.jurnal.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.nilai.index') }}">
                    <i class="fas fa-download"></i>
                    <span>Unduh Nilai</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('siswa.instansi.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Pilih Instansi</span>
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
                        <li class="nav-item">
                            <span class="nav-link text-gray-600 font-weight-bold">Siswa</span>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="form-card">
                        <div class="form-header">
                            <div class="form-header-icon" style="background: linear-gradient(135deg, #e8eef7 0%, #d1dce8 100%);">
                                <i class="fas fa-building" style="color: #1e4179;" ></i>
                            </div>
                            <div class="form-header-text">
                                <h4>Ajukan Instansi PKL</h4>
                                <p>Isi formulir di bawah untuk mengajukan instansi PKL baru</p>
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-title">
                                <i class="fas fa-info-circle"></i>
                                Informasi Penting
                            </div>
                            <p class="info-box-text">
                                Pengajuan instansi akan direview oleh admin. Pastikan data yang Anda masukkan benar dan lengkap.
                                Anda akan mendapat notifikasi setelah pengajuan diproses.
                            </p>
                        </div>

                        <form action="{{ route('siswa.instansi.store') }}" method="POST" id="form-ajukan">
                            @csrf

                            <div class="form-group">
                                <label for="nama_perusahaan">
                                    Nama Perusahaan <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                       id="nama_perusahaan" 
                                       name="nama_perusahaan" 
                                       value="{{ old('nama_perusahaan') }}"
                                       placeholder="Contoh: PT. Teknologi Indonesia"
                                       maxlength="255"
                                       required>
                                @error('nama_perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">
                                    Alamat Lengkap <span class="required">*</span>
                                </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" 
                                          name="alamat" 
                                          rows="3"
                                          placeholder="Contoh: Jl. Raya Ciwidey No. 123, Bandung"
                                          maxlength="255"
                                          required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="latitude">
                                        Latitude (Opsional)
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('latitude') is-invalid @enderror" 
                                           id="latitude" 
                                           name="latitude" 
                                           value="{{ old('latitude') }}"
                                           placeholder="Contoh: -6.914744">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="longitude">
                                        Longitude (Opsional)
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('longitude') is-invalid @enderror" 
                                           id="longitude" 
                                           name="longitude" 
                                           value="{{ old('longitude') }}"
                                           placeholder="Contoh: 107.609810">
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="no_hp">
                                        No. Telepon <span class="required">*</span>
                                    </label>
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

                                <div class="form-group">
                                    <label for="pemilik">
                                        Nama Pemilik <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('pemilik') is-invalid @enderror" 
                                           id="pemilik" 
                                           name="pemilik" 
                                           value="{{ old('pemilik') }}"
                                           placeholder="Contoh: Budi Santoso"
                                           maxlength="50"
                                           required>
                                    @error('pemilik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kuota_siswa">
                                    Kuota Siswa <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('kuota_siswa') is-invalid @enderror" 
                                       id="kuota_siswa" 
                                       name="kuota_siswa" 
                                       placeholder="Contoh: 5"
                                       value="{{ old('kuota_siswa') }}"
                                       max="50"
                                       required>
                                <small class="form-text text-muted">
                                    Jumlah siswa yang dapat diterima di instansi ini
                                </small>
                                @error('kuota_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jurusan_diterima">
                                    Jurusan yang Diterima <span class="required">*</span>
                                </label>
                                <select class="form-control @error('jurusan_diterima') is-invalid @enderror" 
                                        id="jurusan_diterima" 
                                        name="jurusan_diterima" 
                                        style="padding: 0" 
                                        required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="PPLG" {{ old('jurusan_diterima') == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                                    <option value="BRP" {{ old('jurusan_diterima') == 'BRP' ? 'selected' : '' }}>BRP</option>
                                    <option value="DKV" {{ old('jurusan_diterima') == 'DKV' ? 'selected' : '' }}>DKV</option>
                                    <option value="PPLG-BRP" {{ old('jurusan_diterima') == 'PPLG-BRP' ? 'selected' : '' }}>PPLG & BRP</option>
                                    <option value="PPLG-DKV" {{ old('jurusan_diterima') == 'PPLG-DKV' ? 'selected' : '' }}>PPLG & DKV</option>
                                    <option value="BRP-DKV" {{ old('jurusan_diterima') == 'BRP-DKV' ? 'selected' : '' }}>BRP & DKV</option>
                                    <option value="PPLG-BRP-DKV" {{ old('jurusan_diterima') == 'PPLG-BRP-DKV' ? 'selected' : '' }}>Semua Jurusan</option>
                                </select>
                                <small class="form-text text-muted">
                                    Pilih jurusan siswa yang dapat diterima di instansi ini
                                </small>
                                @error('jurusan_diterima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <a href="{{ route('siswa.instansi.index') }}" class="btn-cancel">
                                    <i class="fas fa-times"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane"></i>
                                    Kirim Pengajuan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © COHESION TEAM 2026</span>
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

    <script>
        document.getElementById('no_hp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('kuota_siswa').addEventListener('input', function(e) {
            if (this.value > 50) this.value = 50;
        });
    </script>
</body>
</html>