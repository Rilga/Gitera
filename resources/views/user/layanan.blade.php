<x-app-layout>
    <div class="bg-gray-100 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- 1. HEADER & BACK LINK --}}
            <div class="space-y-4">
                <a href="{{ route('user.dashboard') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#00C07F] transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#00C07F] rounded-xl flex items-center justify-center text-white shadow-lg shadow-green-100 shrink-0">
                        <i class="fas fa-info-circle text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Info Layanan</h1>
                        <p class="text-sm text-gray-500">Kelurahan Banjarsari</p>
                        <p class="text-gray-600 mt-1 text-sm">Informasi lengkap persyaratan dan prosedur pelayanan administrasi kependudukan.</p>
                    </div>
                </div>
            </div>

            {{-- 2. HERO BANNER (HIJAU) --}}
            <div class="relative bg-gradient-to-r from-[#00C07F] to-teal-600 rounded-3xl p-8 md:p-10 text-white overflow-hidden shadow-xl shadow-green-100">
                <!-- Background Pattern -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full blur-2xl -ml-10 -mb-10"></div>
                
                <div class="relative z-10 max-w-3xl">
                    <div class="flex items-center gap-2 text-green-100 text-sm font-semibold mb-2">
                        <i class="fas fa-star text-yellow-300"></i> Layanan Administrasi Kependudukan
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-3 leading-tight">
                        Semua Layanan <span class="font-extrabold text-yellow-300">GRATIS</span>
                    </h2>
                    <p class="text-green-50 text-sm md:text-base mb-8 leading-relaxed max-w-2xl">
                        Tidak ada biaya yang dipungut untuk semua layanan administrasi kependudukan. Kami hadir untuk melayani masyarakat dengan sepenuh hati, transparan, dan akuntabel.
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30 text-sm font-medium">
                            <i class="fas fa-check-circle"></i> Proses Cepat
                        </div>
                        <div class="flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30 text-sm font-medium">
                            <i class="fas fa-shield-alt"></i> Data Aman
                        </div>
                        <div class="flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30 text-sm font-medium">
                            <i class="fas fa-smile"></i> Mudah Digunakan
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. KETENTUAN PENGGUNAAN (GRID BOX) --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                        <i class="fas fa-info text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Ketentuan Penggunaan Layanan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Item 1 -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-green-50 border border-green-100">
                        <i class="fas fa-check-circle text-green-600 mt-1 text-lg"></i>
                        <div>
                            <p class="text-sm text-gray-700 font-medium">Semua layanan administrasi kependudukan tidak dipungut biaya (GRATIS)</p>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-blue-50 border border-blue-100">
                        <i class="fas fa-file-alt text-blue-600 mt-1 text-lg"></i>
                        <div>
                            <p class="text-sm text-gray-700 font-medium">Pastikan melengkapi semua persyaratan dokumen sebelum mengajukan</p>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-orange-50 border border-orange-100">
                        <i class="fas fa-clock text-orange-600 mt-1 text-lg"></i>
                        <div>
                            <p class="text-sm text-gray-700 font-medium">Waktu proses bervariasi tergantung jenis layanan dan kelengkapan berkas</p>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-purple-50 border border-purple-100">
                        <i class="fas fa-user-shield text-purple-600 mt-1 text-lg"></i>
                        <div>
                            <p class="text-sm text-gray-700 font-medium">Data Anda dijamin aman dan terenkripsi sesuai standar keamanan nasional</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. KATALOG LAYANAN (DESIGN BEBAS - NO IMAGE) --}}
            <div>
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Jenis Layanan Tersedia</h3>
                    <p class="text-sm text-gray-500">Pilih layanan yang Anda butuhkan untuk melihat detail persyaratan</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Layanan 1: Kedatangan -->
                    <a href="{{ route('user.layanan.kedatangan') }}" class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg hover:border-blue-300 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl">GRATIS</div>
                        
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        
                        <h4 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">Pelayanan Kedatangan</h4>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Informasi lengkap untuk SKPWNI, KTP-el, dan Akta Lahir Pendatang.</p>
                        
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">SKPWNI</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">KTP-el</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">Akta</span>
                        </div>

                        <div class="flex items-center justify-between text-xs text-gray-400 border-t border-gray-100 pt-4">
                            <span><i class="far fa-clock mr-1"></i> 1-3 hari kerja</span>
                            <span class="text-blue-600 font-semibold group-hover:underline">Detail <i class="fas fa-arrow-right ml-1"></i></span>
                        </div>
                    </a>

                    <!-- Layanan 2: Perbaikan Data -->
                    <a href="{{ route('user.layanan.kelahiran') }}" class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg hover:border-green-300 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-[#00C07F] text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl">GRATIS</div>
                        
                        <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-edit"></i>
                        </div>
                        
                        <h4 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">Perbaikan Data Kelahiran</h4>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Prosedur perbaikan data akta kelahiran yang sudah diterbitkan jika ada kesalahan.</p>
                        
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">Perbaikan Nama</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">Tanggal</span>
                        </div>

                        <div class="flex items-center justify-between text-xs text-gray-400 border-t border-gray-100 pt-4">
                            <span><i class="far fa-clock mr-1"></i> 1-3 hari kerja</span>
                            <span class="text-green-600 font-semibold group-hover:underline">Detail <i class="fas fa-arrow-right ml-1"></i></span>
                        </div>
                    </a>

                    <!-- Layanan 3: Kepindahan -->
                    <a href="{{ route('user.layanan.kepindahan') }}" class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg hover:border-orange-300 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl">GRATIS</div>
                        
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-truck-moving"></i>
                        </div>
                        
                        <h4 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">Pelayanan Kepindahan</h4>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Informasi untuk SKPWNI dan KTP-el bagi penduduk yang pindah keluar daerah.</p>
                        
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">SKPWNI</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">Surat Pindah</span>
                        </div>

                        <div class="flex items-center justify-between text-xs text-gray-400 border-t border-gray-100 pt-4">
                            <span><i class="far fa-clock mr-1"></i> 1-3 hari kerja</span>
                            <span class="text-orange-600 font-semibold group-hover:underline">Detail <i class="fas fa-arrow-right ml-1"></i></span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- 5. INFORMASI PENTING (FOOTER ALERT) --}}
            <div class="bg-blue-50 rounded-2xl border border-blue-100 p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white text-lg shadow-md shrink-0">
                        <i class="fas fa-exclamation"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Informasi Penting</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-3 text-sm text-blue-900">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span>Semua layanan dapat diakses secara <span class="font-bold">online</span> melalui link website ini.</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-blue-900">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span>Layanan <span class="font-bold">offline</span> tersedia dengan datang langsung ke kantor Disdukcapil/Kelurahan.</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-blue-900">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span>Pastikan melengkapi <span class="font-bold">semua persyaratan</span> sebelum mengajukan permohonan.</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-blue-900">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span>Untuk informasi lebih lanjut, hubungi <span class="font-bold">customer service</span> kami di jam kerja.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>