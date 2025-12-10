<x-app-layout>
    <div class="bg-gray-100 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Daftar Layanan</h1>
                    <p class="text-gray-500 mt-1">Temukan dan ajukan layanan administrasi desa yang Anda butuhkan.</p>
                </div>

                {{-- SEARCH --}}
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" 
                           id="searchLayanan" 
                           onkeyup="filterLayanan()" 
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out shadow-sm" 
                           placeholder="Cari layanan (contoh: KTP, Domisili)...">
                </div>
            </div>

            {{-- GRID LAYANAN --}}
            <div id="layananContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @php
                    $layananList = [
                        ['icon' => 'fa-truck-moving', 'color' => 'orange', 'title' => 'Kepindahan', 'slug' => 'kepindahan'],
                        ['icon' => 'fa-user-plus', 'color' => 'blue', 'title' => 'Kedatangan', 'slug' => 'kedatangan'],
                        ['icon' => 'fa-baby', 'color' => 'pink', 'title' => 'Akta Kelahiran', 'slug' => 'kelahiran'],
                        ['icon' => 'fa-book-dead', 'color' => 'gray', 'title' => 'Akta Kematian', 'slug' => 'kematian'],
                        ['icon' => 'fa-home', 'color' => 'green', 'title' => 'Surat Keterangan Domisili', 'slug' => 'domisili'],
                        ['icon' => 'fa-store', 'color' => 'purple', 'title' => 'Surat Keterangan Usaha', 'slug' => 'usaha'],
                        ['icon' => 'fa-hands-helping', 'color' => 'red', 'title' => 'Surat Keterangan Tidak Mampu', 'slug' => 'sktm'],
                        ['icon' => 'fa-money-bill-wave', 'color' => 'emerald', 'title' => 'Surat Keterangan Penghasilan', 'slug' => 'penghasilan'],
                        ['icon' => 'fa-id-card', 'color' => 'cyan', 'title' => 'Surat Keterangan KTP Sementara', 'slug' => 'ktp-sementara'],
                        ['icon' => 'fa-store-alt', 'color' => 'indigo', 'title' => 'Surat Keterangan Domisili Usaha', 'slug' => 'domisili-usaha'],
                        ['icon' => 'fa-file-contract', 'color' => 'yellow', 'title' => 'Pengantar Permohonan SKCK', 'slug' => 'skck'],
                        ['icon' => 'fa-briefcase', 'color' => 'slate', 'title' => 'Surat Tugas', 'slug' => 'tugas'],
                        ['icon' => 'fa-user-check', 'color' => 'lime', 'title' => 'Keterangan Berkelakuan Baik', 'slug' => 'kelakuan-baik'],
                        ['icon' => 'fa-search', 'color' => 'zinc', 'title' => 'Surat Keterangan Kehilangan', 'slug' => 'kehilangan'],
                        ['icon' => 'fa-id-badge', 'color' => 'rose', 'title' => 'Surat Keterangan Beda Identitas', 'slug' => 'beda-identitas'],
                        ['icon' => 'fa-user-shield', 'color' => 'sky', 'title' => 'Surat Izin Orang Tua', 'slug' => 'izin-orang-tua'],
                        ['icon' => 'fa-procedures', 'color' => 'stone', 'title' => 'Keterangan Penerimaan Jenazah', 'slug' => 'penerimaan-jenazah'],
                        ['icon' => 'fa-landmark', 'color' => 'green', 'title' => 'Surat Keterangan Desa', 'slug' => 'desa'],
                        ['icon' => 'fa-child', 'color' => 'amber', 'title' => 'Surat Keterangan Yatim', 'slug' => 'yatim'],
                        ['icon' => 'fa-ring', 'color' => 'pink', 'title' => 'Surat Keterangan Telah Menikah', 'slug' => 'telah-menikah'],
                        ['icon' => 'fa-cross', 'color' => 'gray', 'title' => 'Surat Keterangan Penguburan', 'slug' => 'penguburan'],
                        ['icon' => 'fa-users', 'color' => 'teal', 'title' => 'Surat Keterangan Ahli Waris', 'slug' => 'ahli-waris'],
                        ['icon' => 'fa-user-lock', 'color' => 'violet', 'title' => 'Surat Keterangan Bersih Diri', 'slug' => 'bersih-diri'],
                        ['icon' => 'fa-file-signature', 'color' => 'blue', 'title' => 'Pengantar Permohonan Izin', 'slug' => 'izin'],
                        ['icon' => 'fa-exclamation-triangle', 'color' => 'red', 'title' => 'Laporan Kejadian', 'slug' => 'laporan-kejadian'],
                        ['icon' => 'fa-heart-broken', 'color' => 'fuchsia', 'title' => 'Keterangan Belum Menikah', 'slug' => 'belum-menikah'],
                        ['icon' => 'fa-tag', 'color' => 'green', 'title' => 'Surat Keterangan Harga Tanah', 'slug' => 'harga-tanah'],
                        ['icon' => 'fa-history', 'color' => 'orange', 'title' => 'Surat Keterangan Riwayat Tanah', 'slug' => 'riwayat-tanah'],
                        ['icon' => 'fa-check-double', 'color' => 'cyan', 'title' => 'Ket. Tanah Tidak Sengketa', 'slug' => 'tanah-tidak-sengketa'],
                        ['icon' => 'fa-users-cog', 'color' => 'purple', 'title' => 'Surat Izin Rame-rame', 'slug' => 'izin-rame-rame'],
                    ];
                @endphp

                @foreach($layananList as $layanan)
                    <a href="{{ route('layanan.show', $layanan['slug']) }}"
                        class="layanan-item group bg-white rounded-2xl border border-gray-200 p-5 hover:shadow-lg hover:border-green-400 transition-all duration-300 flex flex-col justify-between h-full relative overflow-hidden">

                        {{-- BACKGROUND DECORATION --}}
                        <div class="absolute top-0 right-0 w-16 h-16 bg-{{ $layanan['color'] }}-50 rounded-bl-full -mr-8 -mt-8 transition-all group-hover:scale-150 group-hover:bg-{{ $layanan['color'] }}-100"></div>

                        <div>
                            {{-- ICON --}}
                            <div class="w-12 h-12 rounded-xl bg-{{ $layanan['color'] }}-50 text-{{ $layanan['color'] }}-600 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform shadow-sm border border-{{ $layanan['color'] }}-100">
                                <i class="fas {{ $layanan['icon'] }}"></i>
                            </div>

                            {{-- TITLE --}}
                            <h3 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors line-clamp-2 text-sm md:text-base">
                                {{ $layanan['title'] }}
                            </h3>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center">
                            <span class="text-xs text-gray-400 font-medium group-hover:text-green-500 transition-colors">
                                Ajukan Sekarang
                            </span>
                            <div class="w-6 h-6 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-green-500 group-hover:text-white transition-all">
                                <i class="fas fa-arrow-right text-xs"></i>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- NO RESULT MESSAGE --}}
            <div id="noResult" class="hidden text-center py-12">
                <div class="inline-block p-4 rounded-full bg-gray-100 text-gray-400 mb-3">
                    <i class="fas fa-search text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Layanan tidak ditemukan</h3>
                <p class="text-gray-500">Coba kata kunci lain atau hubungi admin desa.</p>
            </div>

        </div>
    </div>

    {{-- SEARCH FUNCTION --}}
    <script>
        function filterLayanan() {
            let input = document.getElementById('searchLayanan');
            let filter = input.value.toUpperCase();
            let container = document.getElementById('layananContainer');
            let items = container.getElementsByClassName('layanan-item');
            let noResult = document.getElementById('noResult');
            let visibleCount = 0;

            for (let i = 0; i < items.length; i++) {
                let title = items[i].getElementsByTagName("h3")[0];
                let txtValue = title.textContent || title.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    items[i].style.display = "";
                    visibleCount++;
                } else {
                    items[i].style.display = "none";
                }
            }

            noResult.classList.toggle('hidden', visibleCount !== 0);
        }
    </script>
</x-app-layout>
