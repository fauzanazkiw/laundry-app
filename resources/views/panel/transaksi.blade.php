@extends('layouts.panel')

@php
    $title = 'Transaksi';
    $active = 'Transaksi';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary btn-sm float-end mb-3" data-bs-toggle="modal"
                data-bs-target="#modalTambahTransaksi">+ Transaksi Baru</button>
            <div class="white-box">
                <div class="box-title mb-3">Data Transaksi</div>

                <table class="table w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Invoice</th>
                            <th>Pelanggan</th>
                            <th>No HP</th>
                            <th>Layanan</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->kode_invoice }}</td>
                                <td>{{ $t->nama_pelanggan }}</td>
                                <td>{!! no_hp_html($t->no_hp) !!}</td>
                                <td>{{ $t->nama_layanan }}</td>
                                <td>{{ $t->qty }} {{ $t->satuan }}</td>
                                <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                                <td><span class="badge bg-info">{{ $t->status->nama ?? '-' }}</span></td>
                                <td>
                                    <a href="{{ url('panel/transaksi-detail/' . $t->id) }}" class="btn btn-primary btn-sm"
                                        title="Detail & Update Status"><i class="fas fa-eye"></i></a>
                                    <a href="{{ url('panel/transaksi-cetak/' . $t->id) }}" target="_blank"
                                        class="btn btn-secondary btn-sm" title="Cetak Nota"><i class="fas fa-print"></i></a>
                                    <form id="delete-form-{{ $t->id }}"
                                        action="{{ url('panel/transaksi-hapus/' . $t->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm text-white"
                                            onclick="confirmDelete({{ $t->id }})"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Transaksi Baru -->
    <div class="modal fade" id="modalTambahTransaksi" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ url('panel/transaksi-simpan') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Transaksi Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Akun Pelanggan (opsional)</label>
                            <select class="form-select select2-modal" name="user_id" id="user_id">
                                <option value="">Pelanggan tanpa akun / walk-in</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}" data-nama="{{ $p->name }}" data-wa="{{ $p->no_wa }}">
                                        {{ $p->name }} ({{ $p->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No WhatsApp</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="layanan_id" class="form-label">Layanan</label>
                                <select class="form-select" name="layanan_id" id="layanan_id" required>
                                    <option value="">Pilih Layanan</option>
                                    @foreach ($layanan as $l)
                                        <option value="{{ $l->id }}">{{ $l->nama }} - Rp
                                            {{ number_format($l->harga, 0, ',', '.') }}/{{ $l->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qty" class="form-label">Qty (berat/jumlah)</label>
                                <input type="number" step="0.1" min="0.1" class="form-control" name="qty" id="qty"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" rows="2"></textarea>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // select2 di dalam modal butuh dropdownParent supaya dropdown ikut tampil di atas modal
            $('.select2-modal').select2({
                width: '100%',
                dropdownParent: $('#modalTambahTransaksi')
            });

            $('#user_id').on('change', function() {
                let opt = $(this).find('option:selected');
                if (opt.val()) {
                    $('#nama_pelanggan').val(opt.data('nama'));
                    $('#no_hp').val(opt.data('wa'));
                }
            });
        });
    </script>
@endsection
