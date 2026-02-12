<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('visi_misi')) {
            Schema::create('visi_misi', function (Blueprint $table) {
                $table->id();
                $table->enum('kategori', ['visi', 'misi']); // Membedakan Visi dan Misi
                $table->string('judul');
                $table->text('deskripsi');
                $table->string('icon')->nullable(); // Kolom untuk icon (misal: bi bi-tree)
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visi_misi');
    }
};