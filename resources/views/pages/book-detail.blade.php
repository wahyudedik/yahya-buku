@extends('layouts.frontend')

@section('content')
<div class="py-16 bg-white min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <div class="mb-8 text-sm text-gray-500">
                <a href="/" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('toko') }}" class="hover:text-blue-600">Toko Buku</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">{{ Str::limit($book->title, 40) }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                <!-- Book Cover -->
                <div class="md:col-span-4 lg:col-span-4">
                    <div class="bg-gray-100 rounded-2xl overflow-hidden shadow-sm border border-gray-100 sticky top-24">
                        @if($book->cover_image_path)
                            <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{ $book->title }}" class="w-full h-auto object-cover">
                        @else
                            <div class="aspect-[3/4] flex items-center justify-center text-gray-400">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Book Details -->
                <div class="md:col-span-8 lg:col-span-8">
                    <div class="mb-6">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-wider">
                            {{ $book->category }}
                        </span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 leading-tight">
                            {{ $book->title }}
                        </h1>
                        <p class="text-lg text-gray-600">Oleh <span class="font-semibold text-gray-900">{{ $book->author }}</span></p>
                    </div>

                    <div class="flex items-end gap-4 mb-8 pb-8 border-b border-gray-100">
                        <div class="text-4xl font-bold text-blue-600">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500 mb-2">
                            Stok: <span class="{{ $book->stock > 0 ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}">{{ $book->stock > 0 ? 'Tersedia (' . $book->stock . ')' : 'Habis' }}</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Deskripsi Buku</h3>
                        <div class="prose prose-blue text-gray-600 leading-relaxed">
                            {!! nl2br(e($book->description)) !!}
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        @php
                            $waNumber = $book->wa_number ?? '6285860145144';
                            $message = "Halo Admin Pena Langit, saya ingin membeli buku *{$book->title}* seharga Rp " . number_format($book->price, 0, ',', '.');
                            $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);
                        @endphp
                        
                        <a href="{{ $waLink }}" target="_blank" class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center font-bold py-4 rounded-xl transition shadow-lg shadow-green-200 flex items-center justify-center gap-2" style="background-color: #25D366; color: white;">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            Beli via WhatsApp
                        </a>
                        
                        @if($book->pdf_file_path)
                            <a href="{{ asset('storage/' . $book->pdf_file_path) }}" target="_blank" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center font-bold py-4 rounded-xl transition flex items-center justify-center gap-2 border border-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Lihat Preview (PDF)
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection