<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporan(Request $request)
    {
        $data = $this->rekap($request);

        return view('panel.laporan-keuangan', $data);
    }

    public function laporandownload(Request $request)
    {
        $data = $this->rekap($request);
        $data['setting'] = app_setting();

        $pdf = Pdf::loadView('panel.laporan-keuangan-pdf', $data);

        return $pdf->stream('Laporan-Keuangan-' . $data['dari'] . '_' . $data['sampai'] . '.pdf');
    }

    // rekap transaksi & omzet per rentang tanggal, dipakai halaman & PDF
    private function rekap(Request $request)
    {
        $dari = $request->dari ?: now()->startOfMonth()->format('Y-m-d');
        $sampai = $request->sampai ?: now()->format('Y-m-d');

        $transaksi = TransaksiModel::with('status')
            ->whereDate('tanggal_masuk', '>=', $dari)
            ->whereDate('tanggal_masuk', '<=', $sampai)
            ->orderBy('tanggal_masuk')
            ->get();

        $rekapLayanan = $transaksi->groupBy('nama_layanan')->map(function ($items, $nama) {
            return [
                'nama' => $nama,
                'jumlah' => $items->count(),
                'total' => $items->sum('total'),
            ];
        })->values();

        return [
            'dari' => $dari,
            'sampai' => $sampai,
            'transaksi' => $transaksi,
            'rekapLayanan' => $rekapLayanan,
            'totalOmzet' => $transaksi->sum('total'),
            'totalTransaksi' => $transaksi->count(),
        ];
    }
}
