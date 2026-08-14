@extends('layouts.panel')

@php
    $title = 'Edit Pelanggan';
    $active = 'Pelanggan';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <div class="box-title mb-3">Form Edit Pelanggan</div>

                <form method="POST" action="{{ url('panel/pelanggan-update/' . $pelanggan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $pelanggan->name }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email (dipakai untuk login)</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ $pelanggan->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WhatsApp</label>
                        <input type="text" class="form-control" name="no_wa" id="no_wa"
                            value="{{ $pelanggan->no_wa }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <a href="{{ url('panel/pelanggan') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
