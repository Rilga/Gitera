<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                Dashboard
            </h2>
            <p class="text-gray-500 text-sm mt-1">Sistem Informasi Pelayanan Banjarsari</p>
        </div>
    </x-slot>

    <div class="">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 flex flex-col gap-8">
                    
                    <div class="bg-white shadow-sm rounded-2xl p-6 border border-gray-100">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Monitoring Progress Pengajuan</h3>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm flex flex-col justify-between h-full">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-gray-900 leading-none">{{ $totalAkun }}</div>
                                        <div class="text-xs font-medium text-gray-500 mt-1">Total Akun</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-50 flex items-center text-xs text-green-600 font-medium">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                    <span class="font-bold mr-1">{{ $totalAkunPending }}</span> <span class="text-gray-500">perlu diverifikasi</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm flex flex-col justify-between h-full">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                          <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-gray-900 leading-none">{{ $suratBaru }}</div>
                                        <div class="text-xs font-medium text-gray-500 mt-1">Surat Masuk</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-50 flex items-center text-xs text-green-600 font-medium">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                    <span class="font-bold mr-1">{{ $suratBaru }}</span> <span class="text-gray-500">pengajuan baru</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm flex flex-col justify-between h-full">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-green-50 text-green-500 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-gray-900 leading-none">{{ $suratKeluar }}</div>
                                        <div class="text-xs font-medium text-gray-500 mt-1">Surat Keluar</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-50 flex items-center text-xs text-green-600 font-medium">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                    <span class="font-bold mr-1">{{ $suratKeluar }}</span> <span class="text-gray-500">berhasil keluar</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6 flex-1">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Pengajuan Surat Masuk</h3>
                            <div class="relative text-gray-400 focus-within:text-gray-600">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </span>
                                <input type="text" placeholder="Cari" class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-64 placeholder-gray-400">
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-900 font-bold uppercase bg-white border-b border-gray-100">
                                    <tr>
                                        <th class="px-4 py-4">ID Surat</th>
                                        <th class="px-4 py-4">Nama Pengaju</th>
                                        <th class="px-4 py-4">Kategori Surat</th>
                                        <th class="px-4 py-4">Tanggal</th>
                                        <th class="px-4 py-4">Status</th>
                                        <th class="px-4 py-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($recentSurats as $surat)
                                    <tr class="bg-white hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-4 py-5 font-medium text-gray-900">
                                            #{{ $surat->id }}
                                        </td>
                                        <td class="px-4 py-5">
                                            <div class="flex items-center">
                                                <img class="h-9 w-9 rounded-full object-cover mr-3 border border-gray-200" 
                                                     src="https://ui-avatars.com/api/?name={{ urlencode($surat->user->name) }}&background=random&color=fff" 
                                                     alt="{{ $surat->user->name }}">
                                                <span class="font-bold text-gray-900">{{ $surat->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-5 font-medium text-gray-900">
                                            {{ $surat->title }}
                                        </td>
                                        <td class="px-4 py-5 font-medium text-gray-900">
                                            {{ $surat->created_at->format('d-m-Y') }}
                                        </td>
                                        <td class="px-4 py-5">
                                            @if($surat->status == 'pending')
                                                <span class="inline-flex items-center bg-yellow-50 text-yellow-600 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <span class="w-2 h-2 mr-2 bg-yellow-500 rounded-full"></span> Pending
                                                </span>
                                            @elseif($surat->status == 'verified')
                                                <span class="inline-flex items-center bg-green-50 text-green-600 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <span class="w-2 h-2 mr-2 bg-green-500 rounded-full"></span> Disetujui
                                                </span>
                                            @elseif($surat->status == 'rejected')
                                                <span class="inline-flex items-center bg-red-50 text-red-600 text-xs font-bold px-3 py-1.5 rounded-full">
                                                    <span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span> Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-5">
                                            <a href="{{ route('admin.pengajuan.index') }}" class="text-green-500 hover:text-green-700 font-bold underline text-sm">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-5 text-center text-gray-500">Belum ada data pengajuan surat.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 bg-white shadow-sm rounded-2xl border border-gray-100 p-6 h-full flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Pengajuan Akun</h3>
                    
                    <div class="flex flex-col space-y-5 flex-1">
                        @forelse($recentAccounts as $account)
                        <div class="flex items-start justify-between border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                            <div class="flex items-start">
                                <img class="h-11 w-11 rounded-full object-cover mr-3 border border-gray-200 shrink-0" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode($account->name) }}&background=random&color=fff" 
                                     alt="{{ $account->name }}">
                                <div>
                                    <p class="text-sm font-bold text-gray-900 leading-snug">{{ $account->name }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $account->nik }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <p class="text-xs text-gray-400 font-medium mb-2">{{ $account->created_at->format('d M') }}</p>
                                <a href="{{ route('verification.list') }}" class="text-xs text-green-500 font-bold underline hover:text-green-700">Lihat Detail</a>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-sm text-gray-500 py-10">Tidak ada pengajuan akun baru.</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>