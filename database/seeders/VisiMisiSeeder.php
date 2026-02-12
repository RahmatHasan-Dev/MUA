<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insert Visi
        DB::table('visi_misi')->insert([
            'kategori' => 'visi',
            'judul' => 'Visi Kami',
            'deskripsi' => 'Menjadi garda terdepan dalam konservasi lingkungan berkelanjutan, melestarikan ekosistem pesisir, dan melindungi keanekaragaman hayati demi mewujudkan kehidupan yang harmonis bagi seluruh makhluk di bumi.',
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Insert Misi
        $misi = [
            [
                'judul' => 'Rehabilitasi Hutan',
                'deskripsi' => 'Aktif melestarikan dan merehabilitasi hutan bakau sebagai benteng alami pesisir dan habitat vital.',
                'icon' => 'bi bi-tree',
            ],
            [
                'judul' => 'Pemulihan Laut',
                'deskripsi' => 'Mengembangkan dan merawat terumbu karang untuk memulihkan keseimbangan ekosistem laut yang rapuh.',
                'icon' => 'bi bi-water',
            ],
            [
                'judul' => 'Edukasi Masyarakat',
                'deskripsi' => 'Meningkatkan kesadaran masyarakat melalui program edukasi konservasi yang inovatif dan partisipatif.',
                'icon' => 'bi bi-people',
            ],
            [
                'judul' => 'Perlindungan Satwa',
                'deskripsi' => 'Melindungi spesies langka dan terancam punah melalui upaya patroli, rehabilitasi, serta advokasi.',
                'icon' => 'bi bi-shield-check',
            ],
            [
                'judul' => 'Kemitraan Global',
                'deskripsi' => 'Membangun kemitraan strategis dengan komunitas lokal, pemerintah, dan organisasi internasional.',
                'icon' => 'bi bi-globe',
            ],
        ];

        foreach ($misi as $item) {
            DB::table('visi_misi')->insert([
                'kategori' => 'misi',
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'icon' => $item['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
