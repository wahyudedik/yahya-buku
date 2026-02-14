<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hero Section Setup') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="heroEditor()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 text-green-700">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Editor Form -->
                <div class="lg:col-span-2 space-y-6">
                    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
                        @csrf
                        
                        <!-- Status & Layout -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <x-input-label for="is_active" value="Status Section" />
                                <div class="mt-2 flex items-center">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $hero->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-600">Aktifkan Hero Section</span>
                                </div>
                            </div>
                            <div>
                                <x-input-label for="layout" value="Layout Style" />
                                <select id="layout" name="layout" x-model="layout" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                    <option value="left-text-right-image">Text Left - Image Right</option>
                                    <option value="center-text">Center Text</option>
                                    <option value="right-text-left-image">Text Right - Image Left</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text Content -->
                        <div class="space-y-4 mb-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900">Text Content</h3>
                            <div>
                                <x-input-label for="headline" value="Headline" />
                                <x-text-input id="headline" name="headline" type="text" class="mt-1 block w-full" x-model="headline" value="{{ old('headline', $hero->headline) }}" />
                            </div>
                            <div>
                                <x-input-label for="subheadline" value="Subheadline" />
                                <textarea id="subheadline" name="subheadline" rows="3" x-model="subheadline" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('subheadline', $hero->subheadline) }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="text_color" value="Text Color" />
                                <div class="flex items-center gap-2 mt-1">
                                    <input type="color" id="text_color" name="text_color" x-model="textColor" value="{{ old('text_color', $hero->text_color) }}" class="h-9 w-9 border-0 p-0 rounded cursor-pointer">
                                    <x-text-input type="text" x-model="textColor" class="w-24" />
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="space-y-4 mb-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900">Call To Action</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="cta_text" value="Button Text" />
                                    <x-text-input id="cta_text" name="cta_text" type="text" class="mt-1 block w-full" x-model="ctaText" value="{{ old('cta_text', $hero->cta_text) }}" />
                                </div>
                                <div>
                                    <x-input-label for="cta_url" value="Button URL" />
                                    <x-text-input id="cta_url" name="cta_url" type="text" class="mt-1 block w-full" value="{{ old('cta_url', $hero->cta_url) }}" />
                                </div>
                                <div>
                                    <x-input-label for="cta_color" value="Button Background" />
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="color" id="cta_color" name="cta_color" x-model="ctaColor" value="{{ old('cta_color', $hero->cta_color) }}" class="h-9 w-9 border-0 p-0 rounded cursor-pointer">
                                        <x-text-input type="text" x-model="ctaColor" class="w-24" />
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="cta_text_color" value="Button Text Color" />
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="color" id="cta_text_color" name="cta_text_color" x-model="ctaTextColor" value="{{ old('cta_text_color', $hero->cta_text_color) }}" class="h-9 w-9 border-0 p-0 rounded cursor-pointer">
                                        <x-text-input type="text" x-model="ctaTextColor" class="w-24" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Visuals -->
                        <div class="space-y-4 mb-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900">Visuals</h3>
                            
                            <!-- Background -->
                            <div>
                                <x-input-label for="background_type" value="Background Type" />
                                <select id="background_type" name="background_type" x-model="bgType" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                    <option value="color">Solid Color</option>
                                    <option value="image">Image</option>
                                </select>
                            </div>

                            <div x-show="bgType === 'color'">
                                <x-input-label for="background_color" value="Background Color" />
                                <div class="flex items-center gap-2 mt-1">
                                    <input type="color" id="background_color" name="background_color" x-model="bgColor" value="{{ old('background_color', $hero->background_color) }}" class="h-9 w-9 border-0 p-0 rounded cursor-pointer">
                                    <x-text-input type="text" x-model="bgColor" class="w-24" />
                                </div>
                            </div>

                            <div x-show="bgType === 'image'" class="space-y-2">
                                <x-input-label for="background_image" value="Background Image" />
                                @if($hero->background_image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/'.$hero->background_image_path) }}" class="h-20 w-auto rounded border">
                                    </div>
                                @endif
                                <input type="file" id="background_image" name="background_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">Max 5MB. Recommended: 1920x1080px</p>
                            </div>

                            <!-- Hero Image (Certificate/Book) -->
                            <div class="mt-4">
                                <x-input-label for="hero_image" value="Hero Side Image (Optional)" />
                                @if($hero->hero_image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/'.$hero->hero_image_path) }}" class="h-20 w-auto rounded border">
                                    </div>
                                @endif
                                <input type="file" id="hero_image" name="hero_image" @change="previewHeroImage" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">Displayed on the side (desktop) or below text (mobile).</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end border-t pt-4">
                            <x-primary-button>
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Live Preview -->
                <div class="lg:col-span-1">
                    <div class="bg-white shadow rounded-lg p-4 sticky top-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Live Preview (Desktop)</h3>
                        
                        <!-- Preview Container -->
                        <div class="border border-gray-200 rounded overflow-hidden relative" 
                             :style="bgType === 'color' ? 'background-color: ' + bgColor : 'background-color: #f3f4f6'">
                            
                             <!-- BG Image Preview Placeholder if Type is Image -->
                            <template x-if="bgType === 'image'">
                                <div class="absolute inset-0 bg-cover bg-center opacity-50" style="background-image: url('{{ $hero->background_image_path ? asset('storage/'.$hero->background_image_path) : 'https://placehold.co/600x400/e5e7eb/a1a1aa?text=BG+Image' }}')"></div>
                            </template>

                            <div class="relative p-6 min-h-[300px] flex items-center">
                                <div class="grid gap-4 w-full" 
                                     :class="{
                                        'grid-cols-1 text-center': layout === 'center-text',
                                        'grid-cols-2 text-left': layout === 'left-text-right-image',
                                        'grid-cols-2 text-right': layout === 'right-text-left-image'
                                     }">
                                    
                                    <!-- Text Column -->
                                    <div :class="{'order-2': layout === 'right-text-left-image', 'col-span-2': layout === 'center-text'}">
                                        <h1 class="text-xl font-bold mb-2 leading-tight" :style="'color: ' + textColor" x-text="headline"></h1>
                                        <p class="text-sm mb-4 opacity-80" :style="'color: ' + textColor" x-text="subheadline"></p>
                                        
                                        <div class="flex gap-2" :class="{'justify-center': layout === 'center-text', 'justify-start': layout === 'left-text-right-image', 'justify-end': layout === 'right-text-left-image'}">
                                            <button class="px-4 py-2 rounded text-xs font-bold shadow-sm transition transform hover:scale-105"
                                                :style="'background-color: ' + ctaColor + '; color: ' + ctaTextColor"
                                                x-text="ctaText">
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Image Column -->
                                    <div x-show="layout !== 'center-text'" 
                                         :class="{'order-1': layout === 'right-text-left-image'}">
                                        <div class="relative flex justify-center">
                                            <img :src="heroImagePreview || '{{ $hero->hero_image_path ? asset('storage/'.$hero->hero_image_path) : 'https://placehold.co/400x300/e0e7ff/002B8F?text=Hero+Image' }}'" 
                                                 class="w-full max-w-[150px] shadow-lg rounded border border-white/50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="text-xs text-gray-500 mt-4 italic">
                            * This is a simplified preview. Actual display may vary depending on screen size and global styles.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function heroEditor() {
            return {
                headline: '{{ $hero->headline }}',
                subheadline: `{{ $hero->subheadline }}`,
                textColor: '{{ $hero->text_color }}',
                ctaText: '{{ $hero->cta_text }}',
                ctaColor: '{{ $hero->cta_color }}',
                ctaTextColor: '{{ $hero->cta_text_color }}',
                bgType: '{{ $hero->background_type }}',
                bgColor: '{{ $hero->background_color }}',
                layout: '{{ $hero->layout }}',
                heroImagePreview: null,

                previewHeroImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.heroImagePreview = URL.createObjectURL(file);
                    }
                }
            }
        }
    </script>
</x-app-layout>