<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ $title ?? 'LaundryApp Panel' }}</title>

    <!-- Custom CSS -->
    <link href="{{ asset('admin-assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <!-- ============================================================== -->
        <!-- Topbar header -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="{{ url('panel') }}">
                        <b class="logo-icon">
                            <span class="fw-bold fs-4" style="color:#000">LaundryApp</span>
                        </b>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none mt-2"
                        href="javascript:void(0)"><i class="fas fa-bars fs-6"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li>
                            <a class="profile-pic" type="button">
                                <img class="img-circle"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                    alt="user" width="40px" height="40px">
                                <span class="text-white font-medium">{{ auth()->user()->name }}</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Left Sidebar -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('panel') }}"
                                aria-expanded="false">
                                <i class="fas fa-home me-3" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('panel/pelanggan*') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('panel/pelanggan*') ? 'active' : '' }}"
                                href="{{ url('panel/pelanggan') }}" aria-expanded="false">
                                <i class="fas fa-users me-3" aria-hidden="true"></i>
                                <span class="hide-menu">Manajemen Pelanggan</span>
                            </a>
                        </li>
                        @if (auth()->user()->role === 'Karyawan')
                            <li class="sidebar-item {{ Request::is('panel/transaksi*') ? 'selected' : '' }}">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('panel/transaksi*') ? 'active' : '' }}"
                                    href="{{ url('panel/transaksi') }}" aria-expanded="false">
                                    <i class="fas fa-receipt me-3" aria-hidden="true"></i>
                                    <span class="hide-menu">Transaksi</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'Pemilik')
                            <li class="sidebar-item {{ Request::is('panel/layanan*') ? 'selected' : '' }}">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('panel/layanan*') ? 'active' : '' }}"
                                    href="{{ url('panel/layanan') }}" aria-expanded="false">
                                    <i class="fas fa-tshirt me-3" aria-hidden="true"></i>
                                    <span class="hide-menu">Manajemen Layanan</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Request::is('panel/laporan-keuangan*') ? 'selected' : '' }}">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('panel/laporan-keuangan*') ? 'active' : '' }}"
                                    href="{{ url('panel/laporan-keuangan') }}" aria-expanded="false">
                                    <i class="fas fa-file-invoice-dollar me-3" aria-hidden="true"></i>
                                    <span class="hide-menu">Laporan Keuangan</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item {{ Request::is('panel/profile*') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('panel/profile*') ? 'active' : '' }}"
                                href="{{ url('panel/profile') }}" aria-expanded="false">
                                <i class="fas fa-user me-3" aria-hidden="true"></i>
                                <span class="hide-menu">Akun</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="sidebar-nav sidebar-nav-bottom">
                        <li class="sidebar-item bg-danger">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link text-white"
                                href="{{ url('logout') }}">
                                <i class="fas fa-lock-open me-3 text-white"></i>
                                <span class="hide-menu">Keluar</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Page wrapper -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="d-lg-none"><br></div>

            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-primary">{{ $title ?? 'Dashboard' }}</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal">{{ $active ?? '' }}</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                <!-- Konten -->
                @yield('content')

            </div>

            <footer class="footer text-center">LaundryApp Panel</footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <script src="{{ asset('admin-assets/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin-assets/js/custom.js') }}"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // inisialisasi otomatis semua tabel DataTable (datatable, datatable1, datatable2, ...)
            $('[id^="datatable"]').each(function() {
                if (!$.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable({
                        responsive: true,
                        autoWidth: false,
                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                        }
                    });
                }
            });
        });
    </script>

    <script>
        // no HP di seluruh halaman Panel: tombol salin (copy ke clipboard + toast) terpisah dari tombol wa.me
        $(document).on('click', '.no-hp-copy', function() {
            let nomor = $(this).data('phone');
            if (!nomor) return;

            if (navigator.clipboard) {
                navigator.clipboard.writeText(String(nomor));
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
            Toast.fire({
                icon: 'success',
                title: 'Nomor disalin: ' + nomor
            });
        });
    </script>

    <style>
        #sidebarnav {
            padding-bottom: 60px;
        }

        .sidebar-nav-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .no-hp-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .no-hp-copy {
            cursor: pointer;
            color: #6c757d;
        }

        .no-hp-copy:hover {
            color: #0d6efd;
        }

        .no-hp-wa {
            color: #25d366;
        }

        .no-hp-wa:hover {
            color: #1da851;
        }
    </style>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data ini akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>



    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errorMessages = `
            <ul style="text-align:left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `;
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                html: errorMessages,
                confirmButtonColor: '#f0ad4e',
                confirmButtonText: 'Perbaiki'
            });
        </script>
    @endif
    @yield('scripts')

</body>

</html>
