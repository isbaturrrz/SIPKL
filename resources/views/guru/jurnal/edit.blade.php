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
            background-color: #e8eef7;
            min-height: 100vh;
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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Jurnal Siswa</h1>
                        <a href="{{ route('guru.jurnal.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
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
                        <div class="card-header py-3 bg-primary">
                            <h6 class="m-0 font-weight-bold text-white">
                                <i class="fas fa-pencil-alt"></i> Form Edit Jurnal Siswa
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle"></i> <strong>Informasi:</strong> Perubahan data jurnal akan diperbarui sesuai dengan yang Anda input.
                            </div>

                            <form method="POST" action="{{ route('guru.jurnal.update', $jurnal->id_jurnal) }}" id="jurnalForm">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_siswa">Pilih Siswa <span class="text-danger">*</span></label>
                                            <select name="id_siswa" id="id_siswa" class="form-control @error('id_siswa') is-invalid @enderror" required>
                                                <option value="">-- Pilih Siswa --</option>
                                                @foreach($siswaList as $siswa)
                                                <option value="{{ $siswa->id_siswa }}" 
                                                    {{ old('id_siswa', $jurnal->id_siswa) == $siswa->id_siswa ? 'selected' : '' }}
                                                    data-instansi="{{ $siswa->instansi->nama ?? '-' }}">
                                                    {{ $siswa->nama }} - {{ $siswa->kelas_lengkap }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('id_siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Pilih siswa yang akan diupdate jurnalnya</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl">Tanggal <span class="text-danger">*</span></label>
                                            <input type="date" 
                                                   name="tgl" 
                                                   id="tgl" 
                                                   class="form-control @error('tgl') is-invalid @enderror" 
                                                   value="{{ old('tgl', $jurnal->tgl?->format('Y-m-d')) }}" 
                                                   max="{{ date('Y-m-d') }}"
                                                   required>
                                            @error('tgl')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Pilih tanggal jurnal</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jam_mulai">Jam Mulai <span class="text-danger">*</span></label>
                                            <input type="time" 
                                                   name="jam_mulai" 
                                                   id="jam_mulai" 
                                                   class="form-control @error('jam_mulai') is-invalid @enderror" 
                                                   value="{{ old('jam_mulai', $jurnal->jam_mulai) }}" 
                                                   required>
                                            @error('jam_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jam_selesai">Jam Selesai <span class="text-danger">*</span></label>
                                            <input type="time" 
                                                   name="jam_selesai" 
                                                   id="jam_selesai" 
                                                   class="form-control @error('jam_selesai') is-invalid @enderror" 
                                                   value="{{ old('jam_selesai', $jurnal->jam_selesai) }}" 
                                                   required>
                                            @error('jam_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kehadiran">Status Kehadiran <span class="text-danger">*</span></label>
                                            <select name="status_kehadiran" 
                                                    id="status_kehadiran" 
                                                    class="form-control @error('status_kehadiran') is-invalid @enderror" 
                                                    required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="wfo" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'wfo' ? 'selected' : '' }}>WFO</option>
                                                <option value="wfh" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'wfh' ? 'selected' : '' }}>WFH</option>
                                                <option value="izin" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'izin' ? 'selected' : '' }}>Izin</option>
                                                <option value="sakit" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                <option value="libur" {{ old('status_kehadiran', $jurnal->status_kehadiran) == 'libur' ? 'selected' : '' }}>Libur</option>
                                            </select>
                                            @error('status_kehadiran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="kegiatan">Kegiatan yang Dilakukan <span class="text-danger">*</span></label>
                                    <textarea name="kegiatan" 
                                              id="kegiatan" 
                                              rows="6" 
                                              class="form-control @error('kegiatan') is-invalid @enderror" 
                                              placeholder="Tuliskan kegiatan yang dilakukan siswa pada hari tersebut..."
                                              required>{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
                                    @error('kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="fas fa-lightbulb"></i> Contoh: Mempelajari cara membuat database, mengikuti meeting dengan tim, membantu membuat desain UI, dll.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="manfaat">Manfaat yang Didapat <span class="text-danger">*</span></label>
                                    <textarea name="manfaat" 
                                              id="manfaat" 
                                              rows="6" 
                                              class="form-control @error('manfaat') is-invalid @enderror" 
                                              placeholder="Tuliskan manfaat atau pembelajaran yang didapat siswa dari kegiatan tersebut..."
                                              required>{{ old('manfaat', $jurnal->manfaat) }}</textarea>
                                    @error('manfaat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="fas fa-lightbulb"></i> Contoh: Memahami konsep relational database, belajar komunikasi dalam tim, meningkatkan skill desain, dll.
                                    </small>
                                </div>

                                <hr>

                                <div class="form-group mb-0">
                                    <button type="button" id="btnUpdate" class="btn btn-primary">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('jam_selesai').addEventListener('change', function() {
            var jamMulai = document.getElementById('jam_mulai').value;
            var jamSelesai = this.value;
            
            if (jamMulai && jamSelesai) {
                if (jamSelesai <= jamMulai) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Waktu Tidak Valid',
                        text: 'Jam selesai harus lebih besar dari jam mulai!',
                        confirmButtonText: 'OK'
                    });
                    this.value = '';
                }
            }
        });

        document.getElementById('btnUpdate').addEventListener('click', function(e) {
            e.preventDefault();
            
            const siswaSelect = document.getElementById('id_siswa');
            const siswaText = siswaSelect.options[siswaSelect.selectedIndex].text;
            const tgl = document.getElementById('tgl').value;
            const jamMulai = document.getElementById('jam_mulai').value;
            const jamSelesai = document.getElementById('jam_selesai').value;
            const statusSelect = document.getElementById('status_kehadiran');
            const statusText = statusSelect.options[statusSelect.selectedIndex].text;
            const kegiatan = document.getElementById('kegiatan').value;
            const manfaat = document.getElementById('manfaat').value;

            if (!siswaSelect.value || !tgl || !jamMulai || !jamSelesai || !statusSelect.value || !kegiatan.trim() || !manfaat.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Lengkap',
                    text: 'Mohon lengkapi semua field yang bertanda *',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const tglFormatted = new Date(tgl).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            const kegiatanShort = kegiatan.length > 50 ? kegiatan.substring(0, 50) + '...' : kegiatan;
            const manfaatShort = manfaat.length > 50 ? manfaat.substring(0, 50) + '...' : manfaat;

            const confirmHTML = `
                <div style="padding: 0.5rem 0;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-book" style="font-size: 1.75rem; color: #f59e0b;"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Update Jurnal</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin mengupdate jurnal berikut?</p>
                    
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
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Waktu:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${jamMulai} - ${jamSelesai}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${statusText}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Kegiatan:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kegiatanShort}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Manfaat:</td>
                                <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${manfaatShort}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                        <p style="font-size: 0.8rem; color: #92400e; margin: 0; font-weight: 600;">
                            <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                            Data jurnal akan diperbarui
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
                    document.getElementById('jurnalForm').submit();
                }
            });
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