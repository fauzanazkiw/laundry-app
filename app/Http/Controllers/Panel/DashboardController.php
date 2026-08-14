<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['totalLayanan'] = LayananModel::count();
        $data['totalPelanggan'] = User::where('role', 'Pelanggan')->count();
        $data['totalTransaksi'] = TransaksiModel::count();
        $data['totalOmzetBulanIni'] = TransaksiModel::whereMonth('tanggal_masuk', now()->month)
            ->whereYear('tanggal_masuk', now()->year)
            ->sum('total');

        $data['transaksiTerbaru'] = TransaksiModel::with('status')->orderBy('id', 'DESC')->limit(20)->get();

        return view('panel.dashboard', $data);
    }
}
