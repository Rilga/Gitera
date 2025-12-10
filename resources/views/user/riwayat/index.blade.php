<x-app-layout>
    <div class="bg-gray-100 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- HEADER --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Riwayat Pengajuan Surat</h1>
                <p class="text-gray-500 mt-1 text-base">Lihat semua surat yang pernah Anda ajukan</p>
            </div>

            {{-- STATS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h2 class="text-4xl font-bold text-gray-800">{{ $total }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Total Pengajuan</p>
                </div>
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h2 class="text-4xl font-bold text-[#00C07F]">{{ $selesai }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Surat Selesai</p>
                </div>
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h2 class="text-4xl font-bold text-blue-500">{{ $diproses }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Sedang Diproses</p>
                </div>
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h2 class="text-4xl font-bold text-red-500">{{ $ditolak }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Ditolak</p>
                </div>
            </div>

            {{-- CONTENT CARD --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

                {{-- Toolbar --}}
                <div class="p-6 border-b border-gray-100 flex flex-col lg:flex-row justify-between items-center gap-4">
                    <form action="{{ route('user.riwayat') }}" method="GET" class="relative w-full lg:w-[400px]">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="q" placeholder="Cari berdasarkan ID atau jenis surat..."
                               value="{{ request('q') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#00C07F] focus:border-[#00C07F] text-sm placeholder-gray-400 transition-shadow">
                    </form>

                    <div class="flex items-center gap-2 w-full lg:w-auto overflow-x-auto pb-2 lg:pb-0 no-scrollbar">
                        @foreach (['Semua', 'Selesai', 'Diproses', 'Ditolak'] as $status)
                            <a href="{{ route('user.riwayat', ['status' => $status === 'Semua' ? '' : $status]) }}"
                               class="px-4 py-2 rounded-lg text-sm font-semibold {{ request('status') == $status ? 'bg-[#00C07F] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }} transition whitespace-nowrap">
                                {{ $status }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-white border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">ID Surat</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Jenis Surat</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($surats as $surat)
                                @php
                                    $statusMap = [
                                        'pending' => ['label' => 'Diproses', 'color' => 'blue'],
                                        'verified' => ['label' => 'Selesai', 'color' => 'green'],
                                        'rejected' => ['label' => 'Ditolak', 'color' => 'red'],
                                    ];
                                    $status = $statusMap[$surat->status] ?? ['label' => 'Unknown', 'color' => 'gray'];
                                @endphp
                                <tr class="hover:bg-gray-50 transition group">
                                    <td class="px-6 py-5 text-sm text-gray-500 font-medium">#{{ $surat->slug }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-900 font-medium">{{ $surat->title }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-500">{{ $surat->created_at->format('d-m-Y') }}</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-{{ $status['color'] }}-50 text-{{ $status['color'] }}-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-{{ $status['color'] }}-500"></span> {{ $status['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex justify-end items-center gap-6">
                                            <a href="{{ route('user.riwayat.show', $surat->id) }}" class="text-[#00C07F] hover:text-green-700 text-sm font-semibold flex items-center gap-1.5 transition-colors">
                                                <i class="far fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-5 text-center text-gray-500">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer / Pagination --}}
                <div class="p-6 border-t flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $surats->count() }} dari {{ $surats->total() }} data
                    </div>

                    <div class="flex gap-2">
                        {{-- Tombol Sebelumnya --}}
                        <a href="{{ $surats->previousPageUrl() }}"
                        class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-500 hover:bg-gray-50 flex items-center gap-2 {{ $surats->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                            <i class="fas fa-arrow-left text-xs"></i> Sebelumnya
                        </a>

                        {{-- Nomor halaman --}}
                        @for ($i = 1; $i <= $surats->lastPage(); $i++)
                            <a href="{{ $surats->url($i) }}"
                            class="w-9 h-9 {{ $surats->currentPage() == $i ? 'bg-[#00C07F] text-white' : 'bg-white text-gray-500' }} rounded-lg text-sm font-bold flex items-center justify-center shadow-md shadow-green-200 transition">
                                {{ $i }}
                            </a>
                        @endfor

                        {{-- Tombol Selanjutnya --}}
                        <a href="{{ $surats->nextPageUrl() }}"
                        class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-500 hover:bg-gray-50 flex items-center gap-2 {{ $surats->currentPage() == $surats->lastPage() ? 'opacity-50 pointer-events-none' : '' }}">
                            Selanjutnya <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
