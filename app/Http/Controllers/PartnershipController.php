// File: app/Http\Controllers\Admin\PartnershipController.php

public function index()
{
    // SALAH (Penyebab Error):
    // $partnerships = Partnership::all(); 
    // atau 
    // $partnerships = Partnership::latest()->get();

    // BENAR (Solusi):
    // Gunakan paginate() agar method links() di blade bisa bekerja
    $partnerships = Partnership::latest()->paginate(10); 

    return view('admin.partnerships.index', compact('partnerships'));
}
