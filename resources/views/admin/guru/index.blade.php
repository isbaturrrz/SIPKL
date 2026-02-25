<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kelola Guru - Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('dist_admin/css/style.css')}}">
    <link href="{{ asset ('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">

    <style>
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

        .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark {
            display: block !important;
        }

        .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
            display: block !important;
            position: absolute !important;
            height: 3px !important;
            width: 30px !important;
            background-color: #ef4444 !important;
            border-radius: 2px !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark-line-left {
            top: 28px !important;
            left: 15px !important;
            transform: rotate(45deg) !important;
        }

        .swal2-icon.swal2-error .swal2-x-mark-line-right {
            top: 28px !important;
            right: 15px !important;
            transform: rotate(-45deg) !important;
        }

        .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }

        .swal2-icon.swal2-info {
            border-color: #3b82f6 !important;
            color: #3b82f6 !important;
        }

        .swal2-icon.swal2-success {
            border-color: #10b981 !important;
        }

        .swal2-icon.swal2-success [class^='swal2-success-line'] {
            background-color: #10b981 !important;
        }

        .swal2-icon.swal2-success .swal2-success-ring {
            border-color: rgba(16, 185, 129, 0.3) !important;
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
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;
            color: #fff !important;
            padding: 0.65rem 1.5rem !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3) !important;
            margin: 0 !important;
            flex: 1 !important;
            min-width: 0 !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4) !important;
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

        .swal2-confirm.swal2-confirm-single {
            background: linear-gradient(135deg, #1e4179 0%, #2c5aa0 100%) !important;
            box-shadow: 0 4px 12px rgba(30, 65, 121, 0.3) !important;
        }

        .swal2-confirm.swal2-confirm-single:hover {
            box-shadow: 0 6px 16px rgba(30, 65, 121, 0.4) !important;
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

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pengajuan-instansi.index') }}">
                    <i class="fas fa-inbox"></i>
                    <span>Pengajuan Instansi</span>
                </a> 
            </li>

            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
                        <a href="{{ route('admin.guru.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Guru
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
                            <h6 class="m-0 font-weight-bold text-primary">Cari Guru</h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.guru.index') }}">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <input type="text" name="search" class="form-control" 
                                               placeholder="Cari nama, email, no HP..." 
                                               value="{{ request('search') }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <select name="instansi" class="form-control">
                                            <option value="">-- Semua Status --</option>
                                            <option value="ada" {{ request('instansi') == 'ada' ? 'selected' : '' }}>Sudah Ditugaskan</option>
                                            <option value="kosong" {{ request('instansi') == 'kosong' ? 'selected' : '' }}>Belum Ditugaskan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-sync"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Lahir</th>
                                            <th>No HP</th>
                                            <th>Instansi</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($guru as $index => $item)
                                        <tr>
                                            <td>{{ $guru->firstItem() + $index }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tgl_lahir)->format('d-m-Y') }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>
                                                @if($item->instansi)
                                                    <span class="badge badge-success">{{ $item->instansi->nama_instansi }}</span>
                                                @else
                                                    <span class="badge badge-secondary">Belum Ditugaskan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.guru.show', $item->id_guru) }}" 
                                                   class="btn btn-info btn-sm"
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.guru.edit', $item->id_guru) }}" 
                                                   class="btn btn-warning btn-sm"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.guru.destroy', $item->id_guru) }}" 
                                                      method="POST" 
                                                      class="d-inline delete-form"
                                                      data-nama="{{ $item->nama }}"
                                                      data-email="{{ $item->email }}"
                                                      data-nohp="{{ $item->no_hp }}"
                                                      data-instansi="{{ $item->instansi ? $item->instansi->nama_instansi : 'Belum Ditugaskan' }}"
                                                      data-has-instansi="{{ $item->instansi ? 'true' : 'false' }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm btn-delete" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data guru</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Menampilkan {{ $guru->firstItem() ?? 0 }} - {{ $guru->lastItem() ?? 0 }} 
                                    dari {{ $guru->total() }} data
                                </div>
                                <div>
                                    {{ $guru->appends(request()->query())->links() }}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('.delete-form');
                const nama = form.getAttribute('data-nama');
                const email = form.getAttribute('data-email');
                const nohp = form.getAttribute('data-nohp');
                const instansi = form.getAttribute('data-instansi');
                const hasInstansi = form.getAttribute('data-has-instansi') === 'true';

                if (hasInstansi) {
                    const errorHTML = `
                        <div style="padding: 0.5rem 0;">
                            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-times-circle" style="font-size: 1.75rem; color: #dc2626;"></i>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Tidak Dapat Menghapus</h3>
                            <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Guru ini tidak dapat dihapus karena masih bertugas di instansi.</p>
                            
                            <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                                <table style="width: 100%; font-size: 0.85rem;">
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 35%;">Nama Guru:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nama}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Email:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${email}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Instansi:</td>
                                        <td style="padding: 0.4rem 0; color: #dc2626; font-weight: 700;">${instansi}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                                <p style="font-size: 0.8rem; color: #991b1b; margin: 0; font-weight: 600;">
                                    <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                                    Lepaskan guru dari instansi terlebih dahulu
                                </p>
                            </div>
                        </div>
                    `;

                    Swal.fire({
                        html: errorHTML,
                        showCancelButton: false,
                        confirmButtonText: '<i class="fas fa-check" style="margin-right: 0.5rem;"></i>Mengerti',
                        buttonsStyling: true,
                        customClass: {
                            confirm: 'swal2-confirm-single'
                        }
                    });
                } else {
                    const confirmHTML = `
                        <div style="padding: 0.5rem 0;">
                            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-chalkboard-teacher" style="font-size: 1.75rem; color: #dc2626;"></i>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Konfirmasi Hapus Guru</h3>
                            <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Apakah Anda yakin ingin menghapus data guru berikut?</p>
                            
                            <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; text-align: left;">
                                <table style="width: 100%; font-size: 0.85rem;">
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600; width: 30%;">Nama:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nama}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Email:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${email}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">No HP:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${nohp}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.4rem 0; color: #64748b; font-weight: 600;">Status:</td>
                                        <td style="padding: 0.4rem 0; color: #1a1a1a; font-weight: 700;">${instansi}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 0.65rem 1rem; border-radius: 8px; margin-top: 1rem;">
                                <p style="font-size: 0.8rem; color: #991b1b; margin: 0; font-weight: 600;">
                                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                    Data yang dihapus tidak dapat dikembalikan
                                </p>
                            </div>
                        </div>
                    `;

                    Swal.fire({
                        html: confirmHTML,
                        showCancelButton: true,
                        confirmButtonText: '<i class="fas fa-trash-alt" style="margin-right: 0.5rem;"></i>Ya, Hapus',
                        cancelButtonText: '<i class="fas fa-times" style="margin-right: 0.5rem;"></i>Batal',
                        reverseButtons: true,
                        buttonsStyling: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>