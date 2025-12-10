<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fas fa-users-cog text-green-600"></i>
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            {{-- NOTIFIKASI GLOBAL --}}
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        timer: 2500,
                        showConfirmButton: false
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ session('error') }}',
                        timer: 2500,
                        showConfirmButton: false
                    });
                </script>
            @endif

            {{-- FORM SEARCH --}}
            <div class="mb-8">
                <form method="GET" action="{{ route('verification.list') }}" class="flex gap-3">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, NIK atau email..."
                        class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
                    >
                    <button 
                        class="px-6 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 shadow">
                        <i class="fas fa-search mr-1"></i> Search
                    </button>
                </form>
            </div>

            {{-- GRID 2 KOLOM --}}
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                {{-- ========================= --}}
                {{-- KOLOM KIRI - ANTRIAN --}}
                {{-- ========================= --}}
                <div class="bg-white shadow-lg rounded-2xl border border-indigo-100">

                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-indigo-100 text-indigo-600 p-2 rounded-full">
                                <i class="fas fa-user-clock"></i>
                            </span>
                            Antrian Verifikasi
                        </h3>
                        <p class="text-xs text-gray-500 ml-12 mt-1">Pengguna yang belum disetujui.</p>

                        @if($pendingUsers->count() > 0)
                            <span class="mt-3 inline-flex items-center px-2 py-0.5 bg-indigo-100 text-indigo-800 text-xs font-bold rounded-full">
                                {{ $pendingUsers->count() }} Pengguna Baru
                            </span>
                        @else
                            <span class="mt-3 inline-flex items-center px-2 py-0.5 bg-gray-100 text-gray-500 text-xs rounded-full">
                                Tidak Ada Antrian
                            </span>
                        @endif
                    </div>

                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden">
                            <thead class="bg-indigo-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Pendaftar</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">NIK</th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-indigo-700 uppercase">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($pendingUsers as $user)
                                    <tr class="hover:bg-indigo-50 transition">
                                        <td class="px-4 py-3">
                                            <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                            <div class="text-xs text-gray-500 flex items-center gap-1">
                                                <i class="fab fa-whatsapp text-green-500"></i>
                                                {{ $user->no_hp }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-xs text-gray-600">
                                            {{ $user->nik }}
                                            <div class="text-[10px] text-gray-400 mt-1">
                                                {{ $user->created_at->diffForHumans() }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            <div class="flex flex-col gap-2">

                                                {{-- TERIMA --}}
                                                <form action="{{ route('verification.approve', $user) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="w-full px-3 py-1.5 text-xs bg-green-600 text-white rounded-md hover:bg-green-700 shadow">
                                                        <i class="fas fa-check mr-1"></i> Setujui
                                                    </button>
                                                </form>

                                                {{-- TOLAK --}}
                                                <form action="{{ route('verification.reject', $user) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Hapus pendaftar ini?');">
                                                    @csrf @method('DELETE')
                                                    <button class="w-full px-3 py-1.5 text-xs bg-red-50 text-red-600 border border-red-300 rounded-md hover:bg-red-100 shadow">
                                                        <i class="fas fa-times mr-1"></i> Tolak
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-gray-400 text-sm italic">
                                            <i class="fas fa-check-double text-gray-300 text-3xl mb-2"></i><br>
                                            Tidak ada antrian verifikasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

                {{-- ========================= --}}
                {{-- KOLOM KANAN - WARGA AKTIF --}}
                {{-- ========================= --}}
                <div class="bg-white shadow-lg rounded-2xl border border-gray-200">

                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-green-100 text-green-600 p-2 rounded-full">
                                <i class="fas fa-users"></i>
                            </span>
                            Warga Aktif
                        </h3>
                        <p class="text-xs text-gray-500 ml-12 mt-1">Pengguna yang sudah disetujui.</p>

                        <span class="mt-3 inline-flex items-center px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">
                            Total: {{ $users->count() }}
                        </span>
                    </div>

                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Warga</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Kontak</th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50 transition">

                                        <td class="px-4 py-3">
                                            <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500 font-mono">{{ $user->nik }}</div>
                                            <span class="mt-1 inline-flex px-2 py-0.5 rounded bg-green-100 text-green-700 text-[10px] font-medium">
                                                Aktif
                                            </span>
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="text-xs text-gray-700">{{ $user->email }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->no_hp ?? '-' }}</div>
                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            <form action="{{ route('users.destroy', $user) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Menghapus warga ini juga menghapus semua riwayat pengajuan. Lanjutkan?')">
                                                @csrf @method('DELETE')
                                                <button class="text-gray-400 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition">
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
</x-app-layout>
