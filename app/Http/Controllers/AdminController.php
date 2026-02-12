<?php

namespace App\Http\Controllers;

use App\Models\FunFact;
use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\KomentarReport; // Import Model Report
use App\Notifications\NewReplyNotification; // Import Notification
use App\Models\KomentarLike; // Import Model Like
use App\Models\Donasi;
use App\Models\User;
use App\Models\Berita;
use App\Models\Partnership;
use App\Models\Campaign;
use App\Models\Pengeluaran; // Import Model Pengeluaran
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationStatusChanged;
use App\Mail\DonasiBerhasilMail; // Import Mailable Baru
use App\Mail\LaporanDonasiMail; // Import Mailable Baru
use App\Services\WhatsAppService; // Import Service
use App\Services\BalanceService; // Import BalanceService
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF Facade
use Illuminate\Support\Facades\Hash; // Import Hash untuk validasi password
use Illuminate\Support\Facades\Storage; // Import Storage untuk hapus file
use Illuminate\Support\Facades\Artisan; // Untuk Artisan Command
use Illuminate\Support\Facades\DB; // Untuk Backup Database
use Illuminate\Pagination\LengthAwarePaginator; // Untuk Pagination Manual

class AdminController extends Controller
{
    protected $balanceService;

    public function __construct(BalanceService $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    public function dashboard(Request $request)
    {
        // Base Query
        $query = Donasi::query();

        // Filter Berdasarkan Tanggal jika ada input
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date)
                  ->whereDate('tanggal', '<=', $request->end_date);
        }

