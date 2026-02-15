@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Karir</h1>
            <p class="text-gray-600">Bergabunglah bersama tim Pena Langit Publishing.</p>
        </div>

        @if($careers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($careers as $career)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 border border-gray-100 flex flex-col h-full">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full uppercase tracking-wider mb-2">
                                    {{ $career->type }}
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 line-clamp-2">{{ $career->title }}</h3>
                            </div>
                        </div>
                        
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $career->location }}
                        </div>

                        <div class="text-gray-600 text-sm mb-6 flex-grow">
                            {!! $career->description !!}
                        </div>

                        <a href="{{ $career->apply_url }}" target="_blank" class="block w-full text-center bg-white border border-blue-600 text-blue-600 font-bold py-2 rounded-lg hover:bg-blue-600 hover:text-white transition">
                            LAMAR SEKARANG
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 p-8 text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada lowongan dibuka</h3>
                <p class="text-gray-600 mb-6">
                    Saat ini kami belum membuka lowongan pekerjaan baru. Pantau terus website dan sosial media kami untuk informasi terbaru.
                </p>
                <a href="https://linkedin.com" target="_blank" class="text-blue-600 font-semibold hover:underline">Lihat di LinkedIn &rarr;</a>
            </div>
        @endif
    </div>
</div>
@endsection
