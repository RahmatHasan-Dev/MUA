<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('campaign')) {
            Schema::create('campaign', function (Blueprint $table) {
                $table->bigIncrements('id_campaign');
                $table->string('judul', 50);
                $table->string('deskripsi', 255);
                $table->integer('target');
                $table->string('gambar', 10000);
            });

            DB::table('campaign')->insert([
                ['id_campaign' => 1, 'judul' => 'Satwa Endemik', 'deskripsi' => 'Bantu pelestarian satwa yang hampir punah.', 'target' => 50000000, 'gambar' => 'campaign/ecN9ccEBweuV1kvAJXYM6VOptktr6TJJINnogSd6.jpg'],
                ['id_campaign' => 2, 'judul' => 'Terumbu Karang', 'deskripsi' => 'Bantu pelestarian ekosistem laut Indonesia.', 'target' => 100000000, 'gambar' => 'campaign/WOAectVq8IDxJLVOH4DxQi2u6oAHkwQzMnIyrR9S.jpg'],
                ['id_campaign' => 3, 'judul' => 'Pohon Bakau', 'deskripsi' => 'Tanam dan rawat pohon bakau untuk hutan pesisir.', 'target' => 30000000, 'gambar' => 'campaign/DfMInvXg74qFXcYWEbhGO5oFwT6H61Jk8ZNB9guk.webp'],
                ['id_campaign' => 4, 'judul' => 'sumbangan buat barca', 'deskripsi' => 'miskin', 'target' => 10000, 'gambar' => 'campaign/vuUXKirUU6kUMsoxdN0hgxzOHcqh8BqB3E7QXcm0.webp'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign');
    }
};