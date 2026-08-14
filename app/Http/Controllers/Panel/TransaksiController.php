<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\LayananModel;
use App\Models\StatusLayananModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiStatusLogModel;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $data['transaksi'] = TransaksiModel::with('status')->orderBy('id', 'DESC')->get();
        $data['layanan'] = LayananModel::where('aktif', 1)->orderBy('nama')->get();
        $data['pelanggan'] = User::where('role', 'Pelanggan')->orderBy('name')->get();

        return view('panel.transaksi', $data);
    }

    public function transaksisimpan(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'layanan_id' => 'required|exists:layanan,id',
            'qty' => 'required|numeric|min:0.1',
            'catatan' => 'nullable',
        ]);

        $layanan = LayananModel::findOrFail($request->layanan_id);
        $statusAwal = StatusLayananModel::where('layanan_id', $layanan->id)->where('is_default', 1)->first();

        $transaksi = TransaksiModel::create([
            'kode_invoice' => $this->generateInvoice(),
            'user_id' => $request->user_id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'layanan_id' => $layanan->id,
            'nama_layanan' => $layanan->nama,
            'harga_satuan' => $layanan->harga,
            'satuan' => $layanan->satuan,
            'qty' => $request->qty,
            'total' => $layanan->harga * $request->qty,
            'status_layanan_id' => $statusAwal->id ?? null,
            'tanggal_masuk' => now(),
            'estimasi_selesai' => $layanan->estimasi_hari ? now()->addDays($layanan->estimasi_hari) : null,
            'catatan' => $request->catatan,
            'created_by' => auth()->id(),
        ]);

        TransaksiStatusLogModel::create([
            'transaksi_id' => $transaksi->id,
            'status_layanan_id' => $statusAwal->id ?? null,
            'nama_status' => $statusAwal->nama ?? 'Diterima',
            'created_by' => auth()->id(),
        ]);

        return redirect('panel/transaksi-detail/' . $transaksi->id)->with('success', 'Transaksi berhasil disimpan');
    }

    public function transaksidetail($id)
    {
        $data['transaksi'] = TransaksiModel::with('logs')->findOrFail($id);
        $data['statusList'] = StatusLayananModel::where('layanan_id', $data['transaksi']->layanan_id)->orderBy('urutan')->get();

        return view('panel.transaksi-detail', $data);
    }

    public function transaksistatus(Request $request, $id)
    {
        $request->validate([
            'status_layanan_id' => 'required|exists:status_layanan,id',
            'catatan' => 'nullable',
        ]);

        $transaksi = TransaksiModel::findOrFail($id);
        $status = StatusLayananModel::where('layanan_id', $transaksi->layanan_id)->findOrFail($request->status_layanan_id);

        $transaksi->update(['status_layanan_id' => $status->id]);

        TransaksiStatusLogModel::create([
            'transaksi_id' => $transaksi->id,
            'status_layanan_id' => $status->id,
            'nama_status' => $status->nama,
            'catatan' => $request->catatan,
            'created_by' => auth()->id(),
        ]);

        return redirect('panel/transaksi-detail/' . $id)->with('success', 'Status berhasil diupdate menjadi "' . $status->nama . '"');
    }

    public function transaksihapus($id)
    {
        $transaksi = TransaksiModel::findOrFail($id);
        TransaksiStatusLogModel::where('transaksi_id', $transaksi->id)->delete();
        $transaksi->delete();

        return redirect('panel/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }

    // cetak nota laundry ke PDF
    public function transaksicetak($id)
    {
        $transaksi = TransaksiModel::with(['status', 'createdBy'])->findOrFail($id);
        $setting = app_setting();

        $pdf = Pdf::loadView('home.invoice-transaksi-pdf', compact('transaksi', 'setting'));

        return $pdf->stream('Nota-' . $transaksi->kode_invoice . '.pdf');
    }

    private function generateInvoice()
    {
        do {
            $kode = 'INV' . strtoupper(uniqid());
        } while (TransaksiModel::where('kode_invoice', $kode)->exists());

        return $kode;
    }
}
