<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pengeluaran')) {
            Schema::create('pengeluaran', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->decimal('nominal', 15, 2);
                $table->date('tanggal');
                $table->string('kategori'); // Contoh: Operasional, Program, Gaji
                $table->string('bukti')->nullable(); // Path gambar bukti
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
