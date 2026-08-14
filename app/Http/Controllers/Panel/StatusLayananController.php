<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\LayananModel;
use App\Models\StatusLayananModel;
use Illuminate\Http\Request;

class StatusLayananController extends Controller
{
    public function status($layanan_id)
    {
        $data['layanan'] = LayananModel::findOrFail($layanan_id);
        $data['statusList'] = StatusLayananModel::where('layanan_id', $layanan_id)->orderBy('urutan')->get();

        return view('panel.status-layanan', $data);
    }

    public function simpan(Request $request, $layanan_id)
    {
        $request->validate(['nama' => 'required']);

        // urutan otomatis: selalu ditambahkan di posisi paling akhir
        $urutanTerakhir = StatusLayananModel::where('layanan_id', $layanan_id)->max('urutan');

        StatusLayananModel::create([
            'layanan_id' => $layanan_id,
            'nama' => $request->nama,
            'urutan' => $urutanTerakhir + 1,
        ]);

        return redirect('panel/layanan/' . $layanan_id . '/status')->with('success', 'Status berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama' => 'required']);

        $status = StatusLayananModel::findOrFail($id);

        // status default "Diterima" namanya tidak boleh diubah; urutan tidak pernah diisi manual di sini
        if ($status->is_default) {
            return redirect('panel/layanan/' . $status->layanan_id . '/status')->with('error', 'Status default "Diterima" tidak bisa diubah namanya');
        }

        $status->update(['nama' => $request->nama]);

        return redirect('panel/layanan/' . $status->layanan_id . '/status')->with('success', 'Status berhasil diupdate');
    }

    // geser urutan status naik/turun (tukar urutan dgn status tetangga terdekat, di luar status default)
    public function pindah($id, $arah)
    {
        $status = StatusLayananModel::findOrFail($id);

        if ($status->is_default) {
            return redirect('panel/layanan/' . $status->layanan_id . '/status')->with('error', 'Status default "Diterima" selalu berada di posisi paling awal');
        }

        $tetangga = StatusLayananModel::where('layanan_id', $status->layanan_id)
            ->where('is_default', 0)
            ->where('urutan', $arah === 'naik' ? '<' : '>', $status->urutan)
            ->orderBy('urutan', $arah === 'naik' ? 'desc' : 'asc')
            ->first();

        if ($tetangga) {
            [$urutanStatus, $urutanTetangga] = [$status->urutan, $tetangga->urutan];
            $status->update(['urutan' => $urutanTetangga]);
            $tetangga->update(['urutan' => $urutanStatus]);
        }

        return redirect('panel/layanan/' . $status->layanan_id . '/status');
    }

    public function hapus($id)
    {
        $status = StatusLayananModel::findOrFail($id);

        if ($status->is_default) {
            return redirect('panel/layanan/' . $status->layanan_id . '/status')->with('error', 'Status default "Diterima" tidak bisa dihapus');
        }

        $layananId = $status->layanan_id;
        $status->delete();

        return redirect('panel/layanan/' . $layananId . '/status')->with('success', 'Status berhasil dihapus');
    }
}
