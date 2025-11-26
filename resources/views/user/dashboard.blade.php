<x-app-layout>
    {{-- Header default dihapus karena desain ini memiliki header sendiri di dalam konten --}}
    
    <div class="bg-gray-100 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- SECTION 1: WELCOME HEADER --}}
            <div class="bg-[#00C07F] rounded-3xl p-6 md:p-8 relative overflow-hidden shadow-lg shadow-green-100">
                
                <!-- Background Image Overlay (Right Side) -->
                <div class="absolute top-0 right-0 w-2/5 h-full hidden md:block">
                    <!-- Ganti URL ini dengan gambar petugas desa/kantor yang sesuai -->
                    <img src="{{ asset('images/asset/LandingPage1.png') }}" 
                        alt="Petugas Desa" 
                        class="w-full h-full object-cover object-center mix-blend-multiply opacity-50 filter grayscale ">
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-[#00C07F] via-[#00C07F]/25 to-transparent"></div>
                </div>

                <div class="relative z-10 max-w-2xl text-white">
                    <!-- Top Badge/Label (Margin bottom dikurangi: mb-4 -> mb-2) -->
                    <div class="flex items-center gap-2 mb-2 text-green-50 text-xs font-medium uppercase tracking-wider">
                        <i class="fas fa-hand-sparkles text-yellow-300"></i>
                        <span>Selamat Datang di Portal Pelayanan Desa</span>
                    </div>

                    <!-- Main Heading (Ukuran font sedikit dikurangi agar tidak memakan tinggi) -->
                    <h1 class="text-3xl md:text-4xl font-bold mb-3 leading-tight">
                        Halo, <span class="text-white">{{ Auth::user()->name }}!</span>
                    </h1>

                    <!-- Description (Margin bottom dikurangi: mb-8 -> mb-6) -->
                    <p class="text-green-50 text-sm md:text-base mb-6 leading-relaxed max-w-lg">
                        Kelola pengajuan surat administrasi Anda dengan mudah dan cepat. Layanan kami tersedia untuk membantu kebutuhan dokumen Anda.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <!-- Button 1: Ajukan Surat Baru (Padding dikurangi sedikit: py-3 -> py-2.5) -->
                        <a href="#" class="inline-flex items-center px-5 py-2.5 bg-white text-[#00C07F] rounded-full font-bold text-sm shadow-md hover:bg-green-50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-file-alt mr-2"></i> Ajukan Surat Baru
                        </a>

                        <!-- Button 2: Cek Status (Outline) -->
                        <a href="#" class="inline-flex items-center px-5 py-2.5 bg-transparent border border-white/40 text-white rounded-full font-semibold text-sm hover:bg-white/10 transition-all duration-300">
                            <i class="fas fa-history mr-2"></i> Cek Status
                        </a>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: STATS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card 1: Pengajuan Aktif (Hijau) -->
                <div class="bg-white rounded-2xl p-5 text-gray-800 relative overflow-hidden shadow-sm border border-gray-100 hover:-translate-y-1 transition">
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-green-100 text-green-600 rounded-lg backdrop-blur-sm">
                            <i class="fas fa-file-alt text-xl"></i>
                        </div>
                        <span class="bg-green-100 text-[10px] text-green-600 font-bold px-2 py-1 rounded backdrop-blur-sm">Baru</span>
                    </div>
                    <div class="mt-3 ml-1"> <!-- Margin top dikurangi agar lebih pendek -->
                        <h2 class="text-3xl font-bold">2</h2>
                        <p class="text-gray-500 text-sm font-medium">Pengajuan Aktif</p>
                    </div>
                </div>

                <!-- Card 2: Total Pengajuan (Putih dengan Aksen Orange) -->
                <div class="bg-white rounded-2xl p-5 text-gray-800 relative overflow-hidden shadow-sm border border-gray-100 transition hover:-translate-y-1">
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-orange-50 text-orange-500 rounded-lg">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-1 rounded">Selesai</span>
                    </div>
                    <div class="mt-3 ml-1">
                        <h2 class="text-3xl font-bold text-gray-900">5</h2>
                        <p class="text-gray-500 text-sm font-medium">Total Pengajuan Surat</p>
                    </div>
                </div>

                <!-- Card 3: Info Layanan (Biru) -->
                <div class="bg-[#2563eb] rounded-2xl p-5 text-white relative overflow-hidden shadow-md transition hover:-translate-y-1 cursor-pointer group">
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                            <i class="fas fa-info text-xl w-5 h-5 flex items-center justify-center"></i>
                        </div>
                    </div>
                    <div class="mt-6 relative z-10">
                        <h2 class="text-lg font-bold">Info Layanan</h2>
                        <a href="{{ route('user.layanan') }}" class="text-blue-100 text-xs mt-1 inline-flex items-center hover:text-white transition">
                            Lihat persyaratan lengkap <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                    <!-- Dekorasi Wave Halus -->
                    <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-black/10 to-transparent"></div>
                </div>
            </div>

            {{-- SECTION 3: INFO BOX --}}
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex gap-4 items-start">
                <div class="flex-shrink-0 text-blue-600 mt-1">
                    <i class="fas fa-info-circle text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-2">Ketentuan Penggunaan Layanan</h3>
                    <ul class="list-disc list-inside text-sm text-gray-600 space-y-1 marker:text-blue-500">
                        <li>Pastikan data yang Anda masukkan sudah benar dan sesuai dengan dokumen resmi</li>
                        <li>Lampirkan dokumen pendukung yang diperlukan (KTP, KK, dll)</li>
                        <li>Proses verifikasi memakan waktu 1-3 hari kerja</li>
                        <li>Anda akan mendapat notifikasi saat surat selesai diproses</li>
                    </ul>
                </div>
            </div>

            {{-- SECTION 4: PILIH JENIS SURAT --}}
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-900">Pilih Jenis Surat</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Surat 1: Domisili -->
                    <a href="#" class="group bg-white p-6 rounded-2xl border border-gray-100 hover:border-[#00C07F] hover:shadow-md transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center text-xl group-hover:bg-[#00C07F] group-hover:text-white transition-colors">
                                <i class="fas fa-home"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 group-hover:text-[#00C07F] transition-colors">Surat Keterangan Domisili</h3>
                                <p class="text-xs text-gray-500 mt-1">Untuk membuktikan tempat tinggal</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-[#00C07F] transition-colors"></i>
                    </a>

                    <!-- Surat 2: Pengantar RT/RW -->
                    <a href="#" class="group bg-white p-6 rounded-2xl border border-gray-100 hover:border-blue-500 hover:shadow-md transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 group-hover:text-blue-500 transition-colors">Surat Pengantar RT/RW</h3>
                                <p class="text-xs text-gray-500 mt-1">Surat pengantar dari RT/RW</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                    </a>

                    <!-- Surat 3: Keterangan Usaha -->
                    <a href="#" class="group bg-white p-6 rounded-2xl border border-gray-100 hover:border-purple-500 hover:shadow-md transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl group-hover:bg-purple-500 group-hover:text-white transition-colors">
                                <i class="fas fa-store"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 group-hover:text-purple-500 transition-colors">Surat Keterangan Usaha</h3>
                                <p class="text-xs text-gray-500 mt-1">Untuk keperluan usaha</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-purple-500 transition-colors"></i>
                    </a>

                    <!-- Surat 4: Akta Kelahiran -->
                    <a href="#" class="group bg-white p-6 rounded-2xl border border-gray-100 hover:border-pink-500 hover:shadow-md transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center text-xl group-hover:bg-pink-500 group-hover:text-white transition-colors">
                                <i class="fas fa-baby"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 group-hover:text-pink-500 transition-colors">Akta Kelahiran</h3>
                                <p class="text-xs text-gray-500 mt-1">Surat keterangan kelahiran</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-pink-500 transition-colors"></i>
                    </a>

                    <!-- Surat 5: Tidak Mampu -->
                    <a href="#" class="group bg-white p-6 rounded-2xl border border-gray-100 hover:border-orange-500 hover:shadow-md transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl group-hover:bg-orange-500 group-hover:text-white transition-colors">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 group-hover:text-orange-500 transition-colors">Surat Keterangan Tidak Mampu</h3>
                                <p class="text-xs text-gray-500 mt-1">Untuk keperluan bantuan</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-orange-500 transition-colors"></i>
                    </a>

                    <!-- Surat 6: Pindah -->
                    <a href="#" class="group bg-white p-6 rounded-2xl border border-gray-100 hover:border-teal-500 hover:shadow-md transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center text-xl group-hover:bg-teal-500 group-hover:text-white transition-colors">
                                <i class="fas fa-truck-moving"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 group-hover:text-teal-500 transition-colors">Surat Keterangan Pindah</h3>
                                <p class="text-xs text-gray-500 mt-1">Untuk keperluan pindah domisili</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-teal-500 transition-colors"></i>
                    </a>

                </div>
            </div>

            {{-- SECTION 5: PENGAJUAN TERBARU --}}
            <div class="space-y-6 pb-10">
                <div class="flex justify-between items-end">
                    <h2 class="text-2xl font-bold text-gray-900">Pengajuan Terbaru</h2>
                    <a href="#" class="text-[#00C07F] font-semibold hover:underline text-sm">Lihat Semua</a>
                </div>
                
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
                    
                    <!-- Item 1 -->
                    <div class="p-6 flex items-center justify-between border-b border-gray-50 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-green-50 text-[#00C07F] flex items-center justify-center">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Akta Kelahiran</h4>
                                <p class="text-xs text-gray-500">#U1323 • 20-11-2025</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-bold">Diproses</span>
                    </div>

                    <!-- Item 2 -->
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-green-50 text-[#00C07F] flex items-center justify-center">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Surat Domisili</h4>
                                <p class="text-xs text-gray-500">#U1324 • 18-11-2025</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-bold">Selesai</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>