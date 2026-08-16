<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', $setting->nama_web ?? 'Hallo Clean')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend') }}/css/style.css" rel="stylesheet">

    <style>
        /* reCAPTCHA: widget tetap terpusat & rapi, aman di layar sempit */
        .recaptcha-wrap {
            display: flex;
            justify-content: center;
            overflow-x: auto;
            padding: 4px 0;
        }

        .service-card {
            border: 1px solid #f1d4d6;
            border-bottom: 3px solid var(--primary);
            transition: .3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(216, 19, 36, .15) !important;
            border-bottom-color: var(--secondary);
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fas fa-map-marker-alt text-primary me-2"></small>
                    <small>{{ $setting->alamat ?? '-' }}</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="fas fa-envelope text-primary me-2"></small>
                    <small>{{ $setting->email ?? '-' }}</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fab fa-whatsapp text-primary me-2"></small>
                    <small>{{ $setting->no_wa ?? '-' }}</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            @if (!empty($setting->logo))
                <img src="{{ asset('storage/logo/' . $setting->logo) }}" alt="" style="max-height: 45px;"
                    class="me-2">
            @else
                <h2 class="m-0 text-primary"><i class="fas fa-tshirt me-3"></i>{{ $setting->nama_web ?? 'LaundryApp' }}
                </h2>
            @endif
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}"
                    class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ url('cek-status') }}"
                    class="nav-item nav-link {{ request()->is('cek-status*') ? 'active' : '' }}">Cek Status</a>
                @auth
                    @if (auth()->user()->role === 'Pelanggan')
                        <a href="{{ url('logout') }}" class="nav-item nav-link d-lg-none">
                            <i class="fas fa-sign-out-alt me-2"></i>Keluar
                        </a>
                    @else
                        <a href="{{ url('panel') }}" class="nav-item nav-link d-lg-none">
                            <i class="fas fa-th-large me-2"></i>Panel
                        </a>
                    @endif
                @else
                    <a href="{{ url('login') }}" class="nav-item nav-link d-lg-none">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </a>
                @endauth
            </div>
            @auth
                @if (auth()->user()->role === 'Pelanggan')
                    <a href="{{ url('logout') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                    </a>
                @else
                    <a href="{{ url('panel') }}" class="btn btn-outline-primary py-3 px-lg-4 d-none d-lg-block me-2">
                        <i class="fas fa-th-large me-2"></i>Panel
                    </a>
                @endif
            @else
                <a href="{{ url('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </a>
            @endauth
        </div>
    </nav>
    <!-- Navbar End -->


    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Alamat</h4>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-3"></i>{{ $setting->alamat ?? '-' }}</p>
                    <p class="mb-2"><i class="fab fa-whatsapp me-3"></i>{{ $setting->no_wa ?? '-' }}</p>
                    <p class="mb-2"><i class="fas fa-envelope me-3"></i>{{ $setting->email ?? '-' }}</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Menu</h4>
                    <a class="btn btn-link" href="{{ url('/') }}">Home</a>
                    <a class="btn btn-link" href="{{ url('cek-status') }}">Cek Status</a>
                    <a class="btn btn-link" href="{{ url('login') }}">Masuk</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Layanan</h4>
                    @forelse ($layanan ?? [] as $l)
                        <span class="d-block mb-2">{{ $l->nama }}</span>
                    @empty
                        <span class="d-block mb-2">Cuci & Setrika</span>
                        <span class="d-block mb-2">Cuci Kilat</span>
                        <span class="d-block mb-2">Cuci Karpet</span>
                        <span class="d-block mb-2">Cuci Sepatu</span>
                    @endforelse
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Tentang Kami</h4>
                    <p>{{ Str::limit(strip_tags($setting->tentang ?? ''), 150, '...') ?: 'Jasa laundry terpercaya untuk kebutuhan cuci Anda.' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-12 text-center">
                        &copy; {{ date('Y') }} <a class="border-bottom"
                            href="{{ url('/') }}">{{ $setting->nama_web ?? 'LaundryApp' }}</a>. All
                        Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fas fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend') }}/js/main.js"></script>

    @yield('scripts')
</body>

</html>