        // Filter Pencarian Canggih (Nama, Email, ID Donasi, Nominal)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($subQ) use ($search) {
                    $subQ->where('nama', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhere('id_donasi', 'like', "%{$search}%")
                ->orWhere('nominal', 'like', "%{$search}%");
            });
        }

        // Filter Berdasarkan Jenis Program
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter Berdasarkan Status (Pending/Berhasil/Gagal)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Analisis Data untuk Dashboard
        // Kita clone $query agar filter tanggal tetap terbawa pada setiap perhitungan
        // 1. Menghitung Total Donasi yang Berhasil (Sum)
        $totalDonasi = (clone $query)->where('status', 'berhasil')->sum('nominal');

        // 2. Menghitung Total Pengeluaran
        $totalPengeluaran = $this->balanceService->getTotalExpenses();

        // 3. Menghitung Sisa Saldo
        $sisaSaldo = $totalDonasi - $totalPengeluaran;

        // 2. Menghitung Jumlah Transaksi Masuk (Count)
        $jumlahTransaksi = (clone $query)->count();

        // 3. Menghitung Donasi Pending
        $donasiPending = (clone $query)->where('status', 'pending')->count();

        // 4. Menghitung Total User Terdaftar
        $jumlahUser = User::count();

        // 4. Data Grafik Analisis Keuangan (Pemasukan vs Pengeluaran vs Saldo)
        // Tentukan rentang tanggal untuk grafik (Default 12 bulan terakhir jika tidak ada filter)
        $startDateChart = $request->filled('start_date') ? \Carbon\Carbon::parse($request->start_date)->startOfMonth() : now()->subMonths(11)->startOfMonth();
        $endDateChart = $request->filled('end_date') ? \Carbon\Carbon::parse($request->end_date)->endOfMonth() : now()->endOfMonth();

        // Query Pemasukan (Donasi Berhasil)
        $incomeData = Donasi::where('status', 'berhasil')
            ->whereBetween('tanggal', [$startDateChart, $endDateChart])
            ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, SUM(nominal) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Query Pengeluaran
        $expenseData = Pengeluaran::whereBetween('tanggal', [$startDateChart, $endDateChart])
            ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, SUM(nominal) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $chartLabels = [];
        $incomeValues = [];
        $expenseValues = [];
        $balanceValues = [];
        $targetValues = []; // Untuk Combo Chart (Target vs Aktual)

        $period = \Carbon\CarbonPeriod::create($startDateChart, '1 month', $endDateChart);
        foreach ($period as $date) {
            $monthKey = $date->format('Y-m');
            $chartLabels[] = $date->format('M Y');
            
            $inc = $incomeData[$monthKey] ?? 0;
            $exp = $expenseData[$monthKey] ?? 0;
            $bal = $inc - $exp; // Net Flow Bulanan

            $incomeValues[] = $inc;
            $expenseValues[] = $exp;
            $balanceValues[] = $bal;
            $targetValues[] = 5000000; // Contoh Target Bulanan Statis (Rp 5 Juta)
        }

        // 5. Data Pie Chart Status Donasi
        $pieQuery = Donasi::query();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $pieQuery->whereDate('tanggal', '>=', $request->start_date)
                     ->whereDate('tanggal', '<=', $request->end_date);
        }

        $statusData = (clone $pieQuery)->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();
        
        // Define a consistent order and color map to fix color mismatch
        $statusOrder = ['berhasil', 'pending', 'gagal'];
        $colorMap = [
            'berhasil' => '#10b981', // Green
            'pending'  => '#fbbf24', // Yellow
            'gagal'    => '#ef4444', // Red
        ];

        $pieLabels = [];
        $pieValues = [];
        $pieColors = [];

        foreach ($statusOrder as $status) {
            $pieLabels[] = ucfirst($status);
            $pieValues[] = $statusData[$status] ?? 0;
            $pieColors[] = $colorMap[$status];
        }

        // 6. Data Grafik Donasi Harian (NEW)
        $dailyQuery = Donasi::query()->where('status', 'berhasil');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = \Carbon\Carbon::parse($request->start_date);
            $endDate = \Carbon\Carbon::parse($request->end_date);
            $dailyQuery->whereDate('tanggal', '>=', $startDate)->whereDate('tanggal', '<=', $endDate);
        } else {
            $startDate = now()->subDays(29); // Default 30 hari terakhir
            $endDate = now();
            $dailyQuery->whereDate('tanggal', '>=', $startDate);
        }

        $dailyDataRaw = $dailyQuery->selectRaw('DATE(tanggal) as tgl, SUM(nominal) as total')
            ->groupBy('tgl')
            ->pluck('total', 'tgl');

        $dailyLabels = [];
        $dailyValues = [];
        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $dateString = $date->format('Y-m-d');
            $dailyLabels[] = $date->format('d M');
            $dailyValues[] = $dailyDataRaw[$dateString] ?? 0;
        }

        // 7. Data Area Chart (Tren Pertumbuhan User Kumulatif)
        // Mengambil data user baru per bulan
        $userGrowthRaw = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, COUNT(*) as total')
            ->where('created_at', '<=', $endDateChart) // Ambil semua user hingga akhir periode chart
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->pluck('total', 'bulan');

        // Hitung jumlah user awal sebelum periode chart dimulai untuk data kumulatif yang akurat
        $initialUserCount = User::where('created_at', '<', $startDateChart)->count();

        $areaLabels = [];
        $areaValues = [];
        $cumulativeUser = $initialUserCount;
        
        // Gunakan periode bulanan yang sama dengan grafik keuangan untuk sinkronisasi
        $monthlyPeriod = \Carbon\CarbonPeriod::create($startDateChart, '1 month', $endDateChart);
        foreach ($monthlyPeriod as $date) {
            $monthKey = $date->format('Y-m');
            $newUsersThisMonth = $userGrowthRaw[$monthKey] ?? 0;
            $cumulativeUser += $newUsersThisMonth; // Tambahkan user baru bulan ini ke total kumulatif
            
            $areaLabels[] = $date->format('M Y');
            $areaValues[] = $cumulativeUser;
        }

        // 8. Data Bubble Chart (Analisis Multidimensi: Jam vs Hari vs Nominal)
        // Visualisasi Highcharts [x, y, z] -> [Jam, Hari, Nominal]
        $bubbleData = Donasi::selectRaw('HOUR(created_at) as x, DAYOFWEEK(created_at) - 1 as y, nominal as z')
            ->where('status', 'berhasil')
            ->where('tanggal', '>=', now()->subMonths(6)) // Sampel 6 bulan terakhir
            ->get()
            ->map(function($item) {
                return [(int)$item->x, (int)$item->y, (int)$item->z];
            });

        // Recent Donations for Table
        $donations = Donasi::with('user')->orderBy('tanggal', 'desc')->paginate(5);
        
        // Today's stats
        $todayIncome = Donasi::where('status', 'berhasil')->whereDate('tanggal', today())->sum('nominal');
        $todayCount = Donasi::where('status', 'berhasil')->whereDate('tanggal', today())->count();
        $todayDonors = Donasi::with('user')->where('status', 'berhasil')->whereDate('tanggal', today())->get();

        return view('admin.dashboard', compact(
            'totalDonasi', 'totalPengeluaran', 'sisaSaldo', 'jumlahTransaksi', 'donasiPending', 'jumlahUser',
            'chartLabels', 'incomeValues', 'expenseValues', 'balanceValues', 'targetValues',
            'pieLabels', 'pieValues', 'pieColors',
            'dailyLabels', 'dailyValues',
            'areaLabels', 'areaValues',
            'bubbleData',
            'donations', 'todayIncome', 'todayCount', 'todayDonors'
        ));
    }

    public function pemasukan(Request $request)
    {
        // Query untuk donasi yang berstatus 'berhasil'
        $donations = Donasi::with('user')
            ->where('status', 'berhasil')
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        // Tampilkan view dengan data
        return view('admin.pemasukan', compact('donations'));
    }

    public function pengeluaran(Request $request)
    {
        $query = Pengeluaran::query();

        // Filter Tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date)
                  ->whereDate('tanggal', '<=', $request->end_date);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('nominal', 'like', "%{$search}%");
            });
        }

        // Hitung Total Pengeluaran (Sesuai Filter)
        $totalPengeluaran = (clone $query)->sum('nominal');

        // Data Chart (Ringkasan per Kategori)
        $chartData = (clone $query)->selectRaw('kategori, SUM(nominal) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $chartLabels = $chartData->keys();
        $chartValues = $chartData->values();

        // Mengambil data pengeluaran diurutkan dari tanggal terbaru
        $pengeluaran = $query->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->paginate(15)->withQueryString();

        // Hitung Saldo Tersedia (Total Donasi Berhasil - Total Semua Pengeluaran)
        $saldoSaatIni = $this->balanceService->getCurrentBalance();

        return view('admin.pengeluaran', compact('pengeluaran', 'chartLabels', 'chartValues', 'totalPengeluaran', 'saldoSaatIni'));
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',    
            'keterangan' => 'nullable|string',
        ]);

        // Validasi: Cek apakah saldo mencukupi
        $saldoSaatIni = $this->balanceService->getCurrentBalance();

        if ($request->nominal > $saldoSaatIni) {
            return back()->withErrors(['nominal' => 'Dana tidak mencukupi! Saldo saat ini: Rp ' . number_format($saldoSaatIni, 0, ',', '.')])->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti_pengeluaran', 'public');
        }

        // GENERATE NOMOR TRANSAKSI OTOMATIS (OUT-XXXX)
        // Cari ID terakhir untuk menentukan urutan
        $lastTransaction = Pengeluaran::orderBy('id', 'desc')->first();
        $nextId = $lastTransaction ? $lastTransaction->id + 1 : 1;
        
        // Format: OUT-00001
        $data['no_transaksi'] = 'OUT-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
        
        // Jika kolom no_transaksi belum ada di DB (belum migrate), baris ini akan diabaikan oleh Eloquent jika tidak ada di $fillable, 
        // tapi pastikan sudah migrate agar tersimpan.
        Pengeluaran::create($data);

        return back()->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function updatePengeluaran(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        // Validasi Update: Cek saldo (kembalikan nominal lama ke saldo dulu sebelum dikurangi nominal baru)
        $saldoSaatIni = $this->balanceService->getCurrentBalance();
        $saldoTanpaIni = $saldoSaatIni + $pengeluaran->nominal;

        if ($request->nominal > $saldoTanpaIni) {
            return back()->withErrors(['nominal' => 'Dana tidak mencukupi untuk perubahan ini! Saldo tersedia: Rp ' . number_format($saldoTanpaIni, 0, ',', '.')])->withInput();
        }

        $data = $request->except(['bukti', '_token', '_method']);

        if ($request->hasFile('bukti')) {
            // Hapus bukti lama jika ada
            if ($pengeluaran->bukti) {
                Storage::disk('public')->delete($pengeluaran->bukti);
            }
            $data['bukti'] = $request->file('bukti')->store('bukti_pengeluaran', 'public');
        }

        $pengeluaran->update($data);

        return back()->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroyPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        if ($pengeluaran->bukti) {
            Storage::disk('public')->delete($pengeluaran->bukti);
        }
        $pengeluaran->delete();

        return back()->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    public function cetakPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        // Load view khusus untuk cetak kwitansi, set ukuran kertas A5 landscape agar mirip kwitansi
        $pdf = Pdf::loadView('admin.cetak_pengeluaran', compact('pengeluaran'))->setPaper('a5', 'landscape');
        return $pdf->stream('kwitansi_pengeluaran_' . $pengeluaran->id . '.pdf');
    }

    public function users(Request $request)
    {
        $query = User::query();

        // 1. Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // 2. Fitur Filter Role (Baru)
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // 3. Fitur Filter Status Aktif/Blokir
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // 2. Fitur Sorting (Urutan)
        // Default sort by ID (Terbaru) jika tidak ada request
        $sortColumn = $request->input('sort', 'id'); 
        $sortDirection = $request->input('direction', 'desc');

        // Validasi kolom agar aman dari SQL Injection
        $validSorts = ['nama', 'email', 'id', 'role', 'created_at'];
        if (in_array($sortColumn, $validSorts)) {
            $query->orderBy($sortColumn, $sortDirection);
        } else {
            $query->orderBy('id', 'desc');
        }

        $users = $query->paginate(15)->withQueryString();
        return view('admin.users', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:pengguna,email,'.$id,
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|in:admin,user',
            'admin_password' => 'required', // Wajib isi password admin untuk konfirmasi
        ]);

        // 3. Validasi Password Admin (Keamanan)
        // Cek apakah password yang dimasukkan cocok dengan password admin yang sedang login
        if (!Hash::check($request->admin_password, auth()->user()->password)) {
            return back()->with('error', 'Password admin salah! Perubahan data ditolak demi keamanan.');
        }

        // Update hanya field yang diizinkan (cegah admin_password masuk ke database user)
        $user->update($request->only(['nama', 'email', 'no_hp', 'role']));

        return back()->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function toggleBlockUser($id)
    {
        if (auth()->id() == $id) {
            return back()->with('error', 'Anda tidak dapat memblokir akun sendiri.');
        }

        $user = User::findOrFail($id);
        
        // Toggle status (jika 1 jadi 0, jika 0 jadi 1)
        $user->is_active = !$user->is_active;
        $user->save();

        $statusMsg = $user->is_active ? 'diaktifkan kembali' : 'diblokir';
        return back()->with('success', "Pengguna berhasil $statusMsg.");
    }

    public function showUser($id)
    {
        // Ambil user beserta relasi donasinya, urutkan donasi dari yang terbaru
        $user = User::findOrFail($id);
        $donasi = Donasi::where('id_user', $id)->orderBy('tanggal', 'desc')->get();
        $user->setRelation('donasi', $donasi);

        return view('admin.user_detail', compact('user'));
    }

    public function exportUsers()
    {
        $users = User::all();
        $filename = "users_mua_" . date('Y-m-d_H-i-s') . ".csv";
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Nama', 'Email', 'No HP', 'Role']);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->nama,
                    $user->email,
                    $user->no_hp,
                    $user->role
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function bukti()
    {
        $donations = Donasi::with('user')->whereNotNull('bukti_transfer')->orderBy('tanggal', 'desc')->paginate(12);
        return view('admin.bukti', compact('donations'));
    }

    // --- FITUR TOOLS ---

    public function tools()
    {
        return view('admin.tools');
    }

    public function clearCache()
    {
        try {
            Artisan::call('optimize:clear'); // Membersihkan cache, route, config, view
            return back()->with('success', 'System Cache, Route, Config, dan View berhasil dibersihkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membersihkan cache: ' . $e->getMessage());
        }
    }

    public function fixStorage()
    {
        $link = public_path('storage');

        // 1. Hapus link/folder storage di public jika ada
        if (file_exists($link)) {
            // Coba hapus sebagai file/link
            @unlink($link);
            // Jika masih ada (berarti folder asli), rename agar aman
            if (file_exists($link)) {
                @rename($link, public_path('storage_backup_' . time()));
            }
        }

        // 2. Jalankan perintah storage:link
        try {
            Artisan::call('storage:link');
            return back()->with('success', 'Storage Link berhasil diperbaiki (Re-linked)! Gambar seharusnya sudah muncul.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbaiki storage link: ' . $e->getMessage());
        }
    }

    public function testEmail()
    {
        try {
            $adminEmail = auth()->user()->email;
            // Kirim email raw sederhana
            Mail::raw('Ini adalah email tes dari sistem MUA untuk memastikan konfigurasi SMTP berjalan lancar.', function ($message) use ($adminEmail) {
                $message->to($adminEmail)
                        ->subject('Test Email System MUA');
            });
            
            return back()->with('success', "Email tes berhasil dikirim ke $adminEmail. Silakan cek inbox/spam.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Cek konfigurasi .env Anda. Error: ' . $e->getMessage());
        }
    }

    public function backupDatabase()
    {
        // Backup Database ke format SQL (Lebih fungsional untuk restore via phpMyAdmin)
        $filename = 'backup_mua_' . date('Y-m-d_H-i-s') . '.sql';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            
            fwrite($handle, "-- Backup Database MUA\n");
            fwrite($handle, "-- Generated: " . date('Y-m-d H:i:s') . "\n\n");
            fwrite($handle, "SET FOREIGN_KEY_CHECKS=0;\n\n");

            // Daftar tabel lengkap sesuai migrasi
            $tables = ['admin', 'pengguna', 'berita', 'partnership', 'donasi', 'kegiatan', 'pengeluaran'];

            foreach ($tables as $table) {
                try {
                    // 1. Dump Structure (Schema)
                    $createTable = DB::select("SHOW CREATE TABLE `$table`");
                    $row = (array) $createTable[0];
                    $createSql = $row['Create Table'] ?? $row['Create View'] ?? '';
                    
                    fwrite($handle, "DROP TABLE IF EXISTS `$table`;\n");
                    fwrite($handle, $createSql . ";\n\n");

                    // 2. Dump Data (Insert Statements)
                    // Menggunakan cursor() untuk hemat memori saat data banyak
                    foreach (DB::table($table)->cursor() as $data) {
                        $dataArray = (array) $data;
                        $values = array_map(function ($value) {
                            if (is_null($value)) return 'NULL';
                            // Escape karakter berbahaya untuk SQL
                            return '"' . str_replace(['\\', '"', "\n", "\r", "\t"], ['\\\\', '\"', '\n', '\r', '\t'], $value) . '"';
                        }, $dataArray);
                        
                        fwrite($handle, "INSERT INTO `$table` VALUES (" . implode(", ", $values) . ");\n");
                    }
                    fwrite($handle, "\n");
                } catch (\Exception $e) {
                    fwrite($handle, "-- Error backing up $table: " . $e->getMessage() . "\n");
                }
            }

            fwrite($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
            fclose($handle);
        }, $filename);
    }

    // --- FITUR PENGAMBILAN DANA (WITHDRAWAL) ---

    public function withdrawal()
    {
        // Hitung Saldo Tersedia
        $saldoSaatIni = $this->balanceService->getCurrentBalance();

        // Ambil riwayat pengambilan dana (Kategori: Withdrawal)
        $riwayat = Pengeluaran::where('kategori', 'Withdrawal')->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->paginate(10);

        return view('admin.withdrawal', compact('saldoSaatIni', 'riwayat'));
    }

    public function storeWithdrawal(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:10000',
            'bank_tujuan' => 'required|string',
            'no_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'keterangan' => 'nullable|string',
            'password_konfirmasi' => 'required' // Keamanan ekstra
        ]);

        // 1. Cek Password Admin
        if (!Hash::check($request->password_konfirmasi, auth()->user()->password)) {
            return back()->withErrors(['password_konfirmasi' => 'Password admin salah! Penarikan ditolak.'])->withInput();
        }

        // 2. Cek Saldo
        $saldoSaatIni = $this->balanceService->getCurrentBalance();

        if ($request->nominal > $saldoSaatIni) {
            return back()->withErrors(['nominal' => 'Saldo tidak mencukupi untuk penarikan ini.'])->withInput();
        }

        // 3. Generate No Transaksi
        $lastTransaction = Pengeluaran::orderBy('id', 'desc')->first();
        $nextId = $lastTransaction ? $lastTransaction->id + 1 : 1;
        $noTransaksi = 'WD-' . str_pad($nextId, 5, '0', STR_PAD_LEFT); // Prefix WD untuk Withdrawal

        // 4. Simpan Otomatis ke Tabel Pengeluaran
        Pengeluaran::create([
            'no_transaksi' => $noTransaksi,
            'judul' => "Penarikan Dana ke {$request->bank_tujuan} ({$request->no_rekening}) a.n {$request->atas_nama}" . ($request->keterangan ? " - {$request->keterangan}" : ""),
            'nominal' => $request->nominal,
            'tanggal' => now(),
            'kategori' => 'Withdrawal', // Kategori khusus
            'bukti' => null
        ]);

        return redirect()->route('admin.withdrawal')->with('success', 'Penarikan dana berhasil diproses dan tercatat di Pengeluaran.');
    }

    public function exportView()
    {
        return view('admin.export_view');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,berhasil,gagal',
            'catatan' => 'nullable|string|max:255',
        ]);
        $donation = Donasi::where('id_donasi', $id)->firstOrFail();
        $donation->status = $request->status;
        $donation->catatan = $request->catatan; // Simpan catatan
        $donation->save();

        // Kirim Email Notifikasi jika user memiliki email
        if ($donation->user && $donation->user->email) {
            // Jika status BERHASIL, kirim email khusus yang cantik
            if ($request->status == 'berhasil') {
                Mail::to($donation->user->email)->queue(new DonasiBerhasilMail($donation));
            } else {
                // Jika status lain (misal Gagal/Pending), kirim email standar
                Mail::to($donation->user->email)->queue(new DonationStatusChanged($donation));
            }
        }

        // Kirim Notifikasi WhatsApp (Jika user punya No HP)
        if ($donation->user && $donation->user->no_hp) {
            try {
                $waService = new WhatsAppService();
                $pesan = "Halo {$donation->user->nama},\n\nStatus donasi Anda ID #{$donation->id_donasi} telah diperbarui menjadi: " . strtoupper($request->status) . ".\n\nTerima kasih telah mendukung Menadah Untuk Alam.";
                
                // Kirim (bisa di-queue juga jika ingin async penuh)
                $waService->send($donation->user->no_hp, $pesan);
            } catch (\Throwable $e) {
                // Jangan biarkan error WA menghentikan proses update status
            }
        }

        return back()->with('success', 'Status donasi berhasil diperbarui.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1',
        ]);

        $donation = Donasi::findOrFail($id);
        $donation->update(['nominal' => $request->nominal]);

        return back()->with('success', 'Nominal donasi berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        // Gunakan logika filter yang sama dengan dashboard
        $query = Donasi::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($subQ) use ($search) {
                    $subQ->where('nama', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhere('id_donasi', 'like', "%{$search}%")
                ->orWhere('nominal', 'like', "%{$search}%");
            });
        }

        // Filter Berdasarkan Status (Tambahan Baru)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Berdasarkan Jenis (Tambahan Baru)
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $donations = $query->with('user')->orderBy('tanggal', 'desc')->get();

        // Persiapan file CSV
        $filename = "laporan_donasi_" . date('Y-m-d_H-i-s') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Tanggal', 'Donatur', 'Email', 'Program', 'Nominal', 'Status']);

            foreach ($donations as $donasi) {
                fputcsv($file, [
                    $donasi->id_donasi,
                    $donasi->tanggal,
                    $donasi->user->nama ?? 'Guest',
                    $donasi->user->email ?? '-',
                    $donasi->jenis,
                    $donasi->nominal,
                    $donasi->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        // Gunakan logika filter yang sama (bisa di-refactor ke private method agar DRY)
        $query = Donasi::query();
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }
        // ... (tambahkan filter lain jika perlu)

        $donations = $query->with('user')->orderBy('tanggal', 'desc')->get();
        $pdf = Pdf::loadView('admin.pdf_report', compact('donations'));
        return $pdf->download('laporan_donasi_mua.pdf');
    }

    public function emailPdf(Request $request)
    {
        // Logika filter sama dengan exportPdf
        $query = Donasi::query();
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $donations = $query->with('user')->orderBy('tanggal', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.pdf_report', compact('donations'));
        
        // Kirim ke email admin yang sedang login
        Mail::to(auth()->user()->email)->send(new LaporanDonasiMail($pdf->output()));

        return back()->with('success', 'Laporan PDF berhasil dikirim ke email ' . auth()->user()->email);
    }

    public function show($id)
    {
        $donasi = Donasi::with('user')->findOrFail($id);
        return view('admin.show', compact('donasi'));
    }



public function funfact(Request $request)
    {
        $query = funfact::query();

        // 1. Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('headline', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('angka', 'like', "%{$search}%");
            });
        }

        // 2. Fitur Sorting (Urutan)
        // Default sort by ID (Terbaru) jika tidak ada request
        $sortColumn = $request->input('sort', 'id_funfact'); 
        $sortDirection = $request->input('direction', 'desc');

        $funfact = $query->paginate(15)->withQueryString();
        return view('admin.funfact', compact('funfact'));
    }

    public function funfactDelete($id)
    {
        $funfact = funfact::findOrFail($id);
        $funfact->delete();

        return back()->with('success', 'funfact berhasil dihapus.');
    }

    public function funfactEdit($id)
    {
        $funfact = funfact::findOrFail($id);
        return view('admin.funfact_edit', compact('funfact'));
    }

    public function funfactUpdate(Request $request, $id)
    {
        $funfact = funfact::findOrFail($id);


        $validated = $request->validate([
            'emoji' => ['required', 'string', 'max:1000'],
            'angka' => ['required', 'string', 'max:1000'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'headline' => ['required', 'string', 'max:1000']
        ]);

        $funfact->fill($validated);

        $funfact->save();

        return redirect()->route('admin.funfact')->with('success', 'funfact berhasil diperbarui.');
    }

    public function funfactExport()
    {
        $funfact = funfact::all();
        $filename = "funfact_mua_" . date('Y-m-d_H-i-s') . ".csv";
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($funfact) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Emoji', 'Deskripsi', 'Angka', 'Deskripsi']);

            foreach ($funfact as $funfactx) {
                fputcsv($file, [
                    $funfactx->id_funfact,
                    $funfactx->emoji,
                    $funfactx->angka,
                    $funfactx->deskripsi,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function funfactAdd()
    {
        return view('admin.funfact_add');
    }

    public function funfactStore(Request $request)
    {
        $validated = $request->validate([
            'emoji' => ['required', 'string', 'max:1000'],
            'angka' => ['required', 'string', 'max:1000'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'headline' => ['required', 'string', 'max:1000']
        ]);

        funfact::create($validated);

        return redirect()
            ->route('admin.funfact')
            ->with('success', 'funfact berhasil disimpan');
    }

    
    public function berita(Request $request)
    {
        $query = Berita::query();

        // 1. Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('tag1', 'like', "%{$search}%")
                  ->orWhere('tag2', 'like', "%{$search}%")
                  ->orWhere('tag3', 'like', "%{$search}%");
            });
        }

        // 2. Fitur Sorting (Urutan)
        // Default sort by ID (Terbaru) jika tidak ada request
        $sortColumn = $request->input('sort', 'id_berita'); 
        $sortDirection = $request->input('direction', 'desc');

        $berita = $query->paginate(15)->withQueryString();
        return view('admin.berita', compact('berita'));
    }

    public function beritaDelete($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita_edit', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);


        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:1000'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tanggal' => ['required', 'date', 'max:1000'],
            'lokasi' => ['required', 'string', 'max:1000'],
            'peserta' => ['required', 'string', 'max:1000'],
            'tag1' => ['required', 'string', 'max:1000'],
            'tag2' => ['required', 'string', 'max:1000'],
            'tag3' => ['required', 'string', 'max:1000']
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] =
                $request->file('gambar')->store('berita', 'public');
        }

        $berita->fill($validated);

        $berita->save();

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function beritaExport()
    {
        $berita = Berita::all();
        $filename = "berita_mua_" . date('Y-m-d_H-i-s') . ".csv";
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($berita) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Judul Berita', 'Deskripsi', 'Gambar', 'Tanggal', 'Lokasi', 'Peserta', 'Tag 1', 'Tag 2', 'Tag 3']);

            foreach ($berita as $beritax) {
                fputcsv($file, [
                    $beritax->id_berita,
                    $beritax->judul,
                    $beritax->deskripsi,
                    $beritax->gambar,
                    $beritax->tanggal,
                    $beritax->lokasi,
                    $beritax->peserta,
                    $beritax->tag1,
                    $beritax->tag2,
                    $beritax->tag3
                ]);
            }
            fclose($file);
        };

        

        return response()->stream($callback, 200, $headers);
    }

    public function beritaAdd()
    {
        return view('admin.berita_add');
    }

    public function beritaStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:1000'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tanggal' => ['required', 'date', 'max:1000'],
            'lokasi' => ['required', 'string', 'max:1000'],
            'peserta' => ['required', 'string', 'max:1000'],
            'tag1' => ['required', 'string', 'max:1000'],
            'tag2' => ['required', 'string', 'max:1000'],
            'tag3' => ['required', 'string', 'max:1000']
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] =
                $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil disimpan');
    }
    
    public function kegiatanIndex()
    {
        $kegiatan = Berita::orderBy('id_berita', 'desc')->get();

        return view('kegiatan', compact('kegiatan'));
    }

    public function kegiatanDetail($id)
    {
        $kegiatan = Berita::findOrFail($id);

        // Ambil semua tag dari berita saat ini dan hapus yang kosong
        $tags = array_filter([$kegiatan->tag1, $kegiatan->tag2, $kegiatan->tag3]);

        // Query Berita Terkait: Cari berita lain yang memiliki salah satu tag yang sama
        $otherKegiatan = Berita::where('id_berita', '!=', $id)
            ->where(function ($query) use ($tags) {
                if (!empty($tags)) {
                    $query->whereIn('tag1', $tags)
                          ->orWhereIn('tag2', $tags)
                          ->orWhereIn('tag3', $tags);
                }
            })
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        // Fallback: Jika tidak ada berita terkait, tampilkan berita terbaru biasa
        if ($otherKegiatan->isEmpty()) {
            $otherKegiatan = Berita::where('id_berita', '!=', $id)->orderBy('tanggal', 'desc')->take(3)->get();
        }

        // Cek apakah ada Campaign Donasi yang terhubung (Berdasarkan kemiripan judul)
        $connectedCampaign = Campaign::where('judul', 'LIKE', '%' . $kegiatan->judul . '%')->first();
        
        if ($connectedCampaign) {
            $terkumpul = Donasi::where('id_campaign', $connectedCampaign->id_campaign)
                ->where('status', 'berhasil')
                ->sum('nominal');
            $connectedCampaign->terkumpul = $terkumpul;
            $connectedCampaign->percent = $connectedCampaign->target > 0 ? ($terkumpul / $connectedCampaign->target) * 100 : 0;
        }

        return view('kegiatan_detail', compact('kegiatan', 'otherKegiatan', 'connectedCampaign'));
    }

    public function storeKomentar(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:komentar,id', // Validasi parent_id
        ]);

        // 1. Validasi Kata Kasar (Sederhana)
        $badWords = ['kasar', 'bodoh', 'jelek', 'anjing', 'babi', 'bangsat']; // Tambahkan kata lain sesuai kebutuhan
        foreach ($badWords as $word) {
            if (stripos($request->isi, $word) !== false) {
                return back()->with('error', 'Komentar mengandung kata yang tidak pantas.');
            }
        }

        $komentar = Komentar::create([
            'id_berita' => $id,
            'id_user' => auth()->id(),
            'isi' => $request->isi,
            'parent_id' => $request->parent_id // Simpan parent_id jika ada (reply)
        ]);

        // Kirim Notifikasi jika ini adalah balasan
        if ($request->parent_id) {
            $parentComment = Komentar::find($request->parent_id);
            if ($parentComment && $parentComment->id_user != auth()->id()) {
                $parentComment->user->notify(new NewReplyNotification($komentar));
            }
        }

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    // Fitur Like Komentar
    public function likeKomentar($id)
    {
        $komentar = Komentar::findOrFail($id);
        $userId = auth()->id();

        // Cek apakah sudah like
        $existingLike = KomentarLike::where('id_komentar', $id)->where('id_user', $userId)->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $msg = 'Like dibatalkan.';
        } else {
            // Like
            KomentarLike::create([
                'id_komentar' => $id,
                'id_user' => $userId
            ]);
            $msg = 'Komentar disukai.';
        }

        return back()->with('success', $msg);
    }

    // Fitur Hapus Komentar
    public function deleteKomentar($id)
    {
        $komentar = Komentar::where('id', $id)->where('id_user', auth()->id())->firstOrFail();
        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    // Fitur Report Komentar
    public function reportKomentar(Request $request, $id)
    {
        $request->validate(['alasan' => 'required|string|max:255']);

        KomentarReport::create([
            'id_komentar' => $id,
            'id_user' => auth()->id(),
            'alasan' => $request->alasan
        ]);

        return back()->with('success', 'Laporan berhasil dikirim. Terima kasih atas masukan Anda.');
    }

    public function partnershipIndex(Request $request)
    {
        $query = Partnership::where('is_active', true);

        // Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', 'like', '%' . $request->kategori . '%'); // Ubah jadi like agar lebih fleksibel
        }

        // Filter Pencarian Nama
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ambil semua data untuk marquee (tanpa pagination)
        $partnerships = $query->orderBy('urutan', 'asc')->latest()->get();

        return view('partnership', compact('partnerships'));
    }

    public function partnershipDetail($id)
    {
        $partnership = Partnership::findOrFail($id);
        return view('partnership_detail', compact('partnership'));
    }

    public function funfactIndex()
    {
        $funfact = FunFact::orderBy('id_funfact', 'asc')->get();

        return view('funfact', compact('funfact'));
    }

    public function donasiIndex()
    {
        $campaigns = Campaign::all();
        
        // Hitung progress dan ambil donatur terbaru per campaign
        foreach ($campaigns as $campaign) {
            // Total Terkumpul
            $terkumpul = Donasi::where('id_campaign', $campaign->id_campaign)
                ->where('status', 'berhasil')
                ->sum('nominal');
            
            $campaign->terkumpul = $terkumpul;
            $campaign->percent = $campaign->target > 0 ? ($terkumpul / $campaign->target) * 100 : 0;
            
            // 5 Donatur Terbaru
            $campaign->recent_donors = Donasi::with('user')
                ->where('id_campaign', $campaign->id_campaign)
                ->where('status', 'berhasil')
                ->orderBy('tanggal', 'desc')
                ->take(5)
                ->get();
        }

        $topDonatur = Donasi::with('user')
        ->selectRaw('id_user, SUM(nominal) as total_donasi')
        ->where('status', 'berhasil')
        ->groupBy('id_user')
        ->orderByDesc('total_donasi')
        ->take(5)
        ->get();

        return view('donasi', compact('campaigns', 'topDonatur'));
    }

    public function campaign(Request $request)
    {
        $query = Campaign::query();

        // 1. Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // 2. Fitur Sorting (Urutan)
        // Default sort by ID (Terbaru) jika tidak ada request
        $sortColumn = $request->input('sort', 'id_campaign'); 
        $sortDirection = $request->input('direction', 'desc');

        $campaign = $query->paginate(15)->withQueryString();
        return view('admin.campaign', compact('campaign'));
    }

    public function campaignDelete($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return back()->with('success', 'Campaign berhasil dihapus.');
    }

    public function campaignEdit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaign_edit', compact('campaign'));
    }

    public function campaignUpdate(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:1000',
            'deskripsi' => 'required|string|max:1000',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'target' => 'required|integer',
        ]);

        if ($request->hasFile('gambar')) {
            if ($campaign->gambar) {
                Storage::disk('public')->delete($campaign->gambar);
            }

            $validated['gambar'] =
                $request->file('gambar')->store('campaign', 'public');
        }

        $campaign->update($validated);

        return redirect()
            ->route('admin.campaign')
            ->with('success', 'Campaign berhasil diupdate');
    }

    public function campaignExport()
    {
        $campaign = Campaign::all();
        $filename = "campaign_mua_" . date('Y-m-d_H-i-s') . ".csv";
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($campaign) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Judul Campaign', 'Gambar', 'Target']);

            foreach ($campaign as $campaignx) {
                fputcsv($file, [
                    $campaignx->id_campaign,
                    $campaignx->judul,
                    $campaignx->deskripsi,
                    $campaignx->gambar,
                    $campaignx->target
                ]);
            }
            fclose($file);
        };

        

        return response()->stream($callback, 200, $headers);
    }

    public function campaignAdd()
    {
        return view('admin.campaign_add');
    }

    public function campaignStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:1000',
            'deskripsi' => 'required|string|max:1000',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'target' => 'required|integer',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] =
                $request->file('gambar')->store('campaign', 'public');
        }

        Campaign::create($validated);

        return redirect()
            ->route('admin.campaign')
            ->with('success', 'Campaign berhasil disimpan');
    }

    // --- KELOLA PARTNERSHIP (ADMIN) ---

    public function partnerships(Request $request)
    {
        $query = Partnership::query();

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Sorting Default
        $partnerships = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('admin.partnerships.index', compact('partnerships'));
    }

    public function partnershipsCreate()
    {
        return view('admin.partnerships.create');
    }

    public function partnershipsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
            'is_active' => 'nullable',
            'website_url' => 'nullable|url|max:255', // Pastikan validasi URL
            'kategori' => 'required|in:reguler,eksklusif,pengawasan',
        ]);

        $partnership = new Partnership();
        $partnership->name = $request->name;
        $partnership->description = $request->description;
        $partnership->website_url = $request->website_url;
        $partnership->kategori = $request->kategori;
        $partnership->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('logo')) {
            $partnership->logo = $request->file('logo')->store('partnerships', 'public');
        }

        $partnership->save();

        return redirect()->route('admin.partnerships.index')->with('success', 'Partnership berhasil ditambahkan.');
    }

    public function partnershipsEdit($id)
    {
        $partnership = Partnership::findOrFail($id);
        return view('admin.partnerships.edit', compact('partnership'));
    }

    public function partnershipsUpdate(Request $request, $id)
    {
        $partnership = Partnership::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'nullable',
            'website_url' => 'nullable|url|max:255',
            'kategori' => 'required|in:reguler,eksklusif,pengawasan',
        ]);

        $partnership->name = $request->name;
        $partnership->description = $request->description;
        $partnership->website_url = $request->website_url;
        $partnership->kategori = $request->kategori;
        $partnership->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('logo')) {
            if ($partnership->logo) {
                Storage::disk('public')->delete($partnership->logo);
            }
            $partnership->logo = $request->file('logo')->store('partnerships', 'public');
        }

        $partnership->save();

        return redirect()->route('admin.partnerships.index')->with('success', 'Partnership berhasil diperbarui.');
    }

    public function partnershipsDestroy($id)
    {
        $partnership = Partnership::findOrFail($id);
        
        if ($partnership->logo) {
            Storage::disk('public')->delete($partnership->logo);
        }
        
        $partnership->delete();

        return back()->with('success', 'Partnership berhasil dihapus.');
    }

    // --- NOTIFIKASI REAL-TIME & MARK AS READ ---

    public function fetchNotifications()
    {
        // Ambil list ID yang sudah dibaca dari session
        $readDonasi = session('read_donasi', []);
        $readLaporan = session('read_laporan', []);

        // Ambil data terbaru (Filter not in read session)
        $notifDonasi = Donasi::where('status', 'pending')
            ->whereNotIn('id_donasi', $readDonasi)
            ->with('user')->latest()->take(5)->get();
        $notifLaporan = KomentarReport::where('status', 'pending')
            ->whereNotIn('id', $readLaporan)
            ->with('pelapor')->latest()->take(5)->get();
        $notifPengeluaran = Pengeluaran::latest()->take(3)->get();

        // Hitung TOTAL pending (Real-time task count)
        $countDonasi = Donasi::where('status', 'pending')->whereNotIn('id_donasi', $readDonasi)->count();
        $countLaporan = KomentarReport::where('status', 'pending')->whereNotIn('id', $readLaporan)->count();

        $totalUnread = $countDonasi + $countLaporan;

        // Render HTML partial
        $html = view('admin.partials.notification_items', compact('notifDonasi', 'notifLaporan', 'notifPengeluaran'))->render();

        return response()->json([
            'count' => $totalUnread,
            'html' => $html
        ]);
    }

    public function markNotificationsRead()
    {
        // Simpan waktu sekarang sebagai batas "terbaca"
        session(['admin_notif_read_at' => now()]);
        return response()->json(['success' => true]);
    }

    public function markSingleNotificationRead(Request $request)
    {
        $request->validate([
            'type' => 'required|in:donasi,laporan',
            'id' => 'required'
        ]);

        $type = $request->type;
        $id = $request->id;

        if ($type == 'donasi') {
            $read = session('read_donasi', []);
            if (!in_array($id, $read)) {
                $read[] = $id;
                session(['read_donasi' => $read]);
            }
        } elseif ($type == 'laporan') {
            $read = session('read_laporan', []);
            if (!in_array($id, $read)) {
                $read[] = $id;
                session(['read_laporan' => $read]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function notifications(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Base queries
        $donasiQuery = Donasi::with('user');
        $laporanQuery = KomentarReport::with(['pelapor', 'komentar.pengguna']);

        // Apply date filter if present
        if ($request->filled('start_date')) {
            $donasiQuery->where('created_at', '>=', $request->start_date);
            $laporanQuery->where('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $donasiQuery->where('created_at', '<=', $request->end_date);
            $laporanQuery->where('created_at', '<=', $request->end_date);
        }

        // Get data, map to a standard format
        $donasi = $donasiQuery->get()->map(function ($item) {
                $item->type = 'donasi';
                $item->sort_date = $item->created_at;
                return $item;
            });

        $laporan = $laporanQuery->get()->map(function ($item) {
                $item->type = 'laporan';
                $item->sort_date = $item->created_at;
                return $item;
            });

        // Gabungkan dan Sortir
        $merged = $donasi->merge($laporan)->sortByDesc('sort_date');

        // Pagination Manual
        $page = request()->get('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;

        $notifications = new LengthAwarePaginator($merged->slice($offset, $perPage)->values(), $merged->count(), $perPage, $page, ['path' => request()->url(), 'query' => request()->query()]);

        return view('admin.notifications', compact('notifications'));
    }

    // --- PROFIL ADMIN ---

    public function editProfile()
    {
        $user = auth()->user();
        return view('admin.pengaturan_admin', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama' => 'required|string|max:100',
            // Email dihapus dari validasi agar tidak bisa diubah
            'no_hp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'foto_profil' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'no_hp']); // Hapus email dari data yang diupdate

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profil', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function deleteProfilePhoto()
    {
        $user = auth()->user();

        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
            $user->foto_profil = null;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }
}