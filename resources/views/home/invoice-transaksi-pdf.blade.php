<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nota {{ $transaksi->kode_invoice }}</title>
    <style>
        @page {
            margin: 18px;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #222;
        }

        /* Header */
        .header {
            border-bottom: 3px solid #D81324;
            padding-bottom: 12px;
            margin-bottom: 18px;
            position: relative;
        }

        .header .brand {
            font-size: 22px;
            font-weight: 800;
            color: #0B2154;
            letter-spacing: .5px;
        }

        .header .brand i {
            color: #D81324;
        }

        .header .contact {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
            line-height: 1.6;
        }

        .badge-invoice {
            position: absolute;
            top: 0;
            right: 0;
            background: #0B2154;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 6px 12px;
            border-radius: 3px;
        }

        /* Judul nota */
        .nota-title {
            text-align: center;
            color: #D81324;
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 15px;
        }

        /* Info box */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            background: #f8f9fa;
            border: 1px solid #e3e3e3;
            border-radius: 6px;
            overflow: hidden;
        }

        .info-table td {
            padding: 8px 12px;
            vertical-align: top;
        }

        .info-table .label {
            font-size: 9px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .info-table .value {
            font-size: 12px;
            font-weight: 600;
            color: #222;
            margin-top: 2px;
        }

        .info-table .col {
            border-right: 1px solid #e3e3e3;
        }

        /* Tabel item */
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        .item-table thead th {
            background: #0B2154;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 9px 10px;
            text-align: left;
        }

        .item-table thead th:first-child {
            border-radius: 5px 0 0 0;
        }

        .item-table thead th:last-child {
            border-radius: 0 5px 0 0;
            text-align: right;
        }

        .item-table tbody td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 11.5px;
        }

        .item-table tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .item-table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .item-table tbody tr:last-child td {
            border-bottom: none;
        }

        .item-table .item-name {
            font-weight: 700;
            color: #0B2154;
        }

        .item-table .item-note {
            font-size: 10px;
            color: #999;
            margin-top: 2px;
        }

        /* Total */
        .total-box {
            margin-top: 15px;
            width: 100%;
            border-collapse: collapse;
        }

        .total-box td {
            padding: 6px 12px;
            font-size: 12px;
        }

        .total-box .grand-total {
            background: #D81324;
            color: #fff;
            font-size: 15px;
            font-weight: 800;
            border-radius: 5px;
        }

        .total-box .grand-total td {
            padding: 11px 12px;
        }

        /* Footer info */
        .footer-info {
            margin-top: 18px;
            padding: 10px 12px;
            background: #f8f9fa;
            border-left: 4px solid #D81324;
            font-size: 11px;
            color: #555;
            line-height: 1.7;
        }

        .footer-info strong {
            color: #0B2154;
        }

        /* Tanda tangan */
        .sign-area {
            margin-top: 45px;
            width: 100%;
            border-collapse: collapse;
        }

        .sign-area td {
            width: 50%;
            text-align: center;
            font-size: 11px;
            color: #555;
            vertical-align: bottom;
        }

        .sign-area         .sign-name {
            margin-top: 55px;
            font-weight: 700;
            color: #222;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <div class="brand">{{ $setting->nama_web ?? 'LaundryApp' }}</div>
        <div class="contact">
            {{ $setting->alamat ?? '-' }}<br>
            WhatsApp: {{ $setting->no_wa ?? '-' }} &nbsp;|&nbsp; {{ $setting->email ?? '-' }}
        </div>
        <div class="badge-invoice">{{ $transaksi->kode_invoice }}</div>
    </div>

    <div class="nota-title">Nota Laundry</div>

    {{-- Info transaksi --}}
    <table class="info-table">
        <tr>
            <td class="col" width="25%">
                <div class="label">Pelanggan</div>
                <div class="value">{{ $transaksi->nama_pelanggan }}</div>
            </td>
            <td class="col" width="25%">
                <div class="label">No. WhatsApp</div>
                <div class="value">{{ $transaksi->no_hp }}</div>
            </td>
            <td class="col" width="25%">
                <div class="label">Tanggal Masuk</div>
                <div class="value">{{ $transaksi->tanggal_masuk?->format('d M Y, H:i') }}</div>
            </td>
            <td width="25%">
                <div class="label">Estimasi Selesai</div>
                <div class="value">{{ $transaksi->estimasi_selesai?->format('d M Y') ?? '-' }}</div>
            </td>
        </tr>
    </table>

    {{-- Tabel item --}}
    <table class="item-table">
        <thead>
            <tr>
                <th>Layanan</th>
                <th width="15%">Jumlah</th>
                <th width="20%">Harga Satuan</th>
                <th width="20%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="item-name">{{ $transaksi->nama_layanan }}</div>
                    @if ($transaksi->catatan)
                        <div class="item-note">{{ $transaksi->catatan }}</div>
                    @endif
                </td>
                <td>{{ $transaksi->qty }} {{ $transaksi->satuan }}</td>
                <td>Rp {{ number_format($transaksi->harga_satuan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Total --}}
    <table class="total-box">
        <tr>
            <td style="text-align: right;">Total Tagihan</td>
        </tr>
        <tr class="grand-total">
            <td style="text-align: right;">
                Rp {{ number_format($transaksi->total, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    {{-- Status / footer info --}}
    <div class="footer-info">
        <strong>Status:</strong> {{ $transaksi->status->nama ?? '-' }}<br>
        <strong>Catatan:</strong> {{ $transaksi->catatan ?: 'Tidak ada catatan' }}<br>
        <strong>Petugas:</strong> {{ $transaksi->createdBy->name ?? '-' }}
    </div>

    {{-- Tanda tangan --}}
    <table class="sign-area">
        <tr>
            <td>
                Pelanggan
                <div class="sign-name">{{ $transaksi->nama_pelanggan }}</div>
            </td>
            <td>
                Petugas Laundry
                <div class="sign-name">{{ $transaksi->createdBy->name ?? '-' }}</div>
            </td>
        </tr>
    </table>
</body>

</html>
