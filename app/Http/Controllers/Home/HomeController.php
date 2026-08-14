<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\LayananModel;
use App\Models\StatusLayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['layanan'] = LayananModel::where('aktif', 1)->orderBy('nama')->get();
        $data['totalLayanan'] = $data['layanan']->count();

        return view('home.home', $data);
    }

    public function lacak(Request $request)
    {
        $data['layanan'] = LayananModel::where('aktif', 1)->orderBy('nama')->get();
        $data['totalLayanan'] = $data['layanan']->count();

        $request->validate(['kode' => 'required'], ['kode.required' => 'Masukkan kode transaksi terlebih dahulu.']);
        $data['kode'] = $request->input('kode');

        $transaksi = TransaksiModel::with(['status', 'logs'])
            ->where('kode_invoice', $request->input('kode'))
            ->first();

        if ($transaksi) {
            $transaksi->stepStatus = StatusLayananModel::where('layanan_id', $transaksi->layanan_id)->orderBy('urutan')->get();
            $data['transaksi'] = $transaksi;
        } else {
            session()->flash('error', 'Kode transaksi tidak ditemukan. Periksa kembali kode invoice Anda.');
        }

        return view('home.home', $data);
    }

    public function cekStatus(Request $request)
    {
        $data['layanan'] = LayananModel::where('aktif', 1)->orderBy('nama')->get();

        $kode = trim($request->query('kode', ''));
        if ($kode !== '') {
            $transaksi = TransaksiModel::with(['status', 'logs'])
                ->where('kode_invoice', $kode)
                ->first();

            if ($transaksi) {
                $transaksi->stepStatus = StatusLayananModel::where('layanan_id', $transaksi->layanan_id)->orderBy('urutan')->get();
                $data['transaksi'] = $transaksi;
            }
        }

        return view('home.cek-status', $data);
    }
}
