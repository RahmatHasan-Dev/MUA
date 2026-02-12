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
        if (!Schema::hasTable('funfact')) {
            Schema::create('funfact', function (Blueprint $table) {
                $table->bigIncrements('id_funfact');
                $table->string('emoji', 50);
                $table->string('angka', 50);
                $table->string('headline', 255);
                $table->string('deskripsi', 500);
            });

            DB::table('funfact')->insert([
                ['id_funfact' => 1, 'emoji' => '🦎', 'headline' => 'Negara Mega Biodiversitas', 'angka' => '17%', 'deskripsi' => 'Indonesia memiliki 17% dari total spesies di dunia meskipun hanya menempati 1,3% dari luas daratan Bumi. Kita adalah rumah bagi lebih dari 300.000 spesies flora dan fauna!'],
                ['id_funfact' => 2, 'emoji' => '🌳', 'headline' => 'Hutan Hujan Tertua', 'angka' => '130 juta', 'deskripsi' => 'Hutan hujan Indonesia berusia lebih dari 130 juta tahun, lebih tua dari hutan Amazon! Hutan ini telah menjadi rumah bagi jutaan spesies selama era dinosaurus.'],
                ['id_funfact' => 3, 'emoji' => '🐅', 'headline' => 'Harimau Sumatera Unik', 'angka' => '400', 'deskripsi' => 'Tersisa hanya sekitar 400 ekor Harimau Sumatera di alam liar. Mereka adalah subspesies harimau terkecil di dunia dan satu-satunya yang masih hidup di Indonesia.'],
                ['id_funfact' => 4, 'emoji' => '🦢', 'headline' => 'Burung Endemik Terbanyak', 'angka' => '381', 'deskripsi' => 'Indonesia memiliki 381 spesies burung endemik, tertinggi di dunia! Dari Cenderawasih Papua hingga Jalak Bali, setiap pulau memiliki keunikan tersendiri.'],
                ['id_funfact' => 5, 'emoji' => '🐟', 'headline' => 'Segitiga Terumbu Karang', 'angka' => '76%', 'deskripsi' => 'Perairan Indonesia adalah pusat Coral Triangle yang memiliki 76% dari semua spesies karang di dunia. Ini adalah "Amazon-nya lautan"!'],
                ['id_funfact' => 6, 'emoji' => '🌺', 'headline' => 'Bunga Raksasa Rafflesia', 'angka' => '1 meter', 'deskripsi' => 'Rafflesia arnoldii, bunga terbesar di dunia dengan diameter hingga 1 meter, hanya ditemukan di hutan Sumatera. Sayangnya, bunga ini terancam punah karena deforestasi.'],
                ['id_funfact' => 7, 'emoji' => '🐒', 'headline' => 'Orangutan Kalimantan', 'angka' => '104.000', 'deskripsi' => 'Populasi orangutan Kalimantan tersisa sekitar 104.000 individu. Mereka adalah satu-satunya kera besar di Asia dan berbagi 97% DNA dengan manusia!'],
                ['id_funfact' => 8, 'emoji' => '🐢', 'headline' => 'Penyu Purba', 'angka' => '110 juta', 'deskripsi' => 'Penyu telah hidup di bumi selama 110 juta tahun. Indonesia adalah rumah bagi 6 dari 7 spesies penyu dunia, termasuk penyu belimbing yang bisa mencapai berat 700 kg!'],
                ['id_funfact' => 9, 'emoji' => '🦋', 'headline' => 'Surga Kupu-kupu', 'angka' => '2.500', 'deskripsi' => 'Indonesia memiliki lebih dari 2.500 spesies kupu-kupu, termasuk yang terbesar di dunia yaitu Kupu-kupu Sayap Burung dari Papua dengan lebar sayap 28 cm!'],
                ['id_funfact' => 11, 'emoji' => '🐷🐖', 'headline' => 'Babi', 'angka' => '100% haram', 'deskripsi' => 'oik oik'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funfact');
    }
};
