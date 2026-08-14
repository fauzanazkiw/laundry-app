@php
    $urutanList = $transaksi->stepStatus->pluck('id')->values();
    $posisi = $urutanList->search($transaksi->status_layanan_id);
    $posisi = $posisi === false ? 0 : $posisi;
    $totalSteps = $transaksi->stepStatus->count();
    $isComplete = $posisi >= $totalSteps - 1;

    // waktu tiap status diambil dari log (latest per status)
    $logPerStatus = collect($transaksi->logs ?? [])
        ->sortByDesc('created_at')
        ->unique('status_layanan_id')
        ->keyBy('status_layanan_id');
@endphp

<div class="bg-white shadow-sm rounded p-4 mt-4 wow fadeInUp" data-wow-delay="0.1s"
    style="border: 1px solid #f1d4d6; border-top: 4px solid var(--primary);">
    {{-- Info transaksi --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h5 class="mb-1 fw-bold" style="color: var(--secondary);">{{ $transaksi->nama_pelanggan }}</h5>
            <span class="badge rounded-pill" style="background: var(--primary);">{{ $transaksi->status->nama ?? '-' }}</span>
        </div>
        <div class="text-end">
            <small class="d-block text-muted">{{ $transaksi->kode_invoice }}</small>
            <small class="d-block text-muted">{{ $transaksi->nama_layanan }} &middot; {{ $transaksi->qty }} {{ $transaksi->satuan }}</small>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="row bg-light rounded p-3 mb-3 mx-0">
        <div class="col-6 col-md-3 mb-2 mb-md-0">
            <small class="d-block text-muted">Berat</small>
            <strong>{{ $transaksi->qty }} {{ $transaksi->satuan }}</strong>
        </div>
        <div class="col-6 col-md-3 mb-2 mb-md-0">
            <small class="d-block text-muted">Tanggal Masuk</small>
            <strong>{{ $transaksi->tanggal_masuk?->format('d M Y') ?? '-' }}</strong>
        </div>
        <div class="col-6 col-md-3">
            <small class="d-block text-muted">Estimasi Selesai</small>
            <strong>{{ $transaksi->estimasi_selesai?->format('d M Y') ?? '-' }}</strong>
        </div>
        <div class="col-6 col-md-3">
            <small class="d-block text-muted">Total</small>
            <strong style="color: var(--primary);">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong>
        </div>
    </div>

    <hr class="my-3">

    {{-- Timeline Shopee-style --}}
    <div class="tracking-timeline">
        @foreach ($transaksi->stepStatus as $i => $step)
            @php
                $done = $i <= $posisi;
                $isCurrent = $i === $posisi;
                $log = $logPerStatus->get($step->id);
            @endphp
            <div class="timeline-item {{ $done ? 'done' : '' }} {{ $isCurrent ? 'current' : '' }}">
                <div class="timeline-dot">
                    @if ($done)
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-spinner"></i>
                    @endif
                </div>
                <div class="timeline-content">
                    <div class="timeline-label">
                        {{ $step->nama }}
                        @if ($isCurrent)
                            <span class="badge rounded-pill ms-2" style="background: var(--primary);">Sekarang</span>
                        @endif
                    </div>
                    @if ($log)
                        <div class="timeline-time">{{ $log->created_at?->format('d M Y, H:i') }}</div>
                    @endif
                    @if ($log?->catatan)
                        <div class="timeline-note">{{ $log->catatan }}</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Status message --}}
    <div class="bg-light rounded p-3 mt-4" style="border-left: 4px solid var(--primary);">
        @if ($isComplete)
            <i class="fas fa-check-circle me-1 text-success"></i> Laundry Anda sudah selesai dan siap diambil.
        @else
            <i class="fas fa-clock me-1" style="color: var(--primary);"></i> Laundry masih dalam proses, silakan cek kembali nanti.
        @endif
    </div>
</div>

<style>
    .tracking-timeline {
        position: relative;
    }

    .tracking-timeline::before {
        content: '';
        position: absolute;
        left: 14px;
        top: 10px;
        bottom: 10px;
        width: 3px;
        background: #e9ecef;
    }

    .timeline-item {
        position: relative;
        padding: 0 0 30px 45px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item.done::before {
        content: '';
        position: absolute;
        left: 14px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--primary);
    }

    .timeline-dot {
        position: absolute;
        left: 2px;
        top: 0;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        z-index: 1;
    }

    .timeline-item.done .timeline-dot {
        background: var(--primary);
        color: #fff;
    }

    .timeline-item.current .timeline-dot {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 0 0 6px rgba(216, 19, 36, .2);
        animation: pulse 2s infinite;
    }

    .timeline-item:not(.done) .timeline-dot {
        background: #fff;
        border: 2px solid #ccc;
        color: #ccc;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(216, 19, 36, .4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(216, 19, 36, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(216, 19, 36, 0);
        }
    }

    .timeline-label {
        font-weight: 600;
        color: var(--secondary);
    }

    .timeline-item:not(.done) .timeline-label {
        color: #adb5bd;
        font-weight: 400;
    }

    .timeline-time {
        font-size: 0.8rem;
        color: #999;
        margin-top: 2px;
    }

    .timeline-item:not(.done) .timeline-time {
        color: #ced4da;
    }

    .timeline-note {
        font-size: 0.85rem;
        color: #666;
        background: #f8f9fa;
        border-radius: 4px;
        padding: 6px 10px;
        margin-top: 6px;
        display: inline-block;
    }
</style>
