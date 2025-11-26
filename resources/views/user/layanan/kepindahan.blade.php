<x-app-layout>
    <div class="bg-gray-100 min-h-screen font-sans">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- 1. BACK LINK --}}
            <div>
                <a href="{{ route('user.layanan') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#00C07F] transition-colors font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Info Layanan
                </a>
            </div>

            {{-- 2. HERO HEADER (BIRU TERANG) --}}
            <div class="bg-[#1d4ed8] rounded-2xl p-8 text-white shadow-lg shadow-blue-100 relative overflow-hidden">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mr-10 -mt-10"></div>
                
                <div class="relative z-10 flex items-start gap-6">
                    <!-- Icon Box -->
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-[#1d4ed8] text-3xl shadow-sm flex-shrink-0">
                        <i class="fas fa-file-export"></i>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="flex-1">
                        <p class="text-blue-100 text-xs font-bold tracking-wider uppercase mb-1">Disdukcapil Kabupaten Garut</p>
                        <h1 class="text-2xl md:text-3xl font-bold mb-4">Pelayanan Kepindahan</h1>
                        
                        <div class="inline-flex items-center px-4 py-1.5 rounded-lg bg-white/20 border border-white/20 backdrop-blur-sm text-xs font-medium">
                            Layanan administrasi kependudukan tidak dipungut biaya/gratis
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. CARD: PERSYARATAN --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center text-xl">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Persyaratan Kepindahan:</h2>
                </div>

                <ul class="space-y-4 ml-1">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Formulir Kepindahan F-1.03 (dapat di download di menu formulir persyaratan);</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Fotokopi Kartu Keluarga;</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Fotokopi KTP-el;</span>
                    </li>
                    
                    <!-- Nested List: Status Dibawah Umur -->
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1 flex-shrink-0"></i>
                        <div class="flex-1">
                            <span class="text-gray-700 text-sm block mb-2">Jika Status dibawah umur:</span>
                            <ul class="pl-2 border-l-2 border-gray-100 ml-1 space-y-2">
                                <li class="flex items-start gap-2 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5 flex-shrink-0"></span>
                                    <span>Surat Pernyataan Izin dari Orangtua/Wali yang telah ditandatangani di atas materai Rp.10.000,-;</span>
                                </li>
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                    KTP Orangtua/Wali.
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">E-mail dan No. Telp Aktif.</span>
                    </li>
                </ul>
            </div>

            {{-- 4. CARD: MEKANISME PROSEDUR --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Mekanisme Prosedur:</h2>
                </div>

                <ul class="space-y-4 ml-1">
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Pemohon adalah yang bersangkutan/ tidak diwakilkan;</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Pemohon mengisi, menandatangani formulir dan memberikan persyaratan;</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Petugas pelayanan melakukan verifikasi berkas persyaratan;</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Petugas pelayanan melakukan proses penginputan data ke dalam Sistem Informasi Administrasi Kependudukan;</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Pejabat menandatangani dengan proses Tanda Tangan Elektronik;</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Petugas menerbitkan Surat Keterangan Pindah WNI (SKPWNI) menginformasikan status kepindahan yang selesai diproses kepada pemohon;</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">SKPWNI disampaikan kepada pemohon.</span>
                    </li>
                </ul>
            </div>

            {{-- 5. CARD: SISTEM PENGAJUAN --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                        <i class="fas fa-link"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Sistem Pengajuan:</h2>
                </div>

                <ul class="space-y-4 ml-1">
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">
                            Pelayanan online melalui link <a href="https://pastioke.garutkab.go.id" class="text-blue-600 hover:underline font-medium">pastioke.garutkab.go.id</a>
                        </span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="far fa-check-circle text-gray-400 mt-1 flex-shrink-0"></i>
                        <span class="text-gray-700 text-sm">Pelayanan offline dengan datang langsung ke kantor Disdukcapil</span>
                    </li>
                </ul>
            </div>

            {{-- 6. CARD: BUTUH BANTUAN (HIJAU) --}}
            <div class="bg-[#00a86b] rounded-2xl p-8 text-center text-white shadow-lg shadow-green-100">
                <h3 class="text-xl font-bold mb-2">Butuh Bantuan?</h3>
                <p class="text-green-50 text-sm mb-6 max-w-lg mx-auto">
                    Hubungi customer service kami untuk informasi lebih lanjut atau bantuan pengisian formulir
                </p>
                <a href="#" class="inline-flex items-center px-6 py-2.5 bg-white text-[#00a86b] rounded-lg font-bold text-sm hover:bg-green-50 transition shadow-sm">
                    Hubungi CS
                </a>
            </div>

        </div>
    </div>
</x-app-layout>