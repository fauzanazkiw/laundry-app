@extends('layouts.home')

@section('title', 'Cek Status Laundry - ' . ($setting->nama_web ?? 'Hallo Clean'))

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url({{ asset('foto/bg.png') }});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Cek Status Laundry</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Cek Status</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cek Status Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-muted mb-4">Masukkan kode transaksi yang diberikan oleh petugas laundry kami.</p>

                    <form action="{{ url('cek-status') }}" method="GET">
                        <div class="input-group input-group-lg mb-4">
                            <input type="text" name="kode" value="{{ request('kode', '') }}" class="form-control"
                                placeholder="Contoh: TRX-001" style="border: 1px solid #ccc; border-radius: 4px 0 0 4px;">
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 0 4px 4px 0;">
                                Cek Status
                            </button>
                        </div>
                    </form>

                    @if (isset($transaksi))
                        @include('home._tracking-result', ['transaksi' => $transaksi])
                    @elseif (request('kode'))
                        <div class="text-danger mt-3">
                            <i class="fas fa-exclamation-circle me-1"></i>Kode transaksi tidak ditemukan. Periksa kembali
                            kode Anda.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Cek Status End -->
@endsection
