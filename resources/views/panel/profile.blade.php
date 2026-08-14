@extends('layouts.panel')

@php
    $title = 'Profile';
    $active = 'Akun';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <div class="box-title mb-3">Form Profile</div>

                <form method="POST" action="{{ url('panel/profile-update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WhatsApp</label>
                        <input type="number" class="form-control" name="no_wa" id="no_wa"
                            value="{{ $user->no_wa }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Kosongkan jika tidak diganti">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation">
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        @if ($user->foto)
                            <br><img src="{{ asset('storage/foto/' . $user->foto) }}" alt="foto" class="mb-2"
                                width="100">
                        @endif
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>

                    <a href="{{ url('panel') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
