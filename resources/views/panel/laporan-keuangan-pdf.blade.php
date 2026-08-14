<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 5px 8px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .total-row td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>{{ $setting->nama_web ?? 'LaundryApp' }}</h2>
        <div>Laporan Keuangan periode {{ \Carbon\Carbon::parse($dari)->format('d M Y') }} s/d
            {{ \Carbon\Carbon::parse($sampai)->format('d M Y') }}</div>
    </div>

    <p><strong>Total Transaksi:</strong> {{ $totalTransaksi }} &nbsp; | &nbsp;
        <strong>Total Omzet:</strong> Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>

    <table>
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Jumlah Transaksi</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapLayanan as $r)
                <tr>
                    <td>{{ $r['nama'] }}</td>
                    <td>{{ $r['jumlah'] }}</td>
                    <td>Rp {{ number_format($r['total'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode Invoice</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $t)
                <tr>
                    <td>{{ $t->tanggal_masuk?->format('d M Y') }}</td>
                    <td>{{ $t->kode_invoice }}</td>
                    <td>{{ $t->nama_pelanggan }}</td>
                    <td>{{ $t->nama_layanan }}</td>
                    <td>{{ $t->status->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5">Total Omzet</td>
                <td>Rp {{ number_format($totalOmzet, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
