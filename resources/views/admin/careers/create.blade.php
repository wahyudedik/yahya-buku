<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lowongan Karir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.careers.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <x-input-label for="title" value="Judul Posisi" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" placeholder="Contoh: Editor Buku, Desainer Grafis" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="location" value="Lokasi" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" placeholder="Contoh: Jombang, Remote" />
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>
                            <div>
                                <x-input-label for="type" value="Tipe Pekerjaan" />
                                <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type')" placeholder="Contoh: Full-time, Freelance" />
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" value="Deskripsi Pekerjaan" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Jelaskan tanggung jawab dan kualifikasi...">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="apply_url" value="Link Pendaftaran (LinkedIn/Google Form/Email)" />
                            <x-text-input id="apply_url" name="apply_url" type="url" class="mt-1 block w-full" :value="old('apply_url')" placeholder="https://..." />
                            <x-input-error class="mt-2" :messages="$errors->get('apply_url')" />
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Aktif (Tampilkan di Website)') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.careers.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>