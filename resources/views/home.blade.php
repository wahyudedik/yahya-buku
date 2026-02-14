@extends('layouts.frontend')

@section('content')
    @php
        $hero = \App\Models\HeroSetting::first();
        $headline = $hero->headline ?? 'Kami Siap Membantu Anda Dalam Menerbitkan Buku';
        $subheadline = $hero->subheadline ?? 'Dengan SDM profesional yang akan membantu mendampingi penulis dan mengawal draft buku lebih berkualitas dan layak terbit';
        $ctaText = $hero->cta_text ?? 'Hubungi Kami';
        $ctaUrl = $hero->cta_url ?? '#kontak';
        $ctaColor = $hero->cta_color ?? '#002B8F';
        $ctaTextColor = $hero->cta_text_color ?? '#ffffff';
        $textColor = $hero->text_color ?? '#111827';
        $bgType = $hero->background_type ?? 'color';
        $bgColor = $hero->background_color ?? '#ffffff';
        $bgImage = $hero->background_image_path ? asset('storage/'.$hero->background_image_path) : null;
        $heroImage = $hero->hero_image_path ? asset('storage/'.$hero->hero_image_path) : 'https://placehold.co/600x400/f0f9ff/002B8F?text=TANDA+ANGGOTA+IKAPI';
        $layout = $hero->layout ?? 'left-text-right-image';
        $isActive = $hero->is_active ?? true;
    @endphp

    @if($isActive)
    <!-- Hero Section (Home) -->
    <section id="home" class="relative overflow-hidden" 
             style="background-color: {{ $bgType === 'color' ? $bgColor : 'transparent' }};
                    @if($bgType === 'image' && $bgImage) background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; @endif">
        
        <!-- Overlay for better text readability if BG is image -->
        @if($bgType === 'image')
            <div class="absolute inset-0 bg-white/80"></div>
        @endif

        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid gap-12 items-center 
                {{ $layout === 'center-text' ? 'grid-cols-1 text-center' : 'grid-cols-1 lg:grid-cols-2' }}
                {{ $layout === 'right-text-left-image' ? 'lg:flex-row-reverse' : '' }}">
                
                <!-- Text Column -->
                <div class="{{ $layout === 'center-text' ? 'mx-auto max-w-3xl' : ($layout === 'right-text-left-image' ? 'order-2 lg:text-right' : 'lg:text-left text-center') }}">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight" style="color: {{ $textColor }}">
                        {{ $headline }}
                    </h1>
                    <p class="text-lg md:text-xl mb-8 opacity-90" style="color: {{ $textColor }}">
                        {{ $subheadline }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 {{ $layout === 'center-text' ? 'justify-center' : ($layout === 'right-text-left-image' ? 'justify-center lg:justify-end' : 'justify-center lg:justify-start') }}">
                        @if($ctaText)
                            <a href="{{ $ctaUrl }}" class="inline-block font-bold text-sm px-8 py-4 rounded-full shadow-lg hover:opacity-90 transition transform hover:-translate-y-1"
                               style="background-color: {{ $ctaColor }}; color: {{ $ctaTextColor }}">
                                {{ $ctaText }}
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Image Column (Hidden if Center Text layout, unless we want it below) -->
                @if($layout !== 'center-text')
                    <div class="relative flex justify-center {{ $layout === 'right-text-left-image' ? 'order-1' : '' }}">
                        <img src="{{ $heroImage }}" alt="Hero Image"
                            class="w-full max-w-lg shadow-lg rounded-lg border border-blue-100 transform hover:scale-105 transition duration-500">
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Ruang Tulisan Section -->
    <section id="ruang-tulisan" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">RUANG TULISAN</h2>
                <p class="text-gray-600 mt-2">Kumpulan artikel dan berita terkini dari Pena Langit</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $latestArticles = \App\Models\Article::where('status', 'published')->latest()->take(3)->get();
                @endphp

                @forelse($latestArticles as $article)
                    <!-- Article Item -->
                    <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                        <div class="relative h-64 overflow-hidden">
                            @if($article->image_path)
                                <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-4 h-0.5 bg-blue-500"></span>
                                <span class="text-xs font-bold text-blue-500 uppercase tracking-wider">
                                    {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-blue-600 transition leading-tight line-clamp-2">
                                <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
                            </h3>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">
                        Belum ada artikel terbaru.
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-10">
                <a href="{{ route('ruang-tulisan') }}" class="inline-block border-2 border-blue-600 text-blue-600 font-bold text-sm px-8 py-3 rounded-full hover:bg-blue-600 hover:text-white transition duration-300">
                    LIHAT SEMUA TULISAN
                </a>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Paket Layanan</h2>
                <p class="text-gray-600">Ragam pilihan layanan solusi penerbitan buku mu!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $services = \App\Models\Service::where('is_active', true)
                        ->where('is_featured', true)
                        ->take(4)
                        ->get();
                @endphp

                @forelse($services as $service)
                    <div class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition flex flex-col items-center border border-gray-100 h-full">
                        <div class="mb-4 h-16 flex items-center justify-center">
                            @if($service->icon)
                                <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}" class="h-14 w-14 object-contain">
                            @else
                                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                            @endif
                        </div>
                        
                        <h3 class="text-xl font-bold mb-2 text-gray-900">{{ $service->name }}</h3>
                        
                        @if($service->price)
                            <p class="text-blue-600 font-bold mb-2">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                        @endif

                        <p class="text-gray-600 text-sm mb-6 leading-relaxed flex-grow line-clamp-3">
                            {{ Str::limit($service->description, 100) }}
                        </p>
                        
                        @php
                            $waNumber = $service->wa_number ?? '6285860145144'; // Use service WA or default
                            $message = "Halo Admin Pena Langit, saya tertarik dengan layanan *{$service->name}*";
                            if($service->price) $message .= " seharga Rp " . number_format($service->price, 0, ',', '.');
                            $message .= ". Mohon info lebih lanjut.";
                            $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);
                        @endphp

                        <a href="{{ $waLink }}" target="_blank" class="inline-block bg-[#002B8F] text-white font-bold text-sm px-6 py-3 rounded-full hover:bg-blue-800 transition w-full">
                            PESAN SEKARANG!
                        </a>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-8 text-gray-500">
                        Belum ada layanan unggulan ditampilkan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Toko Section -->
    <section id="toko" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Toko Buku</h2>
                <p class="text-gray-600">Koleksi buku terbaik terbitan Pena Langit</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $featuredBooks = \App\Models\Book::where('is_featured', true)->latest()->take(4)->get();
                    if ($featuredBooks->isEmpty()) {
                        $featuredBooks = \App\Models\Book::latest()->take(4)->get();
                    }
                @endphp

                @forelse($featuredBooks as $book)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition flex flex-col h-full group">
                        <div class="aspect-[3/4] bg-gray-200 w-full relative overflow-hidden">
                            @if($book->cover_image_path)
                                <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="font-bold text-gray-900 mb-1 line-clamp-2 leading-tight">
                                <a href="{{ route('book.show', $book->slug) }}" class="hover:text-blue-600 transition">{{ $book->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500 mb-2">{{ $book->author }}</p>
                            <div class="mt-auto">
                                <p class="text-blue-600 font-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 text-gray-500">
                        Belum ada buku yang ditampilkan.
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('toko') }}" class="inline-block border border-[#002B8F] text-[#002B8F] font-bold text-sm px-8 py-3 rounded-full hover:bg-blue-50 transition">
                    LIHAT SEMUA BUKU
                </a>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Hubungi Kami</h2>
                    <p class="text-gray-600 mb-8">
                        Punya pertanyaan seputar penerbitan buku atau layanan kami lainnya? 
                        Jangan ragu untuk menghubungi tim kami.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-bold text-gray-900 uppercase">Alamat</h4>
                                <p class="text-gray-600">Kaplingan Dsn. Sambong Dukuh, Jombang</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-bold text-gray-900 uppercase">Telepon / WhatsApp</h4>
                                <p class="text-gray-600">085860145144</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100">
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="button" class="w-full bg-[#002B8F] text-white font-bold py-3 rounded-md hover:bg-blue-800 transition">
                            KIRIM PESAN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Section -->
    <section id="profil" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Profil Kami</h2>
                <p class="text-gray-600">Mengenal lebih dekat Pena Langit Publishing</p>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- CEO Image (Moved from removed section) -->
                <div class="w-full md:w-1/3 relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 grid grid-cols-6 gap-1 z-0 text-blue-100">
                        @for ($i = 0; $i < 36; $i++)
                            <div class="w-1.5 h-1.5 rounded-full bg-current"></div>
                        @endfor
                    </div>
                    <div class="relative z-10 bg-gradient-to-b from-transparent to-blue-900 rounded-lg overflow-hidden">
                        <img src="https://placehold.co/400x500/002B8F/ffffff?text=Aang+Fathul+Islam" alt="CEO Pena Langit"
                            class="w-full h-auto object-cover">
                        <div class="absolute bottom-0 left-0 w-full p-4 text-center text-white bg-blue-900/80">
                            <h3 class="font-bold text-lg">AANG FATHUL ISLAM</h3>
                            <p class="text-xs uppercase opacity-80">Direktur Utama</p>
                        </div>
                    </div>
                </div>

                <!-- Quote Content -->
                <div class="w-full md:w-2/3">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi & Misi</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Menjadi penerbit buku yang profesional, amanah, dan berkualitas untuk mencerdaskan kehidupan bangsa melalui literasi. 
                        Kami berkomitmen memberikan layanan terbaik bagi penulis dan pembaca di seluruh Indonesia.
                    </p>
                    
                    <blockquote class="text-xl text-gray-600 italic border-l-4 border-blue-500 pl-4 mb-6">
                        “Kemerdekaan yang hakiki adalah saat kita bisa mengabadikan gagasan dan pemikiran kita melalui
                        tulisan, karena tulisan akan abadi tak terbatas oleh ruang dan waktu.”
                    </blockquote>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h4 class="font-bold text-blue-600 text-2xl mb-1">500+</h4>
                            <p class="text-xs text-gray-500 uppercase">Judul Buku</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h4 class="font-bold text-blue-600 text-2xl mb-1">1000+</h4>
                            <p class="text-xs text-gray-500 uppercase">Penulis</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h4 class="font-bold text-blue-600 text-2xl mb-1">5th</h4>
                            <p class="text-xs text-gray-500 uppercase">Pengalaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Galeri Kegiatan</h2>
                <p class="text-gray-600">Dokumentasi aktivitas dan event kami</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="col-span-2 row-span-2 relative group overflow-hidden rounded-xl">
                    <img src="https://placehold.co/600x600/e2e8f0/64748b?text=Event+Utama" alt="Galeri 1" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <span class="text-white font-bold">Peluncuran Buku</span>
                    </div>
                </div>
                <div class="relative group overflow-hidden rounded-xl">
                    <img src="https://placehold.co/300x300/e2e8f0/64748b?text=Galeri+2" alt="Galeri 2" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                </div>
                <div class="relative group overflow-hidden rounded-xl">
                    <img src="https://placehold.co/300x300/e2e8f0/64748b?text=Galeri+3" alt="Galeri 3" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                </div>
                <div class="relative group overflow-hidden rounded-xl">
                    <img src="https://placehold.co/300x300/e2e8f0/64748b?text=Galeri+4" alt="Galeri 4" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                </div>
                <div class="relative group overflow-hidden rounded-xl">
                    <img src="https://placehold.co/300x300/e2e8f0/64748b?text=Galeri+5" alt="Galeri 5" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                </div>
            </div>
        </div>
    </section>

    <!-- Karir Section -->
    <section id="karir" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Karir</h2>
                <p class="text-gray-600">Bergabunglah bersama tim hebat kami</p>
            </div>
            
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 p-8 text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada lowongan dibuka</h3>
                <p class="text-gray-600 mb-6">
                    Saat ini kami belum membuka lowongan pekerjaan baru. Pantau terus website dan sosial media kami untuk informasi terbaru.
                </p>
                <button class="text-blue-600 font-semibold hover:underline">Lihat di LinkedIn &rarr;</button>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">FAQ</h2>
                <p class="text-gray-600">Pertanyaan yang sering diajukan</p>
            </div>
            
            <div class="max-w-3xl mx-auto space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition text-left">
                        <span class="font-medium text-gray-900">Berapa lama proses penerbitan buku?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="p-4 bg-white text-gray-600 text-sm leading-relaxed border-t border-gray-200">
                        Proses penerbitan buku bervariasi tergantung paket yang dipilih, rata-rata memakan waktu 1-3 bulan mulai dari layout, desain cover, hingga pengurusan ISBN dan cetak.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition text-left">
                        <span class="font-medium text-gray-900">Apakah penulis mendapatkan royalti?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="p-4 bg-white text-gray-600 text-sm leading-relaxed border-t border-gray-200">
                        Ya, penulis akan mendapatkan royalti dari setiap penjualan buku sesuai dengan kesepakatan dalam surat perjanjian penerbitan.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition text-left">
                        <span class="font-medium text-gray-900">Bagaimana cara mengirimkan naskah?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="p-4 bg-white text-gray-600 text-sm leading-relaxed border-t border-gray-200">
                        Naskah dapat dikirimkan melalui email redaksi kami atau melalui formulir pengiriman naskah di halaman Layanan. Pastikan naskah sudah rapi dan sesuai format yang ditentukan.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
