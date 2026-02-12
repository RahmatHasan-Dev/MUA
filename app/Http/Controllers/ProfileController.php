<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'tgl_lahir' => 'nullable|date',
            // Validasi gambar: harus gambar, maks 2MB
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['nama', 'no_hp', 'tgl_lahir']);

        // Proses Upload Foto
        if ($request->hasFile('foto_profil')) {
            // 1. Hapus foto lama jika ada (dan bukan default)
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            
            // 2. Simpan foto baru ke folder 'profil' di storage public
            $path = $request->file('foto_profil')->store('profil', 'public');
            $data['foto_profil'] = $path;
        }

        // Update data user di database
        // Pastikan model User mapping ke tabel 'pengguna'
        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}