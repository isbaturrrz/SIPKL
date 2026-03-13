<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Jurnal Siswa - Guru</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_guru/css/style.css') }}">
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

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .topbar .nav-item .nav-link {
            height: 4.375rem;
            display: flex;
            align-items: center;
        }

        #content {
            background-color: #f8f9fc;
            min-height: 100vh;
        }

        .form-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .form-card h6 {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2c5aa0;
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .radio-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 0.75rem;
        }

        .radio-item {
            flex: none;
        }

        .radio-item input[type="radio"] {
            display: none;
        }

        .radio-item label {
            display: block;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            color: #64748b;
        }

        .radio-item input[type="radio"]:checked + label {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%);
            color: #fff;
            border-color: #1e4179;
        }

        .radio-item label:hover {
            border-color: #2c5aa0;
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8fafc;
            position: relative;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .upload-area:hover {
            border-color: #2c5aa0;
            background: #f1f5f9;
        }

        .upload-area.dragover {
            border-color: #2c5aa0;
            background: #e0e7ff;
        }

        .upload-placeholder i {
            font-size: 3rem;
            color: #94a3b8;
            margin-bottom: 1rem;
        }

        .upload-placeholder p {
            font-weight: 600;
            color: #475569;
            font-size: 0.95rem;
        }

        .image-preview {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .image-preview img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ef4444;
            color: #fff;
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        .btn-remove-image:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s;
            border: none;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4);
            color: #fff;
        }

        .btn-secondary-custom {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary-custom:hover {
            background: #475569;
            color: #fff;
        }

        .alert-custom {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .field-disabled {
            opacity: 0.6;
            pointer-events: none;
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

        .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
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

            .container-fluid {
                padding: 1rem 1.5rem;
            }

            .radio-group {
                grid-template-columns: 1fr 1fr;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .swal2-popup {
                width: 90% !important;
                max-width: 380px !important;
            }

            .upload-area {
                padding: 1.5rem;
                min-height: 180px;
            }

            .upload-placeholder i {
                font-size: 2.5rem;
            }

            .image-preview img {
                max-height: 250px;
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

            .upload-area {
                padding: 1.25rem;
                min-height: 160px;
            }

            .upload-placeholder i {
                font-size: 2rem;
            }

            .image-preview img {
                max-height: 200px;
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

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guru.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{ asset('dist_guru/img/logo.png') }}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-th-large"></i>
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

                    @if(session('error'))
                    <div class="alert alert-danger alert-custom alert-dismissible fade show">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-custom alert-dismissible fade show">
                        <i class="fas fa-exclamation-triangle"></i>
                        <ul class="mb-0 pl-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <form action="{{ route('guru.jurnal.store') }}" method="POST" id="jurnalForm" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-card">
                            <h6>Informasi Siswa</h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pilih Siswa <span class="text-danger">*</span></label>
                                    <select name="id_siswa" id="id_siswa" class="form-control @error('id_siswa') is-invalid @enderror" required>
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach($siswaList as $siswa)
                                        <option value="{{ $siswa->id_siswa }}" {{ old('id_siswa') == $siswa->id_siswa ? 'selected' : '' }}>
                                            {{ $siswa->nama }} - {{ $siswa->kelas_lengkap }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Pilih siswa yang akan dibuatkan jurnal</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           name="tgl" 
                                           id="tgl" 
                                           class="form-control @error('tgl') is-invalid @enderror" 
                                           value="{{ old('tgl') }}" 
                                           max="{{ date('Y-m-d') }}"
                                           required>
                                    @error('tgl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Pilih tanggal jurnal yang terlewat</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-card">
                            <h6>Kehadiran</h6>

                            <div class="mb-3">
                                <label class="form-label">Status Kehadiran <span class="text-danger">*</span></label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="wfo" name="status_kehadiran" value="wfo" {{ old('status_kehadiran', 'wfo') == 'wfo' ? 'checked' : '' }} required>
                                        <label for="wfo">WFO</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="wfh" name="status_kehadiran" value="wfh" {{ old('status_kehadiran') == 'wfh' ? 'checked' : '' }}>
                                        <label for="wfh">WFH</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="sakit" name="status_kehadiran" value="sakit" {{ old('status_kehadiran') == 'sakit' ? 'checked' : '' }}>
                                        <label for="sakit">Sakit</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="izin" name="status_kehadiran" value="izin" {{ old('status_kehadiran') == 'izin' ? 'checked' : '' }}>
                                        <label for="izin">Izin</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="libur" name="status_kehadiran" value="libur" {{ old('status_kehadiran') == 'libur' ? 'checked' : '' }}>
                                        <label for="libur">Libur</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="jamContainer">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jam Masuk</label>
                                    <input type="time" 
                                           name="jam_mulai" 
                                           id="jam_mulai" 
                                           class="form-control @error('jam_mulai') is-invalid @enderror" 
                                           value="{{ old('jam_mulai') }}">
                                    @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jam Pulang</label>
                                    <input type="time" 
                                           name="jam_selesai" 
                                           id="jam_selesai" 
                                           class="form-control @error('jam_selesai') is-invalid @enderror" 
                                           value="{{ old('jam_selesai') }}">
                                    @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-card" id="kegiatanCard">
                            <h6>Kegiatan yang Dilakukan</h6>
                            <textarea name="kegiatan" 
                                      id="kegiatan" 
                                      class="form-control @error('kegiatan') is-invalid @enderror" 
                                      placeholder="Tuliskan kegiatan yang dilakukan siswa pada hari tersebut...">{{ old('kegiatan') }}</textarea>
                            @error('kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-card" id="manfaatCard">
                            <h6>Manfaat yang Didapat</h6>
                            <textarea name="manfaat" 
                                      id="manfaat" 
                                      class="form-control @error('manfaat') is-invalid @enderror" 
                                      placeholder="Tuliskan manfaat atau pembelajaran yang didapat siswa dari kegiatan tersebut...">{{ old('manfaat') }}</textarea>
                            @error('manfaat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-card" id="fotoCard">
                            <h6>Bukti Foto Kegiatan (Opsional)</h6>
                            <div class="upload-area" id="uploadArea">
                                <input type="file" name="foto_kegiatan" id="foto_kegiatan" accept="image/jpeg,image/jpg,image/png" hidden>
                                <div class="upload-placeholder" id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="mb-1">Klik atau drag foto ke sini</p>
                                    <small class="text-muted">Format: JPG, JPEG, PNG (Max 2MB)</small>
                                </div>
                                <div class="image-preview" id="imagePreview" style="display: none;">
                                    <img id="previewImage" src="" alt="Preview">
                                    <button type="button" class="btn-remove-image" id="removeImage">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="fileError" class="text-danger mt-2" style="display: none; font-size: 0.85rem;"></div>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('guru.jurnal.index') }}" class="btn btn-secondary-custom btn-action">
                                <i class="fas fa-times"></i>
                                Batal
                            </a>
                            <button type="button" id="btnSimpan" class="btn btn-primary-custom btn-action">
                                <i class="fas fa-save"></i>
                                Simpan Jurnal
                            </button>
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
   
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function initializePhotoUpload() {
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('foto_kegiatan');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            const removeImage = document.getElementById('removeImage');
            const fileError = document.getElementById('fileError');

            uploadArea.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove-image')) return;
                fileInput.click();
            });

            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelect(files[0]);
                }
            });

            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    handleFileSelect(e.target.files[0]);
                }
            });

            removeImage.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                uploadPlaceholder.style.display = 'block';
                imagePreview.style.display = 'none';
                previewImage.src = '';
                fileError.style.display = 'none';
            });

            function handleFileSelect(file) {
                fileError.style.display = 'none';

                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    fileError.textContent = 'Format file tidak valid. Gunakan JPG, JPEG, atau PNG';
                    fileError.style.display = 'block';
                    fileInput.value = '';
                    return;
                }

                const maxSize = 2 * 1024 * 1024;
                if (file.size > maxSize) {
                    fileError.textContent = 'Ukuran file terlalu besar. Maksimal 2MB';
                    fileError.style.display = 'block';
                    fileInput.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    uploadPlaceholder.style.display = 'none';
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function toggleFields() {
            const status = $('input[name="status_kehadiran"]:checked').val();
            
            const jamContainer = $('#jamContainer');
            const jamMulai = $('#jam_mulai');
            const jamSelesai = $('#jam_selesai');
            const kegiatanCard = $('#kegiatanCard');
            const manfaatCard = $('#manfaatCard');
            const fotoCard = $('#fotoCard');
            const kegiatanField = $('#kegiatan');
            const manfaatField = $('#manfaat');
            const fotoField = $('#foto_kegiatan');
            
            jamContainer.removeClass('field-disabled');
            kegiatanCard.removeClass('field-disabled');
            manfaatCard.removeClass('field-disabled');
            fotoCard.removeClass('field-disabled');
            
            jamMulai.removeAttr('disabled');
            jamSelesai.removeAttr('disabled');
            kegiatanField.removeAttr('disabled');
            manfaatField.removeAttr('disabled');
            fotoField.removeAttr('disabled');
            
            if (status === 'wfo' || status === 'wfh') {
                jamMulai.prop('required', true);
                jamSelesai.prop('required', true);
                kegiatanField.prop('required', true);
                manfaatField.prop('required', true);
                kegiatanField.attr('placeholder', 'Tuliskan kegiatan yang dilakukan siswa pada hari tersebut...');
            } 
            else if (status === 'izin') {
                jamMulai.prop('required', false);
                jamSelesai.prop('required', false);
                kegiatanField.prop('required', true);
                manfaatField.prop('required', false);
                
                kegiatanField.attr('placeholder', 'Tuliskan alasan/keterangan izin...');
                
                jamContainer.addClass('field-disabled');
                jamMulai.attr('disabled', true);
                jamSelesai.attr('disabled', true);
                jamMulai.val('');
                jamSelesai.val('');
                
                kegiatanCard.removeClass('field-disabled');
                
                manfaatCard.addClass('field-disabled');
                manfaatField.attr('disabled', true);
                manfaatField.val('');
                
                fotoCard.addClass('field-disabled');
                fotoField.attr('disabled', true);
                fotoField.val('');
                $('#uploadPlaceholder').show();
                $('#imagePreview').hide();
            }
            else {
                jamMulai.prop('required', false);
                jamSelesai.prop('required', false);
                kegiatanField.prop('required', false);
                manfaatField.prop('required', false);
                
                kegiatanField.attr('placeholder', 'Tuliskan kegiatan yang dilakukan siswa pada hari tersebut...');
                
                jamContainer.addClass('field-disabled');
                jamMulai.attr('disabled', true);
                jamSelesai.attr('disabled', true);
                jamMulai.val('');
                jamSelesai.val('');
                
                kegiatanCard.addClass('field-disabled');
                kegiatanField.attr('disabled', true);
                kegiatanField.val('');
                
                manfaatCard.addClass('field-disabled');
                manfaatField.attr('disabled', true);
                manfaatField.val('');
                
                fotoCard.addClass('field-disabled');
                fotoField.attr('disabled', true);
                fotoField.val('');
                $('#uploadPlaceholder').show();
                $('#imagePreview').hide();
            }
        }

        document.getElementById('btnSimpan').addEventListener('click', function(e) {
            e.preventDefault();
            
            const siswaSelect = document.getElementById('id_siswa');
            const siswaText = siswaSelect.options[siswaSelect.selectedIndex].text;
            const tgl = document.getElementById('tgl').value;
            const jamMulai = document.getElementById('jam_mulai').value;
            const jamSelesai = document.getElementById('jam_selesai').value;
            const status = $('input[name="status_kehadiran"]:checked').val();
            const kegiatan = document.getElementById('kegiatan').value.trim();
            const manfaat = document.getElementById('manfaat').value.trim();
            const fotoKegiatan = document.getElementById('foto_kegiatan').files.length;

            if (!siswaSelect.value || !tgl || !status) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Lengkap',
                    text: 'Mohon lengkapi semua field yang wajib diisi!',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if ((status === 'wfo' || status === 'wfh') && (!jamMulai || !jamSelesai || !kegiatan.trim() || !manfaat.trim())) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Lengkap',
                    text: 'Untuk status WFO/WFH, jam masuk, jam pulang, kegiatan, dan manfaat harus diisi!',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (status === 'izin' && !kegiatan.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Lengkap',
                    text: 'Untuk status Izin, keterangan alasan harus diisi!',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const statusLabel = {
                'wfo': 'WFO',
                'wfh': 'WFH',
                'sakit': 'Sakit',
                'izin': 'Izin',
                'libur': 'Libur'
            };

            const tglFormatted = new Date(tgl).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            const kegiatanShort = kegiatan.length > 50 ? kegiatan.substring(0, 50) + '...' : kegiatan;
            const manfaatShort = manfaat.length > 50 ? manfaat.substring(0, 50) + '...' : manfaat;

            let confirmHTML = `
                <div style="padding: 0.5rem 0;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-book" style="font-size: 1.75rem; color: #f59e0b;"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Simpan Jurnal</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menyimpan jurnal berikut?</p>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left; max-height: 300px; overflow-y: auto;">
                        <table style="width: 100%; font-size: 0.85rem;">
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Siswa:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${siswaText}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Tanggal:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${tglFormatted}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${statusLabel[status]}</td>
                            </tr>`;

            if (status === 'wfo' || status === 'wfh') {
                confirmHTML += `
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Waktu:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${jamMulai} - ${jamSelesai}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Kegiatan:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kegiatanShort}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Manfaat:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${manfaatShort}</td>
                            </tr>`;
                
                if (fotoKegiatan > 0) {
                    confirmHTML += `
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Foto:</td>
                                <td style="padding: 0.4rem 0; color: #10b981; font-weight: 700;"><i class="fas fa-check-circle"></i> Terlampir</td>
                            </tr>`;
                }
            }

            if (status === 'izin' && kegiatan) {
                confirmHTML += `
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Keterangan:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kegiatanShort}</td>
                            </tr>`;
            }

            confirmHTML += `
                        </table>
                    </div>
                    
                    <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                        <p style="font-size: 0.8rem; color: #92400e; margin: 0; font-weight: 600;">
                            <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                            Jurnal akan menunggu verifikasi dari pembimbing instansi
                        </p>
                    </div>
                </div>
            `;

            Swal.fire({
                html: confirmHTML,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-save" style="margin-right: 0.5rem;"></i>Ya, Simpan',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('jurnalForm').submit();
                }
            });
        });

        $(document).ready(function() {
            initializePhotoUpload();
            $('input[name="status_kehadiran"]').on('change', toggleFields);
            toggleFields();
        });

        @if($errors->any())
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        @endif
    </script>

</body>

</html>