<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partnership;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Jane Goodall Institute',
                'description' => 'Melindungi simpanse dan menginspirasi orang untuk melestarikan alam.',
                'logo' => 'images/janegoodall.png',
                'is_active' => true,
                'website_url' => 'https://janegoodall.org',
            ],
            [
                'name' => 'Parley for the Oceans',
                'description' => 'Jaringan kolaborasi untuk mengatasi ancaman polusi plastik di laut.',
                'logo' => 'images/parley.png',
                'is_active' => true,
                'website_url' => 'https://parley.tv',
            ],
            [
                'name' => 'Sierra Club',
                'description' => 'Organisasi lingkungan akar rumput paling berpengaruh di Amerika Serikat.',
                'logo' => 'images/sierraclub.png',
                'is_active' => true,
                'website_url' => 'https://www.sierraclub.org',
            ],
            [
                'name' => 'WALHI',
                'description' => 'Wahana Lingkungan Hidup Indonesia.',
                'logo' => 'images/walhi.png',
                'is_active' => true,
                'website_url' => 'https://www.walhi.or.id',
            ],
            [
                'name' => 'Oceana',
                'description' => 'Organisasi advokasi internasional untuk konservasi laut.',
                'logo' => 'images/oceana.png',
                'is_active' => true,
                'website_url' => 'https://oceana.org',
            ],
            [
                'name' => 'Kementerian LHK',
                'description' => 'Kementerian Lingkungan Hidup dan Kehutanan Republik Indonesia.',
                'logo' => 'images/menlhk.png',
                'is_active' => true,
                'website_url' => 'https://www.menlhk.go.id',
            ],
            [
                'name' => 'Kementerian LHK (Unit 2)',
                'description' => 'Unit kerja khusus konservasi hutan lindung.',
                'logo' => 'images/menlhk2.png',
                'is_active' => true,
                'website_url' => 'https://www.menlhk.go.id',
            ],
            [
                'name' => 'Kementerian LHK (Unit 3)',
                'description' => 'Pengawasan ekosistem pesisir dan laut.',
                'logo' => 'images/menlhk3.png',
                'is_active' => true,
                'website_url' => 'https://www.menlhk.go.id',
            ],
            [
                'name' => 'National Geographic',
                'description' => 'Menggunakan kekuatan sains, eksplorasi, dan penceritaan.',
                'logo' => 'images/natgeo.png',
                'is_active' => true,
                'website_url' => 'https://www.nationalgeographic.com',
            ],
            [
                'name' => 'Rainforest Alliance',
                'description' => 'Membangun dunia di mana manusia dan alam berkembang bersama.',
                'logo' => 'images/rainforest.png',
                'is_active' => true,
                'website_url' => 'https://www.rainforest-alliance.org',
            ],
            [
                'name' => 'The Conservation Drone',
                'description' => 'Teknologi drone untuk pemantauan hutan.',
                'logo' => 'images/tcd.png',
                'is_active' => true,
                'website_url' => 'https://conservationdrones.org',
            ],
            [
                'name' => 'WWF',
                'description' => 'Organisasi konservasi independen terbesar di dunia.',
                'logo' => 'images/wwf.png',
                'is_active' => true,
                'website_url' => 'https://www.wwf.id',
            ],
        ];

        foreach ($partners as $data) {
            // Cek agar tidak duplikat jika dijalankan berulang
            if (!Partnership::where('name', $data['name'])->exists()) {
                Partnership::create($data);
            }
        }
    }
}
