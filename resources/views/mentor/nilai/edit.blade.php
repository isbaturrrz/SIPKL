<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Nilai - Mentor</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist_mentor/css/style.css')}}">
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
            text-decoration: none;
            margin-right: 8px;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .btn-save-custom {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-save-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
            color: #fff;
        }

        .btn-secondary-custom {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary-custom:hover {
            background: #475569;
            color: #fff;
            text-decoration: none;
            transform: translateY(-2px);
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
            padding: 0 1.5rem 0 1.5rem !important;
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4) !important;
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
            .btn-action {
                width: 100%;
                justify-content: center;
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
                padding: 0 1rem 0 1rem !important;
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('mentor.dashboard') }}">
                <div class="sidebar-brand-icon main-logo">
                    <img src="{{asset('dist_mentor/img/logo.png')}}" alt="IPKL">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Daftar Siswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.jurnal.index') }}">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Verifikasi Jurnal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('mentor.riwayat.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Jurnal</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('mentor.nilai.index') }}">
                    <i class="fas fa-star"></i>
                    <span>Nilai Siswa</span>
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Nilai Siswa</h1>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops! Ada kesalahan:</strong>
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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Nilai Siswa: {{ $siswa->nama }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('mentor.nilai.store') }}" method="POST" id="nilaiForm">
                                @csrf
                                <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">

                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Kreativitas <span class="text-danger">*</span></label>
                                            <input type="number" name="nilai_kreatifitas" id="nilai_kreatifitas" class="form-control" value="{{ $siswa->penilaian->nilai_kreatifitas }}" min="0" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Kedisiplinan <span class="text-danger">*</span></label>
                                            <input type="number" name="nilai_kedisiplinan" id="nilai_kedisiplinan" class="form-control" value="{{ $siswa->penilaian->nilai_kedisiplinan }}" min="0" max="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Tanggung Jawab <span class="text-danger">*</span></label>
                                            <input type="number" name="nilai_tanggung_jawab" id="nilai_tanggung_jawab" class="form-control" value="{{ $siswa->penilaian->nilai_tanggung_jawab }}" min="0" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Kerjasama <span class="text-danger">*</span></label>
                                            <input type="number" name="nilai_kerjasama" id="nilai_kerjasama" class="form-control" value="{{ $siswa->penilaian->nilai_kerjasama }}" min="0" max="100" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nilai Komunikasi <span class="text-danger">*</span></label>
                                            <input type="number" name="nilai_komunikasi" id="nilai_komunikasi" class="form-control" value="{{ $siswa->penilaian->nilai_komunikasi }}" min="0" max="100" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold text-dark">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $siswa->penilaian->keterangan }}</textarea>
                                </div>

                                <div class="text-right mt-4">
                                    <a href="{{ route('mentor.nilai.index') }}" class="btn-action btn-secondary-custom">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="button" id="btnUpdate" class="btn-action btn-save-custom">
                                        <i class="fas fa-save"></i> Update Nilai
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

    <script>
        document.getElementById('btnUpdate').addEventListener('click', function (e) {
            e.preventDefault();

            const namaSiswa = "{{ $siswa->nama }}";
            const nilaiKreatifitas = document.getElementById('nilai_kreatifitas').value;
            const nilaiKedisiplinan = document.getElementById('nilai_kedisiplinan').value;
            const nilaiTanggungJawab = document.getElementById('nilai_tanggung_jawab').value;
            const nilaiKerjasama = document.getElementById('nilai_kerjasama').value;
            const nilaiKomunikasi = document.getElementById('nilai_komunikasi').value;
            const keterangan = document.getElementById('keterangan').value;

            if (!nilaiKreatifitas || !nilaiKedisiplinan || !nilaiTanggungJawab || !nilaiKerjasama || !nilaiKomunikasi) {
                Swal.fire({
                    html: `
                        <div style="padding: 0.5rem 0;">
                            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-exclamation-circle" style="font-size: 1.75rem; color: #dc2626;"></i>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Data Belum Lengkap</h3>
                            <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Harap isi semua nilai yang bertanda <strong>*</strong> sebelum menyimpan.</p>
                        </div>
                    `,
                    showCancelButton: false,
                    confirmButtonText: '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Oke',
                    buttonsStyling: true
                });
                return;
            }

            const rataRata = ((parseFloat(nilaiKreatifitas) + parseFloat(nilaiKedisiplinan) + parseFloat(nilaiTanggungJawab) + parseFloat(nilaiKerjasama) + parseFloat(nilaiKomunikasi)) / 5).toFixed(2);
            const keteranganShort = keterangan ? (keterangan.length > 50 ? keterangan.substring(0, 50) + '...' : keterangan) : '-';

            Swal.fire({
                html: `
                    <div style="padding: 0.5rem 0;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-save" style="font-size: 1.75rem; color: #10b981;"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Update Nilai</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin mengupdate nilai berikut?</p>

                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                            <table style="width: 100%; font-size: 0.85rem;">
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 50%;">Nama Siswa:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${namaSiswa}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nilai Kreativitas:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nilaiKreatifitas}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nilai Kedisiplinan:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nilaiKedisiplinan}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nilai Tanggung Jawab:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nilaiTanggungJawab}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nilai Kerjasama:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nilaiKerjasama}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nilai Komunikasi:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nilaiKomunikasi}</td>
                                </tr>
                                <tr style="border-top: 2px solid #e2e8f0;">
                                    <td style="padding: 0.6rem 0 0.4rem; color: #059669; font-weight: 700;">Rata-rata:</td>
                                    <td style="padding: 0.6rem 0 0.4rem; color: #059669; font-weight: 700; font-size: 0.95rem;">${rataRata}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Keterangan:</td>
                                    <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${keteranganShort}</td>
                                </tr>
                            </table>
                        </div>

                        <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                            <p style="font-size: 0.8rem; color: #065f46; margin: 0; font-weight: 600;">
                                <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                                Nilai siswa akan diperbarui
                            </p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-save" style="margin-right: 0.5rem;"></i>Ya, Update',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                reverseButtons: true,
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('nilaiForm').submit();
                }
            });
        });

        document.querySelectorAll('input[type="number"]').forEach(function (input) {
            input.addEventListener('input', function () {
                if (this.value > 100) this.value = 100;
                if (this.value < 0) this.value = 0;
            });
        });
    </script>
</body>
</html>