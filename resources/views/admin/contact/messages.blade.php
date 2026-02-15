<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesan Masuk') }}
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
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($messages as $message)
                                    <tr class="{{ $message->is_read ? '' : 'bg-blue-50' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $message->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $message->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $message->email }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">
                                            {{ Str::limit($message->message, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if(!$message->is_read)
                                                <form action="{{ route('admin.contact.messages.read', $message) }}" method="POST" class="inline-block mr-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-blue-600 hover:text-blue-900" title="Tandai sudah dibaca">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <button type="button" onclick="showDetail('{{ $message->id }}', '{{ $message->name }}', '{{ $message->email }}', `{{ $message->message }}`)" class="text-gray-600 hover:text-gray-900 mr-2" title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </button>

                                            <form action="{{ route('admin.contact.messages.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pesan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus Pesan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada pesan masuk.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Pesan -->
    <div id="messageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 50;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Detail Pesan</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 mb-1"><strong>Dari:</strong> <span id="modalName"></span></p>
                    <p class="text-sm text-gray-500 mb-4"><strong>Email:</strong> <span id="modalEmail"></span></p>
                    <div class="bg-gray-50 p-3 rounded text-sm text-gray-700 whitespace-pre-wrap" id="modalMessage"></div>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="ok-btn" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetail(id, name, email, message) {
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalMessage').textContent = message;
            document.getElementById('messageModal').classList.remove('hidden');
        }

        document.getElementById('ok-btn').addEventListener('click', function() {
            document.getElementById('messageModal').classList.add('hidden');
        });
    </script>
</x-app-layout>