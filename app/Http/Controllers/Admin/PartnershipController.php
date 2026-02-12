<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Partnership::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $partnerships = $query->orderBy('urutan', 'asc')->latest()->paginate(10)->withQueryString();

        // Jika request AJAX, kita bisa return view yang sama
        // JavaScript di frontend akan mengambil bagian tbody dari response HTML
        return view('admin.partnerships.index', compact('partnerships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partnerships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'website_url' => 'nullable|url|max:255',
            'kategori' => 'required', // Hapus validasi 'in' agar bisa kita handle manual
        ]);

        $partnership = new Partnership();
        $partnership->name = $request->name;
        $partnership->description = $request->description;
        $partnership->website_url = $request->website_url;
        
        // Mapping Kategori Pintar (Apapun inputnya, simpan sesuai enum DB)
        $inputKategori = strtolower($request->kategori);
        if (str_contains($inputKategori, 'eksklusif') || str_contains($inputKategori, 'exclusive')) {
            $partnership->kategori = 'eksklusif';
        } elseif (str_contains($inputKategori, 'pengawasan')) {
            $partnership->kategori = 'pengawasan';
        } else {
            $partnership->kategori = 'reguler'; // Default ke reguler
        }
        
        $partnership->is_active = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $partnership->logo = $this->resizeAndSaveLogo($request->file('logo'));
        }

        try {
            $partnership->save();

            return redirect()->route('admin.partnerships.index')->with('success', 'Partnership created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating partnership: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partnership = Partnership::findOrFail($id);
        return view('admin.partnerships.edit', compact('partnership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $partnership = Partnership::findOrFail($id);

        // 1. Validasi yang lebih ketat dan aman
        $validatedData = $request->validate([
            // Pastikan nama unik, namun abaikan data yang sedang diedit
            'name' => 'required|string|max:255|unique:partnerships,name,' . $partnership->id,
            'description' => 'nullable|string',
            // Tambahkan 'webp' sebagai format gambar yang diizinkan
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'website_url' => 'nullable|url|max:255',
            // Validasi eksplisit untuk status aktif
            'is_active' => 'nullable|boolean',
            'kategori' => 'required',
        ]);

        try {
            $partnership->name = $request->name;
            $partnership->description = $request->description;
            $partnership->website_url = $request->website_url;
            
            // Mapping Kategori Pintar untuk Update
            $inputKategori = strtolower($request->kategori);
            if (str_contains($inputKategori, 'eksklusif') || str_contains($inputKategori, 'exclusive')) {
                $partnership->kategori = 'eksklusif';
            } elseif (str_contains($inputKategori, 'pengawasan')) {
                $partnership->kategori = 'pengawasan';
            } else {
                $partnership->kategori = 'reguler';
            }
            
            $partnership->is_active = $request->boolean('is_active');

            if ($request->hasFile('logo')) {
                if ($partnership->logo) {
                    Storage::disk('public')->delete($partnership->logo);
                }
                $partnership->logo = $this->resizeAndSaveLogo($request->file('logo'));
            }

            $partnership->save();

            return redirect()->route('admin.partnerships.index')->with('success', 'Partnership updated successfully.');
        } catch (\Exception $e) { // 3. Tambahkan withInput() agar data form tidak hilang saat error
            return back()->with('error', 'Error updating partnership: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partnership = Partnership::findOrFail($id);

        // Delete logo if exists
        if ($partnership->logo) {
            Storage::disk('public')->delete($partnership->logo);
        }

        $partnership->delete();

        return redirect()->route('admin.partnerships.index')->with('success', 'Partnership deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:partnerships,id',
        ]);

        foreach ($request->ids as $index => $id) {
            Partnership::where('id', $id)->update(['urutan' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Resize logo agar seragam (Max 300x300) dan simpan ke storage.
     */
    private function resizeAndSaveLogo($file)
    {
        // Target ukuran (kotak)
        $targetWidth = 300;
        $targetHeight = 300;

        // Ambil dimensi asli
        list($width, $height) = getimagesize($file);

        // Buat canvas baru (True Color)
        $newImage = imagecreatetruecolor($targetWidth, $targetHeight);

        // Handle transparansi (Penting untuk PNG/GIF)
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
        imagefilledrectangle($newImage, 0, 0, $targetWidth, $targetHeight, $transparent);

        // Load gambar sumber berdasarkan ekstensi
        $source = null;
        $ext = strtolower($file->getClientOriginalExtension());
        
        switch ($ext) {
            case 'jpg': case 'jpeg': $source = imagecreatefromjpeg($file); break;
            case 'png': $source = imagecreatefrompng($file); break;
            case 'gif': $source = imagecreatefromgif($file); break;
            case 'webp': if (function_exists('imagecreatefromwebp')) $source = imagecreatefromwebp($file); break;
        }

        // Jika format tidak didukung GD, simpan file asli saja
        if (!$source) {
            return $file->store('partnerships', 'public');
        }

        // Hitung rasio agar gambar pas di dalam kotak (Contain)
        $ratio = min($targetWidth / $width, $targetHeight / $height);
        $newW = $width * $ratio;
        $newH = $height * $ratio;
        
        // Posisi tengah (Center)
        $x = ($targetWidth - $newW) / 2;
        $y = ($targetHeight - $newH) / 2;

        // Resize
        imagecopyresampled($newImage, $source, $x, $y, 0, 0, $newW, $newH, $width, $height);

        // Simpan hasil
        $filename = 'partnerships/' . $file->hashName();
        $path = storage_path('app/public/' . $filename);
        
        // Pastikan folder ada
        if (!file_exists(dirname($path))) mkdir(dirname($path), 0755, true);

        switch ($ext) {
            case 'png': imagepng($newImage, $path); break;
            case 'gif': imagegif($newImage, $path); break;
            case 'webp': imagewebp($newImage, $path); break;
            default: imagejpeg($newImage, $path, 90); break;
        }

        // Bersihkan memori
        imagedestroy($newImage);
        imagedestroy($source);

        return $filename;
    }
}
