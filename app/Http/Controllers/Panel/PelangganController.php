<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    public function pelanggan()
    {
        $data['pelanggan'] = User::where('role', 'Pelanggan')->orderBy('name')->get();

        return view('panel.pelanggan', $data);
    }

    public function pelanggansimpan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_wa' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'password' => Hash::make($request->password),
            'role' => 'Pelanggan',
        ]);

        return redirect('panel/pelanggan')->with('success', 'Akun pelanggan berhasil dibuat');
    }

    public function pelangganedit($id)
    {
        $data['pelanggan'] = User::where('role', 'Pelanggan')->findOrFail($id);

        return view('panel.pelanggan-edit', $data);
    }

    public function pelangganupdate(Request $request, $id)
    {
        $pelanggan = User::where('role', 'Pelanggan')->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($pelanggan->id)],
            'no_wa' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only(['name', 'email', 'no_wa']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pelanggan->update($data);

        return redirect('panel/pelanggan')->with('success', 'Data pelanggan berhasil diupdate');
    }

    public function pelangganhapus($id)
    {
        User::where('role', 'Pelanggan')->findOrFail($id)->delete();

        return redirect('panel/pelanggan')->with('success', 'Data pelanggan berhasil dihapus');
    }
}
