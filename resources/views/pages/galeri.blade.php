@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Galeri Kegiatan</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Dokumentasi aktivitas, acara, dan momen berharga Pena Langit Publishing.
            </p>
        </div>

        @php
            $galleries = \App\Models\Gallery::where('is_active', true)->latest()->paginate(12);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galleries as $gallery)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-md transition">
                    <div class="aspect-square relative overflow-hidden">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @if($gallery->title)
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                                <h3 class="text-white font-bold text-lg">{{ $gallery->title }}</h3>
                            </div>
                        @endif
                    </div>
                    @if($gallery->description)
                        <div class="p-4">
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $gallery->description }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada galeri</h3>
                    <p class="text-gray-500 mt-1">Galeri kegiatan akan segera ditambahkan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </div>
</div>
@endsection
