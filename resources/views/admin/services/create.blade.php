<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Layanan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="name" value="Nama Layanan" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="price" value="Harga (Rp)" />
                                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')" placeholder="Kosongkan jika 'Hubungi Kami'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                </div>

                                <div>
                                    <x-input-label for="wa_number" value="Nomor WhatsApp (Opsional)" />
                                    <x-text-input id="wa_number" name="wa_number" type="text" class="mt-1 block w-full" :value="old('wa_number')" placeholder="Contoh: 6285860145144" />
                                    <p class="mt-1 text-xs text-gray-500">Jika kosong, akan menggunakan nomor default: 6285860145144</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('wa_number')" />
                                </div>

                                <div>
                                    <x-input-label for="duration" value="Durasi Pengerjaan" />
                                    <x-text-input id="duration" name="duration" type="text" class="mt-1 block w-full" :value="old('duration')" placeholder="Contoh: 3-5 Hari Kerja" />
                                    <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                                </div>

                                <div>
                                    <x-input-label for="icon" value="Icon Layanan" />
                                    <input id="icon" name="icon" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, SVG (Max 2MB)</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="description" value="Deskripsi Layanan" />
                                    <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                    <h4 class="font-medium text-gray-700">Pengaturan Tampilan</h4>
                                    
                                    <div class="flex items-center">
                                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Aktifkan Layanan</label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">Tampilkan di Halaman Depan (Unggulan)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-4">
                            <a href="{{ route('admin.services.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Layanan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>