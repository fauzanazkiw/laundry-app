@extends('layouts.panel')

@php
    $title = 'Laporan Keuangan';
    $active = 'Laporan Keuangan';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <div class="box-title mb-3">Filter Rentang Tanggal</div>
                <form method="GET" action="{{ url('panel/laporan-keuangan') }}" class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" name="dari" value="{{ $dari }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" name="sampai" value="{{ $sampai }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ url('panel/laporan-keuangan-download?dari=' . $dari . '&sampai=' . $sampai) }}"
                            target="_blank" class="btn btn-success">
                            <i class="fas fa-file-pdf me-1"></i>Download PDF
                        </a>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Transaksi</h3>
                        <span class="counter text-primary fs-3">{{ $totalTransaksi }}</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Omzet</h3>
                        <span class="counter text-primary fs-3">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="white-box">
                <div class="box-title mb-3">Rekap per Layanan</div>
                <table id="datatable1" class="table table-sm">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekapLayanan as $r)
                            <tr>
                                <td>{{ $r['nama'] }}</td>
                                <td>{{ $r['jumlah'] }}</td>
                                <td>Rp {{ number_format($r['total'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="white-box">
                <div class="box-title mb-3">Detail Transaksi</div>
                <table id="datatable2" class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode Invoice</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $t->tanggal_masuk?->format('d M Y') }}</td>
                                <td>{{ $t->kode_invoice }}</td>
                                <td>{{ $t->nama_pelanggan }}</td>
                                <td>{{ $t->nama_layanan }}</td>
                                <td>{{ $t->status->nama ?? '-' }}</td>
                                <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
