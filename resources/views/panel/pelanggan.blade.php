@extends('layouts.panel')

@php
    $title = 'Manajemen Pelanggan';
    $active = 'Pelanggan';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary btn-sm float-end mb-3" data-bs-toggle="modal"
                data-bs-target="#modalTambahPelanggan">+ Buat Akun Pelanggan</button>
            <div class="white-box">
                <div class="box-title mb-3">Data Pelanggan</div>

                <table class="table w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No WA</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{!! no_hp_html($p->no_wa) !!}</td>
                                <td>
                                    <a href="{{ url('panel/pelanggan-edit/' . $p->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form id="delete-form-{{ $p->id }}"
                                        action="{{ url('panel/pelanggan-hapus/' . $p->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm text-white"
                                            onclick="confirmDelete({{ $p->id }})"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pelanggan -->
    <div class="modal fade" id="modalTambahPelanggan" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('panel/pelanggan-simpan') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Buat Akun Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email (dipakai untuk login)</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">No WhatsApp</label>
                            <input type="text" class="form-control" name="no_wa" id="no_wa" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
