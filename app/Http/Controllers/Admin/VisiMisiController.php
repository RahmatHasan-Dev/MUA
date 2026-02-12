<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index(Request $request)
    {
        $visi = VisiMisi::where('kategori', 'visi')->first();

        $misiQuery = VisiMisi::where('kategori', 'misi');

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $misiQuery->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $misi = $misiQuery->orderBy('urutan', 'asc')->paginate(10)->withQueryString();

        return view('admin.visimisi.index', compact('visi', 'misi'));
    }

    public function create()
    {
        return view('admin.visimisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:visi,misi',
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'required',
            // Validasi Regex: Harus diawali dengan 'bi bi-', 'fas fa-', 'far fa-', atau 'fab fa-'
            'icon' => [
                'nullable', 
                'string', 
                'max:255', 
                'regex:/^(bi bi-|fas fa-|far fa-|fab fa-)[a-z0-9-]+$/'
            ],
            'urutan' => 'nullable|integer',
        ], [
            'icon.regex' => 'Format icon tidak valid. Gunakan format Bootstrap Icons (bi bi-nama) atau FontAwesome (fas fa-nama).'
        ]);

        // Validasi: Hanya boleh ada satu data Visi
        if ($request->kategori == 'visi') {
            if (VisiMisi::where('kategori', 'visi')->exists()) {
                return back()->withErrors(['kategori' => 'Data Visi sudah ada. Hanya boleh satu Visi. Silakan edit yang sudah ada.']);
            }
        }

        VisiMisi::create($request->all());
        return redirect()->route('admin.visimisi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $visimisi = VisiMisi::findOrFail($id);
        return view('admin.visimisi.edit', compact('visimisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'required',
            'icon' => [
                'nullable', 
                'string', 
                'max:255', 
                'regex:/^(bi bi-|fas fa-|far fa-|fab fa-)[a-z0-9-]+$/'
            ],
            'urutan' => 'nullable|integer',
        ], [
            'icon.regex' => 'Format icon tidak valid. Gunakan format Bootstrap Icons (bi bi-nama) atau FontAwesome (fas fa-nama).'
        ]);

        VisiMisi::findOrFail($id)->update($request->all());
        return redirect()->route('admin.visimisi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        VisiMisi::findOrFail($id)->delete();
        return redirect()->route('admin.visimisi.index')->with('success', 'Data berhasil dihapus.');
    }
}