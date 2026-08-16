@extends('layouts.home')

@section('title', $setting->nama_web ?? 'Hallo Clean')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="position-relative" style="height: 70vh; min-height: 420px;">
            <img class="w-100 h-100" src="{{ asset('foto/bg.png') }}" style="object-fit: cover;" alt="Image">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: linear-gradient(rgba(11, 33, 84, .75), rgba(11, 33, 84, .55));">
                <div class="container">
                    <div class="row justify-content-center justify-content-lg-start">
                        <div class="col-11 col-lg-8 text-center text-lg-start wow fadeInUp" data-wow-delay="0.1s">
                            <h6 class="text-uppercase mb-3 animated slideInDown"
                                style="color: #fca5a5; font-weight: 700; letter-spacing: 2px;">// Jasa Cuci & Setrika //
                            </h6>
                            <h1 class="display-4 text-white mb-3 animated slideInDown" style="font-weight: 800;">Laundry
                                Bersih, Cepat, dan Terpercaya</h1>
                            <p class="text-white mb-4 animated slideInDown" style="font-size: 1.1rem; line-height: 1.8;">
                                Kami hadir memberikan layanan laundry berkualitas dengan proses cepat, bersih, dan harga
                                terjangkau. Kepuasan pelanggan adalah prioritas utama kami.</p>
                            <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-lg-start">
                                @auth
                                    <a href="#cek-status" class="btn btn-primary py-3 px-4">
                                        <i class="fas fa-search-location me-2"></i>Cek Status Laundry
                                    </a>
                                @else
                                    <a href="{{ url('login') }}" class="btn btn-primary py-3 px-4">
                                        <i class="fas fa-sign-in-alt me-2"></i>Masuk untuk Cek Status
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Cek Status Start -->
    @auth
        @if (auth()->user()->role === 'Pelanggan')
            <div class="container-xxl py-5" id="cek-status">
                <div class="container">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h6 class="text-primary text-uppercase">// Tracking //</h6>
                        <h1 class="mb-4">Cek Status Laundry Anda</h1>
                    </div>

                    <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="col-lg-6">
                            <div class="bg-white shadow-sm rounded p-4"
                                style="border: 1px solid #f1d4d6; border-top: 4px solid var(--primary);">
                                <form action="{{ url('lacak') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="kode" value="{{ old('kode', $kode ?? '') }}"
                                            class="form-control form-control-lg"
                                            placeholder="Masukkan kode transaksi yang Anda terima saat mengantar laundry"
                                            required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary py-3 px-5">
                                            <i class="fas fa-search-location me-2"></i>Cek Sekarang
                                        </button>
                                    </div>
                                    @error('kode')
                                        <small class="text-danger d-block text-center mt-2">{{ $message }}</small>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </div>

                    @if (isset($transaksi))
                        @include('home._tracking-result', ['transaksi' => $transaksi])
                    @elseif (session('error'))
                        <div class="text-center mt-4 wow fadeInUp" data-wow-delay="0.1s">
                            <span class="text-danger"><i
                                    class="fas fa-exclamation-circle me-1"></i>{{ session('error') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endauth
    <!-- Cek Status End -->

    <!-- Layanan Start -->
    <div class="container-xxl py-5 bg-light">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Layanan Kami //</h6>
                <h1 class="mb-5">Pilihan Layanan Laundry</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse ($layanan as $l)
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="bg-white shadow-sm rounded h-100 p-4 text-center service-card">
                            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                                style="width: 70px; height: 70px; background: rgba(216, 19, 36, .1);">
                                <i class="fas fa-tshirt fa-2x" style="color: var(--primary);"></i>
                            </div>
                            <h5 class="mb-1">{{ $l->nama }}</h5>
                            <p class="mb-2" style="color: var(--primary); font-weight: 700;">Rp
                                {{ number_format($l->harga, 0, ',', '.') }}/{{ $l->satuan }}</p>
                            <span class="badge rounded-pill" style="background: #0B2154;">Estimasi selesai cepat</span>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Belum ada data layanan.</div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Layanan End -->
@endsection
