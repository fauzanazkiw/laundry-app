<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\LayananModel;
use App\Models\StatusLayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function layanan()
    {
        $data['layanan'] = LayananModel::orderBy('nama')->get();

        return view('panel.layanan', $data);
    }

    public function layanansimpan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required',
            'estimasi_hari' => 'nullable|integer|min:0',
            'keterangan' => 'nullable',
        ]);

        $layanan = LayananModel::create($request->only(['nama', 'harga', 'satuan', 'estimasi_hari', 'keterangan']) + ['aktif' => 1]);

        // status default "Diterima" wajib ada di setiap layanan & tidak bisa dihapus
        StatusLayananModel::create([
            'layanan_id' => $layanan->id,
            'nama' => 'Diterima',
            'urutan' => 0,
            'is_default' => 1,
        ]);

        return redirect('panel/layanan')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function layananedit($id)
    {
        $data['layanan'] = LayananModel::findOrFail($id);

        return view('panel.layanan-edit', $data);
    }

    public function layananupdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required',
            'estimasi_hari' => 'nullable|integer|min:0',
            'keterangan' => 'nullable',
        ]);

        $layanan = LayananModel::findOrFail($id);
        $layanan->update($request->only(['nama', 'harga', 'satuan', 'estimasi_hari', 'keterangan']) + ['aktif' => $request->boolean('aktif')]);

        return redirect('panel/layanan')->with('success', 'Layanan berhasil diupdate');
    }

    public function layananhapus($id)
    {
        if (TransaksiModel::where('layanan_id', $id)->exists()) {
            return redirect('panel/layanan')->with('error', 'Layanan tidak bisa dihapus karena masih ada transaksi yang memakainya');
        }

        StatusLayananModel::where('layanan_id', $id)->delete();
        LayananModel::findOrFail($id)->delete();

        return redirect('panel/layanan')->with('success', 'Layanan berhasil dihapus');
    }
}
