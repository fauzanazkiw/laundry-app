<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile()
    {
        $data['user'] = auth()->user();

        return view('panel.profile', $data);
    }

    public function profileupdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'no_wa' => 'nullable',
            'password' => 'nullable|min:6|confirmed',
            'foto' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(public_path('storage/foto/' . $user->foto))) {
                unlink(public_path('storage/foto/' . $user->foto));
            }
            $file = $request->file('foto');
            $namaFile = $file->hashName();
            $file->storeAs('foto', $namaFile, 'public');
            $data['foto'] = $namaFile;
        }

        $user->update($data);

        return redirect('panel/profile')->with('success', 'Profile berhasil diupdate');
    }
}
