<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Footer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Footer Settings Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Umum Footer</h3>
                    <form action="{{ route('admin.footer.settings.update') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-1 md:col-span-2">
                                <x-input-label for="description" value="Deskripsi Singkat (Tentang Kami)" />
                                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('description', $footer->description ?? '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <x-input-label for="copyright_text" value="Teks Copyright" />
                                <x-text-input id="copyright_text" name="copyright_text" type="text" class="mt-1 block w-full" :value="old('copyright_text', $footer->copyright_text ?? '© 2026 PT. Nusatama Jaya Sakti . All Right Reserved')" placeholder="© 2026 PT. Nusatama Jaya Sakti..." />
                                <x-input-error class="mt-2" :messages="$errors->get('copyright_text')" />
                            </div>

                            <div>
                                <x-input-label for="created_by_text" value="Created By Text" />
                                <x-text-input id="created_by_text" name="created_by_text" type="text" class="mt-1 block w-full" :value="old('created_by_text', $footer->created_by_text ?? 'Noteds Technology')" />
                                <x-input-error class="mt-2" :messages="$errors->get('created_by_text')" />
                            </div>

                            <div>
                                <x-input-label for="created_by_url" value="Created By URL" />
                                <x-text-input id="created_by_url" name="created_by_url" type="url" class="mt-1 block w-full" :value="old('created_by_url', $footer->created_by_url ?? 'https://noteds.com')" />
                                <x-input-error class="mt-2" :messages="$errors->get('created_by_url')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan Pengaturan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Links Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Link Footer</h3>
                    </div>

                    <!-- Create Link Form -->
                    <div x-data="{ open: false }" class="mb-6">
                        <button @click="open = !open" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                            <span x-show="!open">+ Tambah Link Baru</span>
                            <span x-show="open">- Tutup Form</span>
                        </button>

                        <div x-show="open" class="mt-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <form action="{{ route('admin.footer.links.store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="title" value="Judul Link" />
                                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required placeholder="Contoh: Tentang Kami" />
                                    </div>
                                    <div>
                                        <x-input-label for="url" value="URL" />
                                        <x-text-input id="url" name="url" type="url" class="mt-1 block w-full" required placeholder="https://..." />
                                    </div>
                                    <div>
                                        <x-input-label for="category" value="Kategori" />
                                        <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                            <option value="about_us">Tentang Kami</option>
                                            <option value="related">Link Terkait</option>
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="order" value="Urutan" />
                                        <x-text-input id="order" name="order" type="number" min="0" value="0" class="mt-1 block w-full" />
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <x-primary-button>{{ __('Tambah Link') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Links List -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($links as $link)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $link->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 truncate max-w-xs">
                                            <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $link->category == 'about_us' ? 'Tentang Kami' : 'Link Terkait' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $link->order }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $link->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $link->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.footer.links.edit', $link) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('admin.footer.links.destroy', $link) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus link ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada link footer.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
