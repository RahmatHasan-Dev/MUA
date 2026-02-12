<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visi = VisiMisi::where('kategori', 'visi')->first();
        $misi = VisiMisi::where('kategori', 'misi')->get();

        return view('visimisi', compact('visi', 'misi'));
    }
}