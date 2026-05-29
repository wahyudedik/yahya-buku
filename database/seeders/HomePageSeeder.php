<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Book;
use App\Models\Career;
use App\Models\CompanyProfile;
use App\Models\ContactSetting;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HeroSetting;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Str;

class HomePageSeeder extends Seeder
{
    private const WA_NUMBER = '6285860145144';

    /**
     * Seed all content displayed on the home page.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@penalangit.id')->first();

        $this->seedHero($admin?->id);
        $this->seedContact();
        $this->seedCompanyProfile();
        $this->seedServices();
        $this->seedBooks();
        $this->seedArticles($admin?->id);
        $this->seedGalleries();
        $this->seedCareers();
        $this->seedFaqs();
    }

    private function seedHero(?int $updatedBy): void
    {
        HeroSetting::updateOrCreate(
            ['id' => 1],
            [
                'headline' => 'Kami Siap Membantu Anda Dalam Menerbitkan Buku',
                'subheadline' => 'Dengan SDM profesional yang akan membantu mendampingi penulis dan mengawal draft buku lebih berkualitas dan layak terbit.',
                'text_color' => '#111827',
                'cta_text' => 'Hubungi Kami',
                'cta_url' => '#kontak',
                'cta_color' => '#002B8F',
                'cta_text_color' => '#ffffff',
                'background_type' => 'color',
                'background_color' => '#ffffff',
                'background_image_path' => null,
                'hero_image_path' => null,
                'layout' => 'left-text-right-image',
                'is_active' => true,
                'updated_by' => $updatedBy,
            ]
        );
    }

    private function seedContact(): void
    {
        ContactSetting::updateOrCreate(
            ['id' => 1],
            [
                'email' => 'info@penalangit.id',
                'phone' => '0858-6014-5144 (WhatsApp)',
                'address' => 'Kaplingan Dsn. Sambong Dukuh, RT. 04 RW. 07, Desa Sambong Dukuh, Kec. Jombang, Kab. Jombang, Jawa Timur, Indonesia',
                'instagram' => 'https://instagram.com/penalangit',
                'facebook' => 'https://facebook.com/penalangit',
                'youtube' => null,
                'tiktok' => null,
                'twitter' => null,
            ]
        );
    }

    private function seedCompanyProfile(): void
    {
        CompanyProfile::updateOrCreate(
            ['id' => 1],
            [
                'ceo_name' => 'AANG FATHUL ISLAM',
                'ceo_title' => 'Direktur Utama',
                'ceo_image_path' => null,
                'vision_mission_description' => 'CV. Azriya Permata Group melalui Pena Langit Publishing berkomitmen menjadi mitra penerbitan yang profesional, amanah, dan berkualitas. Kami mendampingi penulis dari proses editing, desain sampul, legalitas ISBN, hingga distribusi buku ke pembaca di seluruh Indonesia.',
                'quote' => 'Kemerdekaan yang hakiki adalah saat kita bisa mengabadikan gagasan dan pemikiran kita melalui tulisan, karena tulisan akan abadi tak terbatas oleh ruang dan waktu.',
                'books_count' => '500+',
                'authors_count' => '1000+',
                'experience_years' => '5th',
            ]
        );
    }

    private function seedServices(): void
    {
        $packages = [
            [
                'name' => 'Paket Standar',
                'description' => 'Layanan penerbitan lengkap meliputi editing naskah, layout interior, desain sampul, dan cetak buku softcover. Cocok untuk penulis pemula yang ingin menerbitkan karya pertama.',
                'price' => 2500000,
                'duration' => '14–21 hari kerja',
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Premium',
                'description' => 'Semua fasilitas Paket Standar ditambah pendampingan ISBN, legalitas penerbitan, dan konsultasi strategi pemasaran buku hingga siap didistribusikan.',
                'price' => 4500000,
                'duration' => '21–30 hari kerja',
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Cepat Terbit',
                'description' => 'Prioritas proses produksi untuk naskah yang sudah rapi. Ideal bagi penulis yang membutuhkan buku tersedia dalam waktu singkat untuk acara atau peluncuran.',
                'price' => 3500000,
                'duration' => '7–10 hari kerja',
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Konsultasi & Custom',
                'description' => 'Solusi fleksibel sesuai kebutuhan: cetak ulang, hardcover, e-book, atau kolaborasi penerbitan institusi. Tim kami siap merancang paket khusus untuk Anda.',
                'price' => null,
                'duration' => 'Sesuai kesepakatan',
                'is_featured' => true,
            ],
            [
                'name' => 'Editing & Proofreading',
                'description' => 'Layanan perbaikan bahasa, struktur, dan konsistensi naskah tanpa paket cetak. Dapat dipilih terpisah sebelum masuk proses layout.',
                'price' => 750000,
                'duration' => '5–7 hari kerja',
                'is_featured' => false,
            ],
            [
                'name' => 'Desain Sampul',
                'description' => 'Desain sampul profesional dengan revisi terbatas. File siap cetak sesuai standar percetakan mitra Pena Langit.',
                'price' => 500000,
                'duration' => '3–5 hari kerja',
                'is_featured' => false,
            ],
        ];

        foreach ($packages as $package) {
            Service::updateOrCreate(
                ['name' => $package['name']],
                [
                    'description' => $package['description'],
                    'price' => $package['price'],
                    'duration' => $package['duration'],
                    'wa_number' => self::WA_NUMBER,
                    'icon' => null,
                    'is_active' => true,
                    'is_featured' => $package['is_featured'],
                ]
            );
        }
    }

    private function seedBooks(): void
    {
        $books = [
            [
                'slug' => 'menulis-buku-yang-menginspirasi',
                'title' => 'Menulis Buku yang Menginspirasi',
                'author' => 'Dr. Ahmad Fauzi',
                'category' => 'Pengembangan Diri',
                'description' => 'Panduan praktis bagi calon penulis untuk menyusun naskah yang kuat, autentik, dan siap terbit.',
                'price' => 89000,
                'stock' => 50,
                'is_featured' => true,
            ],
            [
                'slug' => 'legenda-nusantara-vol-1',
                'title' => 'Legenda Nusantara Vol. 1',
                'author' => 'Tim Pena Langit',
                'category' => 'Anak & Remaja',
                'description' => 'Kumpulan cerita rakyat dari berbagai daerah Indonesia, disajikan dengan ilustrasi menarik.',
                'price' => 75000,
                'stock' => 80,
                'is_featured' => true,
            ],
            [
                'slug' => 'jombang-bercerita',
                'title' => 'Jombang Bercerita',
                'author' => 'Komunitas Sastra Lokal',
                'category' => 'Sastra',
                'description' => 'Antologi karya sastra penulis lokal Jombang yang mengangkat kearifan dan kehidupan masyarakat.',
                'price' => 65000,
                'stock' => 40,
                'is_featured' => true,
            ],
            [
                'slug' => 'belajar-menulis-sejak-dini',
                'title' => 'Belajar Menulis Sejak Dini',
                'author' => 'Siti Nurhaliza, M.Pd.',
                'category' => 'Pendidikan',
                'description' => 'Buku pegangan guru dan orang tua untuk melatih kemampuan menulis anak usia SD–SMP.',
                'price' => 72000,
                'stock' => 60,
                'is_featured' => true,
            ],
            [
                'slug' => 'kamus-kata-bijak-pemuda',
                'title' => 'Kamus Kata Bijak Pemuda',
                'author' => 'Aang Fathul Islam',
                'category' => 'Motivasi',
                'description' => 'Rangkaian quotes dan refleksi untuk generasi muda yang ingin berkarya melalui tulisan.',
                'price' => 55000,
                'stock' => 35,
                'is_featured' => false,
            ],
            [
                'slug' => 'panduan-isbn-untuk-penulis',
                'title' => 'Panduan ISBN untuk Penulis',
                'author' => 'Tim Redaksi Pena Langit',
                'category' => 'Non-Fiksi',
                'description' => 'Penjelasan langkah demi langkah mengurus ISBN dan legalitas buku di Indonesia.',
                'price' => 68000,
                'stock' => 25,
                'is_featured' => false,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['slug' => $book['slug']],
                [
                    'title' => $book['title'],
                    'author' => $book['author'],
                    'category' => $book['category'],
                    'description' => $book['description'],
                    'price' => $book['price'],
                    'wa_number' => self::WA_NUMBER,
                    'stock' => $book['stock'],
                    'cover_image_path' => null,
                    'pdf_file_path' => null,
                    'is_featured' => $book['is_featured'],
                ]
            );
        }
    }

    private function seedArticles(?int $authorId): void
    {
        if (! $authorId) {
            $this->command?->warn('HomePageSeeder: Admin user tidak ditemukan, artikel dilewati. Jalankan AdminSeeder terlebih dahulu.');

            return;
        }

        $articles = [
            [
                'slug' => 'tips-menerbitkan-buku-pertama',
                'title' => '5 Tips Menerbitkan Buku Pertama Anda',
                'excerpt' => 'Panduan singkat bagi penulis pemula sebelum menyerahkan naskah ke penerbit.',
                'content' => <<<'HTML'
<p>Menerbitkan buku pertama adalah langkah besar. Berikut tips dari tim Pena Langit:</p>
<ol>
<li>Siapkan naskah yang sudah direview minimal satu kali.</li>
<li>Tentukan target pembaca dan genre dengan jelas.</li>
<li>Pilih paket layanan sesuai budget dan tujuan distribusi.</li>
<li>Konsultasikan legalitas ISBN jika buku akan dijual luas.</li>
<li>Rencanakan strategi promosi sejak sebelum buku cetak.</li>
</ol>
<p>Tim kami siap mendampingi dari konsultasi awal hingga buku siap terbit.</p>
HTML,
                'days_ago' => 3,
            ],
            [
                'slug' => 'mengenal-proses-isbn-di-indonesia',
                'title' => 'Mengenal Proses ISBN di Indonesia',
                'excerpt' => 'Apa itu ISBN, mengapa penting, dan bagaimana alur pengajuannya untuk penulis indie.',
                'content' => <<<'HTML'
<p>ISBN (International Standard Book Number) adalah identitas unik setiap judul buku. Buku dengan ISBN lebih mudah didistribusikan ke toko dan platform digital resmi.</p>
<p>Pena Langit Publishing membantu penulis mengurus ISBN melalui paket Premium atau layanan konsultasi terpisah. Proses biasanya membutuhkan data penerbit, judul, dan sinopsis buku yang lengkap.</p>
HTML,
                'days_ago' => 7,
            ],
            [
                'slug' => 'sukses-menjadi-penulis-indie',
                'title' => 'Sukses Menjadi Penulis Indie di Era Digital',
                'excerpt' => 'Strategi membangun personal brand dan menjual buku mandiri tanpa kehilangan kualitas karya.',
                'content' => <<<'HTML'
<p>Penulis indie memiliki kebebasan kreatif lebih besar. Kunci suksesnya: konsistensi menulis, membangun audiens di media sosial, dan memilih mitra penerbit yang transparan.</p>
<p>CV. Azriya Permata Group melalui Pena Langit mendukung penulis dengan layanan editing, desain, cetak, hingga promosi kolaboratif.</p>
HTML,
                'days_ago' => 14,
            ],
            [
                'slug' => 'workshop-menulis-kreatif-2025',
                'title' => 'Laporan Workshop Menulis Kreatif 2025',
                'excerpt' => 'Rangkuman kegiatan workshop bersama komunitas penulis dari Jombang dan sekitarnya.',
                'content' => <<<'HTML'
<p>Pada Februari 2025, Pena Langit menggelar workshop menulis kreatif dengan 40 peserta. Materi meliputi teknik brainstorming, struktur cerita pendek, dan tips mengirim naskah ke penerbit.</p>
<p>Terima kasih kepada seluruh peserta dan mitra yang telah mendukung kegiatan ini.</p>
HTML,
                'days_ago' => 21,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['slug' => $article['slug']],
                [
                    'title' => $article['title'],
                    'excerpt' => $article['excerpt'],
                    'content' => $article['content'],
                    'image_path' => null,
                    'status' => 'published',
                    'author_id' => $authorId,
                    'published_at' => now()->subDays($article['days_ago']),
                ]
            );
        }
    }

    private function seedGalleries(): void
    {
        $items = [
            ['title' => 'Workshop Menulis Kreatif', 'description' => 'Pelatihan menulis untuk komunitas penulis Jombang.'],
            ['title' => 'Peluncuran Buku Legenda Nusantara', 'description' => 'Acara peluncaran buku anak terbitan Pena Langit.'],
            ['title' => 'Kunjungan Komunitas Sastra', 'description' => 'Diskusi bersama penulis lokal dan mahasiswa.'],
            ['title' => 'Pameran Buku Regional', 'description' => 'Stand Pena Langit di pameran literasi Jawa Timur.'],
            ['title' => 'Bedah Buku & Tanda Tangan', 'description' => 'Sesi meet the author bersama pembaca setia.'],
            ['title' => 'Pelatihan Desain Sampul', 'description' => 'Workshop desain untuk penulis dan illustrator pemula.'],
        ];

        foreach ($items as $item) {
            $imagePath = 'galleries/seed-' . Str::slug($item['title']) . '.jpg';

            Gallery::updateOrCreate(
                ['title' => $item['title']],
                [
                    'image_path' => $this->ensurePlaceholderImage($imagePath),
                    'description' => $item['description'],
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedCareers(): void
    {
        $careers = [
            [
                'title' => 'Editor Naskah (Freelance)',
                'location' => 'Jombang, Jawa Timur (Hybrid)',
                'type' => 'Freelance',
                'description' => 'Membantu mengecek bahasa, struktur, dan konsistensi naskah penulis sebelum proses layout. Pengalaman editing minimal 1 tahun.',
                'apply_url' => 'mailto:info@penalangit.id?subject=Lamaran%20Editor%20Naskah',
            ],
            [
                'title' => 'Staff Marketing Digital',
                'location' => 'Jombang, Jawa Timur',
                'type' => 'Full-time',
                'description' => 'Mengelola konten sosial media, iklan digital, dan kampanye promosi buku terbitan Pena Langit. Familiar dengan Instagram, TikTok, dan Meta Ads.',
                'apply_url' => 'mailto:info@penalangit.id?subject=Lamaran%20Marketing%20Digital',
            ],
            [
                'title' => 'Desainer Grafis (Layout & Sampul)',
                'location' => 'Remote / Jombang',
                'type' => 'Part-time',
                'description' => 'Membuat desain sampul dan layout interior buku sesuai brief penulis. Menguasai Adobe InDesign dan Illustrator.',
                'apply_url' => 'mailto:info@penalangit.id?subject=Lamaran%20Desainer%20Grafis',
            ],
            [
                'title' => 'Magang Administrasi Penerbitan',
                'location' => 'Jombang, Jawa Timur',
                'type' => 'Internship',
                'description' => 'Membantu administrasi ISBN, arsip naskah, dan koordinasi percetakan. Cocok untuk mahasiswa semester akhir.',
                'apply_url' => 'mailto:info@penalangit.id?subject=Lamaran%20Magang%20Penerbitan',
            ],
        ];

        foreach ($careers as $career) {
            Career::updateOrCreate(
                ['title' => $career['title']],
                [
                    'location' => $career['location'],
                    'type' => $career['type'],
                    'description' => $career['description'],
                    'apply_url' => $career['apply_url'],
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            [
                'order' => 1,
                'question' => 'Berapa lama proses penerbitan buku?',
                'answer' => "Durasi bergantung paket yang dipilih. Paket Standar biasanya 14–21 hari kerja, Paket Cepat Terbit 7–10 hari kerja setelah naskah dinyatakan siap layout. Waktu dapat berubah jika ada revisi besar dari penulis.",
            ],
            [
                'order' => 2,
                'question' => 'Apakah Pena Langit membantu pengurusan ISBN?',
                'answer' => "Ya. Pengurusan ISBN tersedia pada Paket Premium dan layanan konsultasi terpisah. Tim kami akan memandu kelengkapan dokumen yang dibutuhkan.",
            ],
            [
                'order' => 3,
                'question' => 'Berapa minimal cetak buku?',
                'answer' => "Minimal cetak dapat disesuaikan dengan jenis buku dan budget. Hubungi kami via WhatsApp untuk mendapatkan penawaran resmi sesuai jumlah halaman dan jenis kertas.",
            ],
            [
                'order' => 4,
                'question' => 'Apakah saya tetap memegang hak cipta naskah?',
                'answer' => "Hak cipta tetap milik penulis. Pena Langit berperan sebagai mitra penerbit yang membantu proses produksi dan distribusi sesuai perjanjian kerja sama.",
            ],
            [
                'order' => 5,
                'question' => 'Bagaimana cara memesan layanan atau buku?',
                'answer' => "Untuk layanan, klik tombol PESAN SEKARANG pada kartu paket layanan (WhatsApp). Untuk buku, buka halaman detail buku di Toko Buku atau hubungi nomor WhatsApp yang tertera.",
            ],
            [
                'order' => 6,
                'question' => 'Apakah menerima naskah fiksi dan non-fiksi?',
                'answer' => "Kami menerima berbagai genre: fiksi, non-fiksi, pendidikan, anak, motivasi, dan antologi. Naskah akan melalui tahap review awal sebelum masuk proses kontrak.",
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'order' => $faq['order'],
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * Ensure a minimal placeholder image exists in public storage.
     */
    private function ensurePlaceholderImage(string $relativePath): string
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($relativePath)) {
            $disk->put(
                $relativePath,
                base64_decode(
                    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==',
                    true
                )
            );
        }

        return $relativePath;
    }
}
