<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('campaign')->insertOrIgnore([
            ['id_campaign' => 1, 'judul' => 'Satwa Endemik', 'deskripsi' => 'Bantu pelestarian satwa yang hampir punah.', 'target' => 50000000, 'gambar' => 'campaign/ecN9ccEBweuV1kvAJXYM6VOptktr6TJJINnogSd6.jpg'],
            ['id_campaign' => 2, 'judul' => 'Terumbu Karang', 'deskripsi' => 'Bantu pelestarian ekosistem laut Indonesia.', 'target' => 100000000, 'gambar' => 'campaign/WOAectVq8IDxJLVOH4DxQi2u6oAHkwQzMnIyrR9S.jpg'],
            ['id_campaign' => 3, 'judul' => 'Pohon Bakau', 'deskripsi' => 'Tanam dan rawat pohon bakau untuk hutan pesisir.', 'target' => 30000000, 'gambar' => 'campaign/DfMInvXg74qFXcYWEbhGO5oFwT6H61Jk8ZNB9guk.webp'],
            ['id_campaign' => 4, 'judul' => 'sumbangan buat barca', 'deskripsi' => 'miskin', 'target' => 10000, 'gambar' => 'campaign/vuUXKirUU6kUMsoxdN0hgxzOHcqh8BqB3E7QXcm0.webp'],
        ]);
    }
}

