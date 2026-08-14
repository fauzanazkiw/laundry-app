@extends('layouts.panel')

@php
    $title = 'Status Layanan: ' . $layanan->nama;
    $active = 'Layanan';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ url('panel/layanan') }}" class="btn btn-secondary btn-sm float-end mb-3">Kembali</a>
            <div class="white-box">
                <div class="box-title mb-3">Status Pengerjaan Layanan: {{ $layanan->nama }}</div>

                @php $firstNonDefaultId = $statusList->where('is_default', 0)->first()->id ?? null; @endphp
                @foreach ($statusList as $s)
                    <div class="d-flex align-items-center gap-2 border rounded p-2 mb-2">
                        <span class="badge bg-primary" style="min-width:32px;" title="Urutan otomatis">{{ $loop->iteration }}</span>

                        @if ($s->is_default)
                            <span class="flex-grow-1 fw-semibold">{{ $s->nama }}</span>
                            <span class="badge bg-secondary">Default, tidak bisa diubah/dihapus</span>
                        @else
                            <div class="btn-group btn-group-sm">
                                <form action="{{ url('panel/status-layanan-naik/' . $s->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary" title="Naikkan urutan"
                                        {{ $s->id === $firstNonDefaultId ? 'disabled' : '' }}><i class="fas fa-arrow-up"></i></button>
                                </form>
                                <form action="{{ url('panel/status-layanan-turun/' . $s->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary" title="Turunkan urutan"
                                        {{ $loop->last ? 'disabled' : '' }}><i class="fas fa-arrow-down"></i></button>
                                </form>
                            </div>
                            <form method="POST" action="{{ url('panel/status-layanan-update/' . $s->id) }}"
                                class="d-flex flex-grow-1 gap-2 align-items-center">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nama" class="form-control form-control-sm"
                                    value="{{ $s->nama }}">
                                <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-save"></i></button>
                            </form>
                            <form id="delete-form-{{ $s->id }}"
                                action="{{ url('panel/status-layanan-hapus/' . $s->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm text-white"
                                    onclick="confirmDelete({{ $s->id }})"><i class="fas fa-trash"></i></button>
                            </form>
                        @endif
                    </div>
                @endforeach

                <hr>

                <form method="POST" action="{{ url('panel/status-layanan-simpan/' . $layanan->id) }}" class="row g-2">
                    @csrf
                    <div class="col-md-8">
                        <input type="text" name="nama" class="form-control" placeholder="Nama status baru, mis. Proses Cuci"
                            required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-plus me-1"></i>Tambah
                            Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
