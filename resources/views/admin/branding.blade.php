<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Branding: Logo & Favicon
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                    <ul class="list-disc ms-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.branding.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="font-semibold text-lg mb-3">Logo Utama</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-4">
                                        <input type="file" id="logo" name="logo"
                                            accept=".png,.jpg,.jpeg,.svg" class="block w-full text-sm text-gray-700">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Preview</label>
                                        <div
                                            class="mt-2 border rounded-lg p-4 flex items-center justify-center min-h-40">
                                            <img id="logoPreview"
                                                src="{{ $settings?->logo_path ? asset('storage/' . $settings->logo_path) . '?v=' . ($settings->cache_bust_token ?? '') : '' }}"
                                                alt="Logo Preview" class="max-h-40 object-contain" />
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Format: PNG, JPG, SVG. Maks 2MB.</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="logo_width"
                                                class="block text-sm font-medium text-gray-700">Width (px)</label>
                                            <input type="number" name="logo_width" id="logo_width"
                                                value="{{ old('logo_width', $settings?->logo_width) }}"
                                                class="mt-1 w-full rounded-md border-gray-300 focus:ring-blue-600 focus:border-blue-600">
                                        </div>
                                        <div>
                                            <label for="logo_height"
                                                class="block text-sm font-medium text-gray-700">Height (px)</label>
                                            <input type="number" name="logo_height" id="logo_height"
                                                value="{{ old('logo_height', $settings?->logo_height) }}"
                                                class="mt-1 w-full rounded-md border-gray-300 focus:ring-blue-600 focus:border-blue-600">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="logo_position"
                                            class="block text-sm font-medium text-gray-700">Posisi</label>
                                        <select id="logo_position" name="logo_position"
                                            class="mt-1 w-full rounded-md border-gray-300 focus:ring-blue-600 focus:border-blue-600">
                                            @php $pos = old('logo_position', $settings?->logo_position ?? 'left'); @endphp
                                            <option value="left" {{ $pos === 'left' ? 'selected' : '' }}>Left</option>
                                            <option value="center" {{ $pos === 'center' ? 'selected' : '' }}>Center
                                            </option>
                                            <option value="right" {{ $pos === 'right' ? 'selected' : '' }}>Right</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-3">Favicon</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-4">
                                        <input type="file" id="favicon" name="favicon" accept=".ico,.png,.svg"
                                            class="block w-full text-sm text-gray-700">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Preview</label>
                                        <div
                                            class="mt-2 border rounded-lg p-4 flex items-center justify-center min-h-40">
                                            <img id="faviconPreview"
                                                src="{{ $settings?->favicon_path ? asset('storage/' . $settings->favicon_path) . '?v=' . ($settings->cache_bust_token ?? '') : '' }}"
                                                alt="Favicon Preview" class="h-12 w-12 object-contain" />
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Format: ICO, PNG, SVG. Disarankan 16x16,
                                            32x32, atau 48x48.</p>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="hidden" name="favicon_enabled" value="0">
                                        <input id="favicon_enabled" name="favicon_enabled" type="checkbox"
                                            value="1"
                                            {{ old('favicon_enabled', $settings?->favicon_enabled ?? true) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <label for="favicon_enabled" class="ms-2 text-sm text-gray-700">Aktifkan
                                            favicon</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Simpan Perubahan
                            </button>
                            <form action="{{ route('admin.branding.reset') }}" method="POST"
                                onsubmit="return confirm('Kembalikan ke default?')">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                    Reset Default
                                </button>
                            </form>
                            @if ($settings)
                                <span class="text-xs text-gray-500">Terakhir diperbarui:
                                    {{ $settings->updated_at?->format('Y-m-d H:i') }} oleh
                                    {{ $settings->updater?->name ?? '-' }}</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/cropperjs@1.6.1/dist/cropper.min.css">
    <script src="https://unpkg.com/cropperjs@1.6.1/dist/cropper.min.js"></script>
    <script>
        const logoInput = document.getElementById('logo');
        const faviconInput = document.getElementById('favicon');
        const logoPreview = document.getElementById('logoPreview');
        const faviconPreview = document.getElementById('faviconPreview');

        function previewFile(input, imgEl) {
            input.addEventListener('change', () => {
                const file = input.files?.[0];
                if (!file) return;
                const url = URL.createObjectURL(file);
                imgEl.src = url;
            });
        }
        previewFile(logoInput, logoPreview);
        previewFile(faviconInput, faviconPreview);

        // Optional cropper for logo
        let cropper;
        logoPreview.addEventListener('load', () => {
            if (cropper) cropper.destroy();
            cropper = new Cropper(logoPreview, {
                viewMode: 1,
                autoCropArea: 1,
                aspectRatio: NaN
            });
        });

        // When submitting, replace logo file with cropped blob for better result
        const form = document.querySelector('form[enctype="multipart/form-data"]');
        form.addEventListener('submit', async (e) => {
            if (cropper && logoInput.files?.length) {
                e.preventDefault();
                const canvas = cropper.getCroppedCanvas();
                if (canvas) {
                    canvas.toBlob((blob) => {
                        const dt = new DataTransfer();
                        const ext = logoInput.files[0].type === 'image/png' ? 'png' : 'jpeg';
                        const file = new File([blob], 'logo-cropped.' + ext, {
                            type: logoInput.files[0].type
                        });
                        dt.items.add(file);
                        logoInput.files = dt.files;
                        form.submit();
                    }, logoInput.files[0].type, 0.92);
                } else {
                    form.submit();
                }
            }
        });
    </script>
</x-app-layout>
