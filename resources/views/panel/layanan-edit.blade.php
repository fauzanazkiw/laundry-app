@extends('layouts.panel')

@php
    $title = 'Edit Layanan';
    $active = 'Layanan';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <div class="box-title mb-3">Form Edit Layanan</div>

                <form method="POST" action="{{ url('panel/layanan-update/' . $layanan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $layanan->nama }}"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" id="harga" min="0"
                                value="{{ $layanan->harga }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-select" name="satuan" id="satuan" required>
                                <option value="kg" @selected($layanan->satuan == 'kg')>Kg</option>
                                <option value="pcs" @selected($layanan->satuan == 'pcs')>Pcs</option>
                                <option value="set" @selected($layanan->satuan == 'set')>Set</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="estimasi_hari" class="form-label">Estimasi Selesai (hari)</label>
                            <input type="number" class="form-control" name="estimasi_hari" id="estimasi_hari"
                                min="0" value="{{ $layanan->estimasi_hari }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ $layanan->keterangan }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1"
                                @checked($layanan->aktif)>
                            <label class="form-check-label" for="aktif">Aktif</label>
                        </div>
                    </div>

                    <a href="{{ url('panel/layanan') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
