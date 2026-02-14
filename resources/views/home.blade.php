@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-white text-gray-800 overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight text-gray-900">
                        Kami Siap Membantu Anda Dalam Menerbitkan Buku
                    </h1>
                    <p class="text-lg md:text-xl mb-8 text-gray-600">
                        Dengan SDM profesional yang akan membantu mendampingi penulis dan mengawal draft buku lebih
                        berkualitas dan layak terbit
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Optional CTA buttons if needed later -->
                    </div>
                </div>
                <!-- Certificate Image -->
                <div class="relative flex justify-center">
                    <img src="https://placehold.co/600x400/f0f9ff/002B8F?text=TANDA+ANGGOTA+IKAPI" alt="Sertifikat IKAPI"
                        class="w-full max-w-lg shadow-lg rounded-lg border border-blue-100">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Alasan Memilih Kami</h2>
                <div class="w-24 h-1 bg-gray-200 mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <!-- Feature 1 -->
                <div class="group">
                    <div
                        class="inline-flex items-center justify-center w-24 h-24 bg-white border border-gray-200 rounded-full mb-6 shadow-sm group-hover:shadow-md transition">
                        <!-- Placeholder for Barcode Icon -->
                        <img src="https://placehold.co/50x50/white/333?text=ISBN" alt="ISBN Icon" class="w-12 h-12">
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Setiap Buku Ber-ISBN</h3>
                    <p class="text-gray-600 text-sm leading-relaxed px-4">
                        Setiap buku yang diterbitkan memiliki ISBN masing-masing. Sehingga buku tersebut telah diakui
                        keberadaannya secara Internasional
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group">
                    <div
                        class="inline-flex items-center justify-center w-24 h-24 bg-white border border-gray-200 rounded-full mb-6 shadow-sm group-hover:shadow-md transition">
                        <!-- Placeholder for Quality Badge -->
                        <img src="https://placehold.co/50x50/white/d97706?text=100%" alt="Quality Icon" class="w-12 h-12">
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Kualitas Terjamin</h3>
                    <p class="text-gray-600 text-sm leading-relaxed px-4">
                        Kami menerapkan standar kualitas yang tinggi dalam operasional dan menjamin kualitas para penulis
                        penerbit penalangit serta menjamin kualitas cetak yang terbaik.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group">
                    <div
                        class="inline-flex items-center justify-center w-24 h-24 bg-white border border-gray-200 rounded-full mb-6 shadow-sm group-hover:shadow-md transition">
                        <!-- Placeholder for Price Stamp -->
                        <img src="https://placehold.co/50x50/white/ef4444?text=PRICE" alt="Price Icon" class="w-12 h-12">
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Biaya Terjangkau</h3>
                    <p class="text-gray-600 text-sm leading-relaxed px-4">
                        Kami memberikan harga layanan dengan paket beragam, terjangkau dan dapat disesuaikan dengan
                        kebutuhan penulis dengan tetap memperhatikan kualitas cetak.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Paket Layanan</h2>
                <p class="text-gray-600">Ragam pilihan layanan solusi penerbitan buku mu!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service 1 -->
                <div
                    class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition flex flex-col items-center">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Penerbitan Buku</h3>
                    <p class="text-gray-600 text-sm mb-8 leading-relaxed flex-grow">
                        Layanan penerbitan buku profesional dengan ISBN resmi, pendampingan penulis, dan standar kualitas
                        nasional.
                    </p>
                    <a href="#"
                        class="inline-block bg-[#002B8F] text-white font-bold text-sm px-6 py-3 rounded-full hover:bg-blue-800 transition mb-4 w-full">
                        PESAN SEKARANG!
                    </a>
                    <a href="#" class="text-gray-500 text-xs underline hover:text-blue-600">
                        Info Detail Disini!
                    </a>
                </div>

                <!-- Service 2 -->
                <div
                    class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition flex flex-col items-center">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Toko Buku</h3>
                    <p class="text-gray-600 text-sm mb-8 leading-relaxed flex-grow">
                        Toko buku offline dan online untuk memasarkan karya penulis agar menjangkau pembaca lebih luas.
                    </p>
                    <a href="#"
                        class="inline-block bg-[#002B8F] text-white font-bold text-sm px-6 py-3 rounded-full hover:bg-blue-800 transition mb-4 w-full">
                        PESAN SEKARANG!
                    </a>
                    <a href="#" class="text-gray-500 text-xs underline hover:text-blue-600">
                        Info Detail Disini!
                    </a>
                </div>

                <!-- Service 3 -->
                <div
                    class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition flex flex-col items-center">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Ruang Tulisan</h3>
                    <p class="text-gray-600 text-sm mb-8 leading-relaxed flex-grow">
                        Wadah publikasi artikel dan tulisan bagi penulis melalui kurasi redaksi profesional.
                    </p>
                    <a href="#"
                        class="inline-block bg-[#002B8F] text-white font-bold text-sm px-6 py-3 rounded-full hover:bg-blue-800 transition mb-4 w-full">
                        PESAN SEKARANG!
                    </a>
                    <a href="#" class="text-gray-500 text-xs underline hover:text-blue-600">
                        Info Detail Disini!
                    </a>
                </div>

                <!-- Service 4 -->
                <div
                    class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition flex flex-col items-center">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Jurnal Ilmiah</h3>
                    <p class="text-gray-600 text-sm mb-8 leading-relaxed flex-grow">
                        Layanan pengelolaan jurnal ilmiah nasional untuk mendukung publikasi akademik dan penelitian.
                    </p>
                    <a href="#"
                        class="inline-block bg-[#002B8F] text-white font-bold text-sm px-6 py-3 rounded-full hover:bg-blue-800 transition mb-4 w-full">
                        PESAN SEKARANG!
                    </a>
                    <a href="#" class="text-gray-500 text-xs underline hover:text-blue-600">
                        Info Detail Disini!
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Client Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide mb-2">OUR CLIENT</h2>
            <p class="text-gray-500 mb-12">Beberapa klien yang telah bekerja sama dengan kami</p>

            <div
                class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-75 grayscale hover:grayscale-0 transition-all duration-500">
                <!-- Client Logos Placeholders -->
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/80x80/transparent/green?text=UM" alt="Universitas Muhammadiyah"
                        class="h-20 w-auto mb-2">
                    <span class="text-xs text-gray-500">Universitas<br>Muhammadiyah...</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/80x80/transparent/blue?text=UM" alt="Universitas Muhammadiyah"
                        class="h-20 w-auto mb-2">
                    <span class="text-xs text-gray-500">Universitas<br>Muhammadiyah...</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/80x80/transparent/purple?text=MTsN" alt="MTsN 9 Jombang"
                        class="h-20 w-auto mb-2">
                    <span class="text-xs text-gray-500">MTsN 9 Jombang</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/80x80/transparent/teal?text=MAN" alt="MAN 5 Jombang"
                        class="h-20 w-auto mb-2">
                    <span class="text-xs text-gray-500">MAN 5 Jombang</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/80x80/transparent/red?text=STKIP" alt="STKIP PGRI Pacitan"
                        class="h-20 w-auto mb-2">
                    <span class="text-xs text-gray-500">STKIP PGRI<br>Pacitan</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/80x80/transparent/green?text=STKIP" alt="STKIP PGRI Ponorogo"
                        class="h-20 w-auto mb-2">
                    <span class="text-xs text-gray-500">STKIP PGRI<br>Ponorogo</span>
                </div>
            </div>

            <!-- Pagination Dots -->
            <div class="flex justify-center space-x-2 mt-12">
                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
            </div>
        </div>
    </section>

    <!-- CEO Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- CEO Image -->
                <div class="w-full md:w-1/3 relative">
                    <!-- Dots Pattern Background -->
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
                            <p class="text-xs uppercase opacity-80">Direktur Utama Pena Langit Publishing</p>
                        </div>
                    </div>
                </div>

                <!-- Quote Content -->
                <div class="w-full md:w-2/3">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">CEO Pena Langit Publishing</h2>
                    <blockquote class="text-xl md:text-2xl text-gray-600 leading-relaxed mb-6">
                        “Kemerdekaan yang hakiki adalah saat kita bisa mengabadikan gagasan dan pemikiran kita melalui
                        tulisan, karena tulisan akan abadi tak terbatas oleh ruang dan waktu.”
                    </blockquote>
                    <p class="text-lg font-semibold text-gray-900">
                        Aang Fathul Islam – Ceo Pena Langit Publishing
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Articles/News Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">BERITA</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Article 1 -->
                <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://placehold.co/400x500/e2e8f0/64748b?text=BERITA+1" alt="Article"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-4 h-0.5 bg-blue-500"></span>
                            <span class="text-xs font-bold text-blue-500 uppercase tracking-wider">BERITA</span>
                        </div>
                        <h3
                            class="text-xl font-bold mb-3 text-gray-900 group-hover:text-blue-600 transition leading-tight">
                            Sosok Perempuan Inspiratif: Prof. Dra. Munawaroh, M.Kes dan Kepemimpinan yang...
                        </h3>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://placehold.co/400x500/e2e8f0/64748b?text=BERITA+2" alt="Article"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-4 h-0.5 bg-blue-500"></span>
                            <span class="text-xs font-bold text-blue-500 uppercase tracking-wider">BERITA</span>
                        </div>
                        <h3
                            class="text-xl font-bold mb-3 text-gray-900 group-hover:text-blue-600 transition leading-tight">
                            Menjaga Bahasa, Merawat Budaya: Jejak Inspiratif Dr. Susi Darihastining, M.Pd.
                        </h3>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://placehold.co/400x500/e2e8f0/64748b?text=BERITA+3" alt="Article"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-4 h-0.5 bg-blue-500"></span>
                            <span class="text-xs font-bold text-blue-500 uppercase tracking-wider">BERITA</span>
                        </div>
                        <h3
                            class="text-xl font-bold mb-3 text-gray-900 group-hover:text-blue-600 transition leading-tight">
                            Dari Ruang Kelas ke Dunia: Dr. Rukminingsih, Sosok Inspiratif Revolusi Pendidikan Bahasa
                        </h3>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
