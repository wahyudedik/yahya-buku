@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Ruang Tulisan</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Kumpulan artikel inspiratif, berita terkini, dan wawasan menarik dari dunia literasi Pena Langit.
            </p>
        </div>

        <!-- Search & Filter -->
        <div class="mb-10 max-w-xl mx-auto">
            <form action="{{ route('ruang-tulisan') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..." class="w-full rounded-full border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-6 py-3">
                <button type="submit" class="bg-blue-600 text-white rounded-full px-6 hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $query = \App\Models\Article::where('status', 'published');
                if(request('search')) {
                    $query->where(function($q) {
                        $q->where('title', 'like', '%' . request('search') . '%')
                          ->orWhere('content', 'like', '%' . request('search') . '%');
                    });
                }
                $articles = $query->latest()->paginate(9);
            @endphp

            @forelse($articles as $article)
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition flex flex-col h-full">
                    <div class="relative h-56 overflow-hidden">
                        @if($article->image_path)
                            <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                ARTIKEL
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="text-xs text-gray-500 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 line-clamp-2 hover:text-blue-600 transition">
                            <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="text-gray-600 mb-6 line-clamp-3 text-sm flex-grow leading-relaxed">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                        </p>
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                                    {{ substr($article->author->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="text-xs text-gray-600 font-medium">{{ $article->author->name ?? 'Admin' }}</span>
                            </div>
                            <a href="{{ route('article.show', $article->slug) }}" class="text-blue-600 font-bold text-sm hover:underline flex items-center gap-1">
                                Baca <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Artikel tidak ditemukan</h3>
                    <p class="text-gray-500 mt-2">Maaf, kami tidak dapat menemukan artikel yang Anda cari.</p>
                    <a href="{{ route('ruang-tulisan') }}" class="inline-block mt-4 text-blue-600 font-medium hover:underline">Lihat Semua Artikel</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
