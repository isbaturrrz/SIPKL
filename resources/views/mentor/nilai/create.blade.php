<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Input Nilai - Mentor</title>
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

        .table-nilai th {
            vertical-align: middle;
            text-align: center;
            background-color: #f8f9fc;
        }

        .box-summary {
            border: 1px solid #e3e6f0;
            margin-bottom: 20px;
        }

        .box-summary .label {
            background-color: #f8f9fc;
            font-weight: bold;
            padding: 10px;
            border-bottom: 1px solid #e3e6f0;
        }

        .box-summary .value {
            padding: 15px;
            font-size: 1.5rem;
            font-weight: bold;
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
                        <h1 class="h3 mb-0 text-gray-800">Input Nilai Siswa</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="100">Nama</td>
                                            <td class="font-weight-bold">: {{ $siswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td class="font-weight-bold">: {{ $siswa->kelas_lengkap }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="nilaiForm" action="{{ route('mentor.nilai.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penilaian</h6>
                            </div>
                            <div class="card-body">
                                <div class="row no-gutters text-center box-summary">
                                    <div class="col-6 border-right">
                                        <div class="label text-dark">NILAI AKHIR</div>
                                        <div class="value text-primary" id="display-rata-rata">0.00</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="label text-dark">HURUF / PREDIKAT</div>
                                        <div class="value text-primary" id="display-huruf">-</div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-nilai">
                                        <thead>
                                            <tr>
                                                <th width="50">No</th>
                                                <th>ASPEK YANG DINILAI</th>
                                                <th width="200">NILAI (0-100)</th>
                                                <th width="150">PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>Kedisiplinan</td>
                                                <td><input type="number" name="nilai_kedisiplinan" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>Kretifitas</td>
                                                <td><input type="number" name="nilai_kreatifitas" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>Tanggung Jawab</td>
                                                <td><input type="number" name="nilai_tanggung_jawab" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>Kerjasama</td>
                                                <td><input type="number" name="nilai_kerjasama" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td>Komunikasi</td>
                                                <td><input type="number" name="nilai_komunikasi" class="form-control input-score" min="0" max="100" required></td>
                                                <td class="text-center font-weight-bold row-predikat">-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-light font-weight-bold text-center">
                                                <td colspan="2">RATA-RATA</td>
                                                <td id="total-score">0</td>
                                                <td>-</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold text-dark">Keterangan Tambahan</label>
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Sangat baik dalam bekerja tim..."></textarea>
                                </div>

                                <div class="mt-4 text-right">
                                    <a href="{{ route('mentor.nilai.index') }}" class="btn-action btn-secondary-custom">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="button" id="btnSimpan" class="btn-action btn-save-custom">
                                        <i class="fas fa-save"></i> Simpan Nilai
                                    </button>
                                </div>
                            </div>
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

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('.input-score').on('input', function () {
                let total = 0;
                let count = 0;

                $('.input-score').each(function () {
                    let val = parseFloat($(this).val()) || 0;
                    if (val > 100) { $(this).val(100); val = 100; }

                    total += val;
                    count++;

                    let p = getPredikat(val);
                    $(this).closest('tr').find('.row-predikat').text(val > 0 ? p : '-');
                });

                let rataRata = total / count;
                $('#total-score').text(rataRata.toFixed(2));
                $('#display-rata-rata').text(rataRata.toFixed(2));
                $('#display-huruf').text(rataRata > 0 ? getPredikat(rataRata) : '-');
            });

            function getPredikat(n) {
                if (n >= 90) return 'A';
                if (n >= 80) return 'B';
                if (n >= 70) return 'C';
                if (n >= 60) return 'D';
                return 'E';
            }

            document.getElementById('btnSimpan').addEventListener('click', function (e) {
                e.preventDefault();

                const form = document.getElementById('nilaiForm');
                const inputs = form.querySelectorAll('.input-score');
                let allFilled = true;

                inputs.forEach(function (input) {
                    if (input.value === '' || input.value === null) {
                        allFilled = false;
                    }
                });

                if (!allFilled) {
                    Swal.fire({
                        html: `
                            <div style="padding: 0.5rem 0;">
                                <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                    <i class="fas fa-exclamation-circle" style="font-size: 1.75rem; color: #dc2626;"></i>
                                </div>
                                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Data Belum Lengkap</h3>
                                <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Harap isi semua nilai aspek penilaian sebelum menyimpan.</p>
                            </div>
                        `,
                        showCancelButton: false,
                        confirmButtonText: '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Oke',
                        buttonsStyling: true
                    });
                    return;
                }

                const namaSiswa = "{{ $siswa->nama }}";
                const kelasSiswa = "{{ $siswa->kelas_lengkap }}";
                const nilaiAkhir = $('#display-rata-rata').text();
                const predikat = $('#display-huruf').text();

                Swal.fire({
                    html: `
                        <div style="padding: 0.5rem 0;">
                            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-save" style="font-size: 1.75rem; color: #10b981;"></i>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Simpan Nilai Siswa</h3>
                            <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menyimpan nilai berikut?</p>

                            <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                                <table style="width: 100%; font-size: 0.85rem;">
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 40%;">Nama Siswa:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${namaSiswa}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Kelas:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${kelasSiswa}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Nilai Akhir:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nilaiAkhir}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Predikat:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${predikat}</td>
                                    </tr>
                                </table>
                            </div>

                            <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                                <p style="font-size: 0.8rem; color: #065f46; margin: 0; font-weight: 600;">
                                    <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                                    Nilai yang disimpan akan tercatat sebagai nilai akhir siswa
                                </p>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-save" style="margin-right: 0.5rem;"></i>Simpan',
                    cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                    reverseButtons: true,
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('nilaiForm').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>