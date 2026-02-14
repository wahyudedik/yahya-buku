@extends('layouts.frontend')

@section('content')
<div class="py-16 bg-white min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-gray-500">
                <a href="/" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('ruang-tulisan') }}" class="hover:text-blue-600">Ruang Tulisan</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ Str::limit($article->title, 30) }}</span>
            </div>

            <!-- Article Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $article->title }}
                </h1>
                
                <div class="flex items-center text-gray-500 text-sm gap-4">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ $article->author->name ?? 'Admin' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                    </span>
                </div>
            </div>

            <!-- Featured Image -->
            @if($article->image_path)
                <div class="mb-10 rounded-xl overflow-hidden shadow-sm">
                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover">
                </div>
            @endif

            <!-- Article Content -->
            <article class="prose prose-lg prose-blue max-w-none text-gray-700">
                {!! nl2br(e($article->content)) !!}
            </article>

            <!-- Share / Tags (Optional) -->
            <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between items-center">
                <a href="{{ route('ruang-tulisan') }}" class="text-blue-600 font-medium hover:underline flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Ruang Tulisan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection