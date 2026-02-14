@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Toko Buku</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Temukan koleksi buku terbaik dari Pena Langit Publishing.
            </p>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-10">
            <form action="{{ route('toko') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, penulis..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <select name="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach(['Fiksi', 'Non-Fiksi', 'Pendidikan', 'Anak', 'Agama', 'Sastra', 'Umum'] as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Cari Buku
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($books as $book)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition border border-gray-100 flex flex-col h-full group">
                    <div class="relative aspect-[3/4] overflow-hidden bg-gray-100">
                        @if($book->cover_image_path)
                            <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                        @endif
                        @if($book->is_featured)
                            <div class="absolute top-2 right-2">
                                <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded shadow-sm">
                                    Best Seller
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="text-xs text-blue-600 font-semibold mb-1 uppercase tracking-wide">{{ $book->category }}</div>
                        <h3 class="font-bold text-gray-900 mb-1 leading-tight line-clamp-2">
                            <a href="{{ route('book.show', $book->slug) }}" class="hover:text-blue-600 transition">{{ $book->title }}</a>
                        </h3>
                        <p class="text-sm text-gray-500 mb-3">{{ $book->author }}</p>
                        
                        <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('book.show', $book->slug) }}" class="mt-3 block w-full text-center border border-blue-600 text-blue-600 font-semibold text-sm py-2 rounded-lg hover:bg-blue-600 hover:text-white transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Buku tidak ditemukan</h3>
                    <p class="text-gray-500 mt-2">Coba kata kunci lain atau kategori yang berbeda.</p>
                    <a href="{{ route('toko') }}" class="inline-block mt-4 text-blue-600 font-medium hover:underline">Reset Pencarian</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
