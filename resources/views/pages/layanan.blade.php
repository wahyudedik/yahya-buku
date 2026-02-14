@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Layanan Kami</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pena Langit Publishing menyediakan berbagai layanan profesional untuk membantu Anda menerbitkan karya terbaik.
            </p>
        </div>

        <!-- Search & Filter (Optional enhancement) -->
        <div class="mb-10 max-w-xl mx-auto">
            <form action="{{ route('layanan') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari layanan..." class="w-full rounded-full border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-6 py-3">
                <button type="submit" class="bg-blue-600 text-white rounded-full px-6 hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $query = \App\Models\Service::where('is_active', true);
                if(request('search')) {
                    $query->where('name', 'like', '%' . request('search') . '%')
                          ->orWhere('description', 'like', '%' . request('search') . '%');
                }
                $services = $query->latest()->paginate(9);
            @endphp

            @forelse($services as $service)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100 flex flex-col">
                    <div class="p-8 flex flex-col h-full">
                        <div class="flex items-center justify-between mb-6">
                            <div class="h-14 w-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                                @if($service->icon)
                                    <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}" class="h-10 w-10 object-contain">
                                @else
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                @endif
                            </div>
                            @if($service->is_featured)
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">Unggulan</span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                            @if($service->duration)
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $service->duration }}
                                </span>
                            @endif
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow line-clamp-4">
                            {{ $service->description }}
                        </p>

                        <div class="mt-auto border-t pt-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-sm text-gray-500">Mulai dari</span>
                                <span class="text-xl font-bold text-blue-600">
                                    {{ $service->price ? 'Rp ' . number_format($service->price, 0, ',', '.') : 'Hubungi Kami' }}
                                </span>
                            </div>
                            
                            @php
                                $waNumber = $service->wa_number ?? '6285860145144'; // Use service WA or default
                                $message = "Halo Admin Pena Langit, saya tertarik dengan layanan *{$service->name}*";
                                if($service->price) $message .= " seharga Rp " . number_format($service->price, 0, ',', '.');
                                $message .= ". Mohon info lebih lanjut.";
                                $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);
                            @endphp

                            <a href="{{ $waLink }}" target="_blank" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 rounded-xl transition shadow-lg shadow-blue-200">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Layanan tidak ditemukan</h3>
                    <p class="text-gray-500 mt-1">Coba kata kunci lain atau kembali lagi nanti.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
