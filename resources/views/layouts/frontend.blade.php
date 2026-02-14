<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pena Langit') }}</title>
    @php
        $branding = \App\Models\BrandingSetting::query()->first();
        $v = $branding?->cache_bust_token;
    @endphp
    @if (($branding?->favicon_enabled ?? true) && $branding?->favicon_path)
        <link rel="icon" href="{{ asset('storage/' . $branding->favicon_path) . ($v ? '?v=' . $v : '') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-800 bg-white" x-data="{ mobileMenuOpen: false }">

    <!-- Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600 flex items-center">
                        @if ($branding?->logo_path)
                            <img src="{{ asset('storage/' . $branding->logo_path) . ($v ? '?v=' . $v : '') }}" alt="Logo"
                                style="{{ $branding?->logo_width ? 'width:' . $branding->logo_width . 'px;' : '' }}{{ $branding?->logo_height ? 'height:' . $branding->logo_height . 'px;' : '' }}"
                                class="object-contain" />
                        @else
                            <span>Pena Langit</span>
                        @endif
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav
                    class="hidden md:flex space-x-6 items-center {{ ($branding?->logo_position ?? 'left') === 'center' ? 'mx-auto' : (($branding?->logo_position ?? 'left') === 'right' ? 'ms-auto' : '') }}">
                    <a href="/" class="text-gray-600 hover:text-blue-600 text-sm font-medium">Home</a>
                    <a href="{{ route('ruang-tulisan') }}"
                        class="text-gray-600 hover:text-blue-600 text-sm font-medium">Ruang Tulisan</a>
                    <a href="{{ route('layanan') }}"
                        class="text-gray-600 hover:text-blue-600 text-sm font-medium">Layanan</a>
                    <a href="{{ route('toko') }}" class="text-gray-600 hover:text-blue-600 text-sm font-medium">Toko</a>
                    <a href="{{ route('kontak') }}"
                        class="text-gray-600 hover:text-blue-600 text-sm font-medium">Kontak</a>
                    <a href="{{ route('profil') }}"
                        class="text-gray-600 hover:text-blue-600 text-sm font-medium">Profil</a>

                    <!-- Lainnya Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                            class="text-gray-600 hover:text-blue-600 text-sm font-medium flex items-center">
                            Lainnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100"
                            style="display: none;">
                            <a href="{{ route('galeri') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Galeri</a>
                            <a href="{{ route('karir') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Karir</a>
                            <a href="{{ route('faq') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">FAQ</a>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4 ml-4 border-l pl-4">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-gray-600 hover:text-blue-600 px-3 py-2 text-sm font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-gray-600 hover:text-blue-600 px-3 py-2 text-sm font-medium">Log in</a>
                                {{-- @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium transition">Register</a>
                                @endif --}}
                            @endauth
                        </div>
                    @endif
                </nav>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                        aria-label="Toggle menu">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" class="md:hidden border-t border-gray-100" style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white">
                <a href="/"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Home</a>
                <a href="{{ route('ruang-tulisan') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Ruang
                    Tulisan</a>
                <a href="{{ route('layanan') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Layanan</a>
                <a href="{{ route('toko') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Toko</a>
                <a href="{{ route('kontak') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Kontak</a>
                <a href="{{ route('profil') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Profil</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Lainnya</a>

                @if (Route::has('login'))
                    <div class="border-t border-gray-200 pt-4 mt-4 pb-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Log
                                in</a>
                            {{-- @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Register</a>
                            @endif --}}
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#002B8F] text-white pt-16 pb-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Brand -->
                <div class="text-center md:text-left">
                    <div class="bg-white p-4 rounded-lg inline-block mb-4">
                        <span class="text-blue-700 font-bold text-xl flex flex-col items-center">
                            <!-- Placeholder for Logo Image -->
                            <svg class="w-8 h-8 mb-1" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                            </svg>
                            Pena Langit
                            <span class="text-[10px] uppercase tracking-wider text-gray-500">Publishing</span>
                        </span>
                    </div>
                    <div class="flex justify-center md:justify-start">
                        <a href="#" class="text-white hover:text-blue-200">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Tentang Kami -->
                <div>
                    <h4 class="text-xl font-bold mb-6">Tentang Kami</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-blue-100 hover:text-white text-base">Pena Langit</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white text-base">Publikasi
                                Terpercaya</a>
                        </li>
                    </ul>
                </div>

                <!-- Link Terkait -->
                <div>
                    <h4 class="text-xl font-bold mb-6">Link Terkait</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-blue-100 hover:text-white text-base">Nusacomtech</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white text-base">ringincontong.com</a>
                        </li>
                        <li><a href="#" class="text-blue-100 hover:text-white text-base">Info Jombang</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white text-base">Kejar id</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white text-base">skul id</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-xl font-bold mb-6">Contact Info</h4>
                    <p class="text-blue-100 mb-4 leading-relaxed">
                        Kaplingan Dsn. Sambong Dukuh, RT. 04. RW. 07, DS. Sambong Dukuh Kec. Jombang Kab. Jombang Prov.
                        Jawa Timur Indonesia
                    </p>
                    <p class="text-blue-100">085860145144</p>
                </div>
            </div>

            <div class="pt-8 text-center text-blue-200 text-sm">
                <p>&copy; 2026 PT. Nusatama Jaya Sakti . All Right Reserved</p>
            </div>
        </div>
    </footer>

</body>

</html>
