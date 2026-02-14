<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pena Langit') }}</title>

        @php
            $branding = \App\Models\BrandingSetting::query()->first();
            $v = $branding?->cache_bust_token;
        @endphp

        @if(($branding?->favicon_enabled ?? true) && $branding?->favicon_path)
            <link rel="icon" href="{{ asset('storage/'.$branding->favicon_path).($v ? '?v='.$v : '') }}">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/" class="flex flex-col items-center">
                    @if($branding?->logo_path)
                        <img src="{{ asset('storage/'.$branding->logo_path).($v ? '?v='.$v : '') }}"
                             alt="Logo"
                             class="mb-4 object-contain"
                             style="{{ $branding?->logo_width ? 'width:'.$branding->logo_width.'px;' : 'width: 80px;' }}{{ $branding?->logo_height ? 'height:'.$branding->logo_height.'px;' : '' }}"
                        />
                    @else
                        <div class="bg-white p-3 rounded-lg shadow-sm inline-block mb-2">
                             <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                        </div>
                        <span class="text-2xl font-bold text-blue-600">Pena Langit</span>
                    @endif
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg rounded-xl border border-gray-100">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Pena Langit Publishing. All rights reserved.
            </div>
        </div>
    </body>
</html>
