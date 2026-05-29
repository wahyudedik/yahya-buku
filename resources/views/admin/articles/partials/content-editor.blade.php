@props([
    'content' => '',
])

<div id="article-editor-field">
    <textarea id="writing-area" name="content"
        class="w-full h-96 p-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y transition-all duration-300"
        placeholder="Mulai menulis ide atau draft artikel Anda di sini..." required>{{ old('content', $content) }}</textarea>
</div>

@once
    @push('styles')
        @vite(['resources/css/article-editor.css'])
    @endpush
    @push('scripts')
        @vite(['resources/js/article-editor.js'])
    @endpush
@endonce
