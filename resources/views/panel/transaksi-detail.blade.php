@extends('layouts.panel')

@php
    $title = 'Detail Transaksi';
    $active = 'Transaksi';
    $setting = app_setting();
    $pesanWa = "Halo *{$transaksi->nama_pelanggan}*,\n\n"
        . "Terima kasih sudah menggunakan layanan {$setting->nama_web}.\n\n"
        . "----------------------------\n"
        . "INFO LAUNDRY ANDA\n"
        . "----------------------------\n"
        . "Kode Invoice: {$transaksi->kode_invoice}\n"
        . "Layanan: {$transaksi->nama_layanan} ({$transaksi->qty} {$transaksi->satuan})\n"
        . "Total: Rp " . number_format($transaksi->total, 0, ',', '.') . "\n"
        . "Tanggal Masuk: " . ($transaksi->tanggal_masuk?->format('d M Y') ?? '-') . "\n"
        . "Estimasi Selesai: " . ($transaksi->estimasi_selesai?->format('d M Y') ?? '-') . "\n"
        . "----------------------------\n"
        . "Status Terbaru: *" . ($transaksi->status->nama ?? '-') . "*\n"
        . "----------------------------\n\n"
        . "Silakan cek kembali nanti untuk update status berikutnya.\n"
        . "Terima kasih.";
    $waLink = 'https://wa.me/' . format_nomor_wa($transaksi->no_hp) . '?text=' . rawurlencode($pesanWa);
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="white-box">
                <div class="box-title mb-3">{{ $transaksi->kode_invoice }}</div>
                <table class="table table-sm">
                    <tr>
                        <th style="width:180px;">Pelanggan</th>
                        <td>{{ $transaksi->nama_pelanggan }}</td>
                    </tr>
                    <tr>
                        <th>No WhatsApp</th>
                        <td>{!! no_hp_html($transaksi->no_hp) !!}</td>
                    </tr>
                    <tr>
                        <th>Layanan</th>
                        <td>{{ $transaksi->nama_layanan }}</td>
                    </tr>
                    <tr>
                        <th>Qty</th>
                        <td>{{ $transaksi->qty }} {{ $transaksi->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ $transaksi->tanggal_masuk?->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Estimasi Selesai</th>
                        <td>{{ $transaksi->estimasi_selesai?->format('d M Y') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $transaksi->catatan ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Saat Ini</th>
                        <td><span class="badge bg-primary">{{ $transaksi->status->nama ?? '-' }}</span></td>
                    </tr>
                </table>

                <a href="{{ url('panel/transaksi-cetak/' . $transaksi->id) }}" target="_blank" class="btn btn-secondary">
                    <i class="fas fa-print me-1"></i>Cetak Nota
                </a>
                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-success text-white">
                    <i class="fab fa-whatsapp me-1"></i>Kirim Notif WA
                </a>
            </div>

            <div class="white-box">
                <div class="box-title mb-3">Update Status</div>
                <form method="POST" action="{{ url('panel/transaksi-status/' . $transaksi->id) }}" class="row g-2">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <select class="form-select" name="status_layanan_id" required>
                            @foreach ($statusList as $s)
                                <option value="{{ $s->id }}" @selected($transaksi->status_layanan_id == $s->id)>
                                    {{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="catatan" placeholder="Catatan (opsional)">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="white-box">
                <div class="box-title mb-3">Riwayat Status</div>
                <ul class="list-unstyled">
                    @foreach ($transaksi->logs as $log)
                        <li class="mb-3 pb-3 border-bottom">
                            <strong>{{ $log->nama_status }}</strong>
                            <div class="text-muted small">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}</div>
                            @if ($log->catatan)
                                <div class="small">{{ $log->catatan }}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
