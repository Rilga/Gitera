<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Global (Full Width) --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 shadow-sm rounded-r flex items-start" role="alert">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl mt-0.5"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 font-bold">Berhasil!</p>
                        <p class="text-sm text-green-600">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 shadow-sm rounded-r flex items-start" role="alert">
                    <div class="flex-shrink-0">
                        <i class="fas fa-times-circle text-red-500 text-xl mt-0.5"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-bold">Terjadi Kesalahan!</p>
                        <p class="text-sm text-red-600">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            {{-- GRID LAYOUT: Dua Kolom --}}
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 items-start">
                
                {{-- KOLOM KIRI: ANTRIAN VERIFIKASI --}}
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-t-4 border-indigo-500 h-full">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="mb-2 sm:mb-0">
                                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                    <span class="bg-indigo-100 text-indigo-600 p-2 rounded-full mr-3">
                                        <i class="fas fa-user-clock"></i>
                                    </span>
                                    Antrian Verifikasi
                                </h3>
                                <p class="text-xs text-gray-500 mt-1 ml-11">Menunggu persetujuan.</p>
                            </div>
                            
                            @if($pendingUsers->count() > 0)
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-2 py-1 rounded-full animate-pulse">
                                    {{ $pendingUsers->count() }} Baru
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2 py-1 rounded-full">
                                    Kosong
                                </span>
                            @endif
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                <thead class="bg-indigo-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-800 uppercase tracking-wider">Pendaftar</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-800 uppercase tracking-wider">NIK</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-indigo-800 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($pendingUsers as $user)
                                        <tr class="hover:bg-indigo-50 transition-colors duration-150">
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                                <div class="text-xs text-gray-500"><i class="fab fa-whatsapp text-green-500"></i> {{ $user->no_hp }}</div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-600 font-mono">
                                                {{ $user->nik }}
                                                <div class="text-[10px] text-gray-400 mt-1">{{ $user->created_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                <div class="flex flex-col space-y-2 items-center">
                                                    <form action="{{ route('verification.approve', $user) }}" method="POST" class="w-full">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="w-full inline-flex justify-center items-center px-1 py-1.5 bg-green-600 border border-transparent rounded text-xs text-white hover:bg-green-700 transition duration-150 shadow-sm" title="Setujui">
                                                            <i class="fas fa-check mr-1.5"></i> Terima
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('verification.reject', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak dan menghapus?');" class="w-full">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="w-full inline-flex justify-center items-center px-1 py-1.5 bg-white border border-red-300 rounded text-xs text-red-700 hover:bg-red-50 transition duration-150 shadow-sm" title="Tolak">
                                                            <i class="fas fa-times mr-1.5"></i> Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <i class="fas fa-check-double text-gray-300 text-3xl mb-2"></i>
                                                    <p class="text-gray-400 text-xs italic">Tidak ada antrian.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: DATA WARGA AKTIF --}}
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-t-4 border-gray-500 h-full">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-4 border-b border-gray-100">
                             <div class="mb-2 sm:mb-0">
                                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                    <span class="bg-green-100 text-green-600 p-2 rounded-full mr-3">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    Warga Aktif
                                </h3>
                                <p class="text-xs text-gray-500 mt-1 ml-11">Data pengguna disetujui.</p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                Total: {{ $users->count() }}
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Warga</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kontak</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($users as $user)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-500 font-mono">{{ $user->nik }}</div>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-green-100 text-green-800 mt-1">
                                                    Aktif
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="text-xs text-gray-600">{{ $user->email }}</div>
                                                <div class="text-xs text-gray-500 mt-0.5">{{ $user->no_hp ?? '-' }}</div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium">
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus warga ini akan menghapus seluruh riwayat pengajuannya. Lanjutkan?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors duration-200 p-2 rounded-full hover:bg-red-50" title="Hapus Data">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-8 text-center text-gray-500 italic">
                                                Belum ada data warga.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>