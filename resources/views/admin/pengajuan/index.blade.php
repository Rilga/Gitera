<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-clipboard-list text-green-600 w-5"></i>
            Data Pengajuan <br>
            <p class="text-gray-500 text-xs mt-1">Semua surat penting ada di sini, siap untuk ditinjau!</p>
        </h2>
    </x-slot>
    <div class="">
        {{-- Card --}}
        <div class="bg-white shadow-sm rounded-xl p-5 border border-gray-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">

                {{-- Judul kiri --}}
                <h2 class="text-lg font-semibold text-gray-800 mb-2 md:mb-0">
                    Pengajuan Surat Masuk
                </h2>

                {{-- FORM FILTER & SEARCH --}}
                <form method="GET" action="{{ route('admin.pengajuan.index') }}"
                    class="flex flex-col md:flex-row items-start md:items-center gap-3">

                    {{-- Search --}}
                    <div class="relative w-full md:w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari..."
                            class="w-full border-gray-300 rounded-lg pl-10 text-sm focus:ring-green-500 focus:border-green-500">

                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                        </svg>
                    </div>

                                        {{-- Filter tanggal --}}
                    <div class="flex items-center gap-2">
                        <input type="date" name="start_date"
                            value="{{ request('start_date') }}"
                            class="border-gray-300 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">

                        <span class="text-gray-500">–</span>

                        <input type="date" name="end_date"
                            value="{{ request('end_date') }}"
                            class="border-gray-300 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    {{-- Tombol filter --}}
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition">
                        Filter
                    </button>

                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b text-gray-600">
                        <tr>
                            <th class="py-3 px-4 text-left">ID Surat</th>
                            <th class="py-3 px-4 text-left">Nama Pengaju</th>
                            <th class="py-3 px-4 text-left">Kategori Surat</th>
                            <th class="py-3 px-4 text-left">Tanggal</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y bg-white">
                        @foreach ($pengajuans as $p)
                            <tr class="hover:bg-gray-50 transition">

                                {{-- ID --}}
                                <td class="py-3 px-4 font-semibold text-gray-700">
                                    #U{{ $p->id }}
                                </td>

                                {{-- Nama + Avatar --}}
                                <td class="py-3 px-4 flex items-center gap-3">
                                    <img class="w-10 h-10 rounded-full object-contain border-2 border-gray-100"
                                         src="https://ui-avatars.com/api/?name={{ urlencode($p->user->name) }}&background=random&color=fff"
                                         alt="{{ $p->user->name }}" />

                                    <span class="font-medium text-gray-800">
                                        {{ $p->user->name }}
                                    </span>
                                </td>

                                {{-- Jenis Surat --}}
                                <td class="py-3 px-4 capitalize text-gray-700">
                                    {{ $p->title ?? str_replace('-', ' ', $p->slug) }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="py-3 px-2 text-gray-700">
                                    {{ $p->created_at->format('d-m-Y') }}
                                </td>

                                {{-- Status --}}
                                <td class="py-3 px-2">
                                    @if ($p->status === 'verified')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Disetujui
                                        </span>
                                    @elseif($p->status === 'rejected')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            Menunggu
                                        </span>
                                    @endif
                                </td>

                                {{-- Action --}}
                                <td class="py-3 px-1">
                                    <a href="{{ route('admin.pengajuan.show', $p->id) }}"
                                        class="text-green-600 hover:text-green-700 font-semibold">
                                        Lihat Detail
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $pengajuans->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
