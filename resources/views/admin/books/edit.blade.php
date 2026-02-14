<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="title" value="Judul Buku" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <div>
                                    <x-input-label for="author" value="Penulis" />
                                    <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $book->author)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('author')" />
                                </div>

                                <div>
                                    <x-input-label for="category" value="Kategori/Genre" />
                                    <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                        <option value="">Pilih Kategori</option>
                                        @foreach(['Fiksi', 'Non-Fiksi', 'Pendidikan', 'Anak', 'Agama', 'Sastra', 'Umum'] as $cat)
                                            <option value="{{ $cat }}" {{ old('category', $book->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="price" value="Harga (Rp)" />
                                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $book->price)" required min="0" />
                                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                    </div>
                                    <div>
                                        <x-input-label for="stock" value="Stok" />
                                        <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $book->stock)" required min="0" />
                                        <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="wa_number" value="Nomor WhatsApp (Opsional)" />
                                    <x-text-input id="wa_number" name="wa_number" type="text" class="mt-1 block w-full" :value="old('wa_number', $book->wa_number)" placeholder="Contoh: 6285860145144" />
                                    <p class="mt-1 text-xs text-gray-500">Jika kosong, akan menggunakan nomor default: 6285860145144</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('wa_number')" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="description" value="Deskripsi Singkat" />
                                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('description', $book->description) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>

                                <div>
                                    <x-input-label for="cover_image" value="Cover Buku" />
                                    @if($book->cover_image_path)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Current Cover" class="h-32 object-cover rounded border">
                                        </div>
                                    @endif
                                    <input id="cover_image" name="cover_image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <x-input-error class="mt-2" :messages="$errors->get('cover_image')" />
                                </div>

                                <div>
                                    <x-input-label for="pdf_file" value="File PDF" />
                                    @if($book->pdf_file_path)
                                        <div class="mb-2 text-sm text-green-600">
                                            File PDF saat ini tersedia. Upload baru untuk mengganti.
                                        </div>
                                    @endif
                                    <input id="pdf_file" name="pdf_file" type="file" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <x-input-error class="mt-2" :messages="$errors->get('pdf_file')" />
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured', $book->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">Tampilkan di Beranda (Featured)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-4">
                            <a href="{{ route('admin.books.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>