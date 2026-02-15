<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <x-input-label for="question" value="Pertanyaan" />
                            <x-text-input id="question" name="question" type="text" class="mt-1 block w-full" :value="old('question', $faq->question)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('question')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="answer" value="Jawaban" />
                            <textarea id="answer" name="answer" rows="4" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>{{ old('answer', $faq->answer) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('answer')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="order" value="Urutan (opsional)" />
                                <x-text-input id="order" name="order" type="number" min="0" class="mt-1 block w-full" :value="old('order', $faq->order)" />
                                <x-input-error class="mt-2" :messages="$errors->get('order')" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Aktif (Tampilkan di Website)') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.faqs.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
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
