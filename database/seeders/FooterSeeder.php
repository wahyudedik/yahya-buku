<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterLink;
use App\Models\FooterSetting;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Footer Settings
        FooterSetting::create([
            'description' => 'Kaplingan Dsn. Sambong Dukuh, RT. 04. RW. 07, DS. Sambong Dukuh Kec. Jombang Kab. Jombang Prov. Jawa Timur Indonesia',
            'copyright_text' => '© ' . date('Y') . ' PT. Nusatama Jaya Sakti . All Right Reserved',
            'created_by_text' => 'created by',
            'created_by_url' => 'https://noteds.com',
        ]);

        // Seed Footer Links - Tentang Kami
        $aboutLinks = [
            ['title' => 'Pena Langit', 'url' => '#'],
            ['title' => 'Publikasi Terpercaya', 'url' => '#'],
        ];

        foreach ($aboutLinks as $index => $link) {
            FooterLink::create([
                'title' => $link['title'],
                'url' => $link['url'],
                'category' => 'about_us',
                'order' => $index,
                'is_active' => true,
            ]);
        }

        // Seed Footer Links - Link Terkait
        $relatedLinks = [
            ['title' => 'Nusacomtech', 'url' => '#'],
            ['title' => 'ringincontong.com', 'url' => '#'],
            ['title' => 'Info Jombang', 'url' => '#'],
            ['title' => 'Kejar id', 'url' => '#'],
            ['title' => 'skul id', 'url' => '#'],
        ];

        foreach ($relatedLinks as $index => $link) {
            FooterLink::create([
                'title' => $link['title'],
                'url' => $link['url'],
                'category' => 'related',
                'order' => $index,
                'is_active' => true,
            ]);
        }
    }
}
