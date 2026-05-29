<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ url('/') }}" target="_blank"
                class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                Lihat Website
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Welcome --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-50 rounded-full text-blue-600 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Selamat datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-gray-600 text-sm">Kelola konten Pena Langit dari panel ini.</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 sm:text-right">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.articles.index') }}"
                    class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Artikel</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1 group-hover:text-blue-600">
                        {{ $stats['articles_published'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">terbit · {{ $stats['articles_draft'] }} draft</p>
                </a>
                <a href="{{ route('admin.books.index') }}"
                    class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Buku</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1 group-hover:text-blue-600">{{ $stats['books'] }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">di toko</p>
                </a>
                <a href="{{ route('admin.services.index') }}"
                    class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Layanan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1 group-hover:text-blue-600">
                        {{ $stats['services'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">aktif</p>
                </a>
                <a href="{{ route('admin.contact.messages.index') }}"
                    class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Pesan</p>
                    <p class="text-3xl font-bold {{ $stats['messages_unread'] > 0 ? 'text-blue-600' : 'text-gray-900' }} mt-1">
                        {{ $stats['messages_unread'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">belum dibaca</p>
                </a>
            </div>

            {{-- Quick actions --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    <a href="{{ route('admin.articles.create') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition text-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-xs font-semibold">Tulis Artikel</span>
                    </a>
                    <a href="{{ route('admin.books.create') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-lg bg-gray-50 text-gray-700 hover:bg-gray-100 transition text-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="text-xs font-semibold">Tambah Buku</span>
                    </a>
                    <a href="{{ route('admin.services.create') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-lg bg-gray-50 text-gray-700 hover:bg-gray-100 transition text-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span class="text-xs font-semibold">Tambah Layanan</span>
                    </a>
                    <a href="{{ route('admin.galleries.create') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-lg bg-gray-50 text-gray-700 hover:bg-gray-100 transition text-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-semibold">Upload Galeri</span>
                    </a>
                    <a href="{{ route('admin.hero.show') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-lg bg-gray-50 text-gray-700 hover:bg-gray-100 transition text-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                        <span class="text-xs font-semibold">Atur Hero</span>
                    </a>
                    <a href="{{ route('admin.contact.settings.show') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-lg bg-gray-50 text-gray-700 hover:bg-gray-100 transition text-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-xs font-semibold">Kontak</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Recent articles --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900">Artikel Terbaru</h3>
                        <a href="{{ route('admin.articles.index') }}"
                            class="text-sm text-blue-600 hover:underline">Lihat semua</a>
                    </div>
                    <ul class="divide-y divide-gray-100">
                        @forelse($recentArticles as $article)
                            <li class="px-6 py-3 hover:bg-gray-50 flex items-center justify-between gap-4">
                                <div class="min-w-0">
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                        class="font-medium text-gray-900 hover:text-blue-600 truncate block">
                                        {{ $article->title }}
                                    </a>
                                    <p class="text-xs text-gray-500">
                                        {{ $article->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <span
                                    class="shrink-0 px-2 py-0.5 text-xs font-semibold rounded-full
                                    {{ $article->status === 'published' ? 'bg-green-100 text-green-700' : ($article->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </li>
                        @empty
                            <li class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada artikel.
                                <a href="{{ route('admin.articles.create') }}"
                                    class="text-blue-600 hover:underline">Tulis sekarang</a>
                            </li>
                        @endforelse
                    </ul>
                </div>

                {{-- Recent messages --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900">Pesan Masuk</h3>
                        <a href="{{ route('admin.contact.messages.index') }}"
                            class="text-sm text-blue-600 hover:underline">Lihat semua</a>
                    </div>
                    <ul class="divide-y divide-gray-100">
                        @forelse($recentMessages as $message)
                            <li class="px-6 py-3 hover:bg-gray-50">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <p class="font-medium text-gray-900 truncate">{{ $message->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $message->email }}</p>
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $message->message }}</p>
                                    </div>
                                    @unless ($message->is_read)
                                        <span
                                            class="shrink-0 w-2 h-2 mt-1.5 rounded-full bg-blue-600"
                                            title="Belum dibaca"></span>
                                    @endunless
                                </div>
                                <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                            </li>
                        @empty
                            <li class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada pesan masuk.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Secondary stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <div class="bg-white px-5 py-4 rounded-xl border border-gray-100 text-sm">
                    <span class="text-gray-500">Karir aktif</span>
                    <span class="float-right font-bold text-gray-900">{{ $stats['careers'] }}</span>
                </div>
                <div class="bg-white px-5 py-4 rounded-xl border border-gray-100 text-sm">
                    <span class="text-gray-500">Galeri aktif</span>
                    <span class="float-right font-bold text-gray-900">{{ $stats['galleries'] }}</span>
                </div>
                <div class="bg-white px-5 py-4 rounded-xl border border-gray-100 text-sm col-span-2 sm:col-span-1">
                    <span class="text-gray-500">Total artikel</span>
                    <span
                        class="float-right font-bold text-gray-900">{{ $stats['articles_published'] + $stats['articles_draft'] }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
