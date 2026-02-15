<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Kontak') }}
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
                    <form action="{{ route('admin.contact.settings.update') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informasi Dasar -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Informasi Dasar</h3>
                                
                                <div>
                                    <x-input-label for="email" value="Email Perusahaan" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $setting->email ?? '')" placeholder="admin@penalangit.id" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <div>
                                    <x-input-label for="phone" value="Nomor Telepon / WhatsApp" />
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $setting->phone ?? '')" placeholder="0858xxxxxxxx" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <div>
                                    <x-input-label for="address" value="Alamat Lengkap" />
                                    <textarea id="address" name="address" rows="4" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('address', $setting->address ?? '') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>
                            </div>

                            <!-- Media Sosial -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Media Sosial (URL Lengkap)</h3>

                                <div>
                                    <x-input-label for="instagram" value="Instagram" />
                                    <x-text-input id="instagram" name="instagram" type="url" class="mt-1 block w-full" :value="old('instagram', $setting->instagram ?? '')" placeholder="https://instagram.com/username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                                </div>

                                <div>
                                    <x-input-label for="facebook" value="Facebook" />
                                    <x-text-input id="facebook" name="facebook" type="url" class="mt-1 block w-full" :value="old('facebook', $setting->facebook ?? '')" placeholder="https://facebook.com/username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                                </div>

                                <div>
                                    <x-input-label for="twitter" value="Twitter / X" />
                                    <x-text-input id="twitter" name="twitter" type="url" class="mt-1 block w-full" :value="old('twitter', $setting->twitter ?? '')" placeholder="https://twitter.com/username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
                                </div>

                                <div>
                                    <x-input-label for="youtube" value="YouTube" />
                                    <x-text-input id="youtube" name="youtube" type="url" class="mt-1 block w-full" :value="old('youtube', $setting->youtube ?? '')" placeholder="https://youtube.com/@username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('youtube')" />
                                </div>

                                <div>
                                    <x-input-label for="tiktok" value="TikTok" />
                                    <x-text-input id="tiktok" name="tiktok" type="url" class="mt-1 block w-full" :value="old('tiktok', $setting->tiktok ?? '')" placeholder="https://tiktok.com/@username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-4">
                            <x-primary-button>
                                {{ __('Simpan Pengaturan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>