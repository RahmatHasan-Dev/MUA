<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /* =========================
     * FRONTEND
     * ========================= */
    public function index()
    {
        $visi = VisiMisi::where('kategori', 'visi')->first();
        $misi = VisiMisi::where('kategori', 'misi')
                        ->orderBy('urutan', 'asc')
                        ->get();

        return view('visimisi', compact('visi', 'misi'));
    }

    /* =========================
     * ADMIN
     * ========================= */
    public function adminIndex()
    {
        $visi = VisiMisi::where('kategori', 'visi')->first();
        $misi = VisiMisi::where('kategori', 'misi')
                        ->orderBy('urutan', 'asc')
                        ->get();

        return view('admin.visimisi.index', compact('visi', 'misi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori'   => 'required|in:visi,misi',
            'judul'      => 'nullable|string|max:255',
            'deskripsi'  => 'required',
            'icon'       => 'nullable|string|max:255',
            'urutan'     => 'nullable|integer',
        ]);

        // Hanya boleh satu VISI
        if ($request->kategori === 'visi') {
            if (VisiMisi::where('kategori', 'visi')->exists()) {
                return back()->withErrors([
                    'kategori' => 'Data Visi sudah ada. Silakan edit yang sudah ada.'
                ]);
            }
        }

        VisiMisi::create($request->all());

        return back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'nullable|string|max:255',
            'deskripsi' => 'required',
            'icon'      => 'nullable|string|max:255',
            'urutan'    => 'nullable|integer',
        ]);

        VisiMisi::findOrFail($id)->update($request->all());

        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        VisiMisi::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
