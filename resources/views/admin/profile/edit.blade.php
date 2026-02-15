<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Perusahaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 text-green-700">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- CEO Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Informasi Pimpinan (CEO)</h3>
                                
                                <div>
                                    <x-input-label for="ceo_name" value="Nama Lengkap CEO" />
                                    <x-text-input id="ceo_name" name="ceo_name" type="text" class="mt-1 block w-full" :value="old('ceo_name', $profile->ceo_name ?? '')" placeholder="Nama CEO" />
                                    <x-input-error class="mt-2" :messages="$errors->get('ceo_name')" />
                                </div>

                                <div>
                                    <x-input-label for="ceo_title" value="Jabatan CEO" />
                                    <x-text-input id="ceo_title" name="ceo_title" type="text" class="mt-1 block w-full" :value="old('ceo_title', $profile->ceo_title ?? '')" placeholder="Contoh: Direktur Utama" />
                                    <x-input-error class="mt-2" :messages="$errors->get('ceo_title')" />
                                </div>

                                <div>
                                    <x-input-label for="ceo_image" value="Foto CEO" />
                                    @if($profile?->ceo_image_path)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $profile->ceo_image_path) }}" alt="CEO" class="h-32 object-cover rounded border">
                                        </div>
                                    @endif
                                    <input id="ceo_image" name="ceo_image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <x-input-error class="mt-2" :messages="$errors->get('ceo_image')" />
                                </div>
                            </div>

                            <!-- Company Details -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Deskripsi & Statistik</h3>

                                <div>
                                    <x-input-label for="vision_mission_description" value="Deskripsi Visi & Misi" />
                                    <textarea id="vision_mission_description" name="vision_mission_description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('vision_mission_description', $profile->vision_mission_description ?? '') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('vision_mission_description')" />
                                </div>

                                <div>
                                    <x-input-label for="quote" value="Kutipan (Quote)" />
                                    <textarea id="quote" name="quote" rows="3" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('quote', $profile->quote ?? '') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('quote')" />
                                </div>

                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <x-input-label for="books_count" value="Jml Buku" />
                                        <x-text-input id="books_count" name="books_count" type="text" class="mt-1 block w-full" :value="old('books_count', $profile->books_count ?? '0')" />
                                        <x-input-error class="mt-2" :messages="$errors->get('books_count')" />
                                    </div>
                                    <div>
                                        <x-input-label for="authors_count" value="Jml Penulis" />
                                        <x-text-input id="authors_count" name="authors_count" type="text" class="mt-1 block w-full" :value="old('authors_count', $profile->authors_count ?? '0')" />
                                        <x-input-error class="mt-2" :messages="$errors->get('authors_count')" />
                                    </div>
                                    <div>
                                        <x-input-label for="experience_years" value="Pengalaman" />
                                        <x-text-input id="experience_years" name="experience_years" type="text" class="mt-1 block w-full" :value="old('experience_years', $profile->experience_years ?? '0')" />
                                        <x-input-error class="mt-2" :messages="$errors->get('experience_years')" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t pt-4">
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