@extends('layouts.panel')

@php
    $title = 'Dashboard';
    $active = 'Dashboard';
@endphp

@section('content')
    <h1 class="mb-4">Selamat datang, {{ auth()->user()->name }}</h1>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Layanan</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <i class="fas fa-tshirt text-primary fa-2x"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-primary">{{ $totalLayanan }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Pelanggan</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <i class="fas fa-users text-primary fa-2x"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-primary">{{ $totalPelanggan }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Transaksi</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <i class="fas fa-receipt text-primary fa-2x"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-primary">{{ $totalTransaksi }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Omzet Bulan Ini</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <i class="fas fa-money-bill-wave text-primary fa-2x"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-primary">Rp
                            {{ number_format($totalOmzetBulanIni, 0, ',', '.') }}</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="white-box">
                <div class="box-title mb-3">Transaksi Terbaru</div>
                <div class="table-responsive">
                    <table class="table w-100" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Invoice</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksiTerbaru as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $t->kode_invoice }}</td>
                                    <td>{{ $t->nama_pelanggan }}</td>
                                    <td>{{ $t->nama_layanan }}</td>
                                    <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-info">{{ $t->status->nama ?? '-' }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
