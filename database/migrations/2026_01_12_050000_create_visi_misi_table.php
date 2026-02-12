// c:\xampp\htdocs\MUA\database\migrations\2026_01_12_050000_create_visi_misi_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('visi_misi')) {
            Schema::create('visi_misi', function (Blueprint $table) {
                $table->id();
                $table->enum('kategori', ['visi', 'misi']);
                $table->string('judul')->nullable();
                $table->text('deskripsi');
                $table->string('icon')->nullable(); // Contoh: 'bi bi-tree'
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('visi_misi');
    }
};
