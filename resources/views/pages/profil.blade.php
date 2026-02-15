@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Profil Perusahaan</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Mengenal lebih dekat Pena Langit Publishing
            </p>
        </div>

        @php
            $profile = \App\Models\CompanyProfile::first();
        @endphp

        <div class="flex flex-col md:flex-row items-center gap-12 bg-white p-8 rounded-2xl shadow-sm border border-gray-100 max-w-6xl mx-auto">
            <!-- CEO Image -->
            <div class="w-full md:w-1/3 relative">
                <div class="absolute -top-4 -left-4 w-24 h-24 grid grid-cols-6 gap-1 z-0 text-blue-100">
                    @for ($i = 0; $i < 36; $i++)
                        <div class="w-1.5 h-1.5 rounded-full bg-current"></div>
                    @endfor
                </div>
                <div class="relative z-10 bg-gradient-to-b from-transparent to-blue-900 rounded-lg overflow-hidden">
                    @if($profile?->ceo_image_path)
                        <img src="{{ asset('storage/' . $profile->ceo_image_path) }}" alt="CEO Pena Langit" class="w-full h-auto object-cover">
                    @else
                        <img src="https://placehold.co/400x500/002B8F/ffffff?text={{ urlencode($profile?->ceo_name ?? 'Aang Fathul Islam') }}" alt="CEO Pena Langit" class="w-full h-auto object-cover">
                    @endif
                    <div class="absolute bottom-0 left-0 w-full p-4 text-center text-white bg-blue-900/80">
                        <h3 class="font-bold text-lg">{{ $profile->ceo_name ?? 'AANG FATHUL ISLAM' }}</h3>
                        <p class="text-xs uppercase opacity-80">{{ $profile->ceo_title ?? 'Direktur Utama' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quote Content -->
            <div class="w-full md:w-2/3">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi & Misi</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    {{ $profile->vision_mission_description ?? 'Menjadi penerbit buku yang profesional, amanah, dan berkualitas untuk mencerdaskan kehidupan bangsa melalui literasi. Kami berkomitmen memberikan layanan terbaik bagi penulis dan pembaca di seluruh Indonesia.' }}
                </p>
                
                <blockquote class="text-xl text-gray-600 italic border-l-4 border-blue-500 pl-4 mb-6">
                    “{{ $profile->quote ?? 'Kemerdekaan yang hakiki adalah saat kita bisa mengabadikan gagasan dan pemikiran kita melalui tulisan, karena tulisan akan abadi tak terbatas oleh ruang dan waktu.' }}”
                </blockquote>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center border border-gray-100">
                        <h4 class="font-bold text-blue-600 text-2xl mb-1">{{ $profile->books_count ?? '500+' }}</h4>
                        <p class="text-xs text-gray-500 uppercase">Judul Buku</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center border border-gray-100">
                        <h4 class="font-bold text-blue-600 text-2xl mb-1">{{ $profile->authors_count ?? '1000+' }}</h4>
                        <p class="text-xs text-gray-500 uppercase">Penulis</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center border border-gray-100">
                        <h4 class="font-bold text-blue-600 text-2xl mb-1">{{ $profile->experience_years ?? '5th' }}</h4>
                        <p class="text-xs text-gray-500 uppercase">Pengalaman</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
