<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengeluaran', function (Blueprint $table) {
            // Menambahkan kolom no_transaksi setelah id
            $table->string('no_transaksi', 20)->nullable()->after('id')->unique();
        });

        // Opsional: Generate no_transaksi untuk data lama
        $pengeluaran = \App\Models\Pengeluaran::all();
        foreach($pengeluaran as $p) {
            $p->update(['no_transaksi' => 'OUT-' . str_pad($p->id, 5, '0', STR_PAD_LEFT)]);
        }
    }

    public function down(): void
    {
        Schema::table('pengeluaran', function (Blueprint $table) {
            $table->dropColumn('no_transaksi');
        });
    }
};