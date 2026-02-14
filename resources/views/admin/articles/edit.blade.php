<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12" id="ruang-tulisan-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold transition-colors duration-300" id="page-title">Edit Artikel</h1>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 transition-colors duration-300" id="workspace-card">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1 setting-label">Judul Artikel</label>
                                <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold transition-colors duration-300" id="workspace-title">Konten Artikel</h2>
                            </div>
                            <textarea id="writing-area" name="content" class="w-full h-96 p-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y transition-all duration-300" required>{{ old('content', $article->content) }}</textarea>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="font-bold text-gray-900 mb-4">Informasi Publikasi</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="draft" {{ $article->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $article->status === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ $article->status === 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                                @if($article->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $article->image_path) }}" alt="Current Image" class="w-full h-32 object-cover rounded-md">
                                    </div>
                                @endif
                                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kutipan Singkat (Excerpt)</label>
                                <textarea name="excerpt" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('excerpt', $article->excerpt) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>