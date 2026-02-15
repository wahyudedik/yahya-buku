@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">FAQ</h1>
        <div class="max-w-3xl mx-auto space-y-4">
            @forelse($faqs as $faq)
                <div class="border border-gray-200 rounded-lg overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-white hover:bg-gray-50 transition text-left">
                        <span class="font-medium text-gray-900">{{ $faq->question }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="p-4 bg-white text-gray-600 text-sm leading-relaxed border-t border-gray-200">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            @empty
                <div class="bg-white p-8 rounded-lg shadow-sm text-center text-gray-500">
                    Belum ada pertanyaan yang sering diajukan.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
