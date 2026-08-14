@extends('layouts.panel')

@php
    $title = 'Manajemen Layanan';
    $active = 'Layanan';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary btn-sm float-end mb-3" data-bs-toggle="modal"
                data-bs-target="#modalTambahLayanan">+ Tambah Layanan</button>
            <div class="white-box">
                <div class="box-title mb-3">Data Layanan</div>

                <table class="table w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Estimasi Hari</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $l)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $l->nama }}</td>
                                <td>Rp {{ number_format($l->harga, 0, ',', '.') }}/{{ $l->satuan }}</td>
                                <td>{{ $l->estimasi_hari ?? '-' }}</td>
                                <td>
                                    @if ($l->aktif)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('panel/layanan/' . $l->id . '/status') }}"
                                        class="btn btn-info btn-sm text-white" title="Kelola Status"><i
                                            class="fas fa-list-check"></i></a>
                                    <a href="{{ url('panel/layanan-edit/' . $l->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form id="delete-form-{{ $l->id }}"
                                        action="{{ url('panel/layanan-hapus/' . $l->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm text-white"
                                            onclick="confirmDelete({{ $l->id }})"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Layanan -->
    <div class="modal fade" id="modalTambahLayanan" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ url('panel/layanan-simpan') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Layanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Layanan</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga" min="0" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" name="satuan" id="satuan" required>
                                    <option value="kg">Kg</option>
                                    <option value="pcs">Pcs</option>
                                    <option value="set">Set</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="estimasi_hari" class="form-label">Estimasi Selesai (hari)</label>
                                <input type="number" class="form-control" name="estimasi_hari" id="estimasi_hari"
                                    min="0">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                        </div>

                        <div class="alert alert-info mb-0">
                            Status "Diterima" akan otomatis dibuat sebagai status awal (default) untuk layanan ini.
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
