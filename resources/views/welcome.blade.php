<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SimpelBS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="antialiased text-gray-600 bg-white">

        <!-- NAVBAR -->
        <nav class="fixed w-full z-50 bg-transparent transition-all duration-300 pt-6" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)" :class="{ 'bg-white/90 backdrop-blur-md shadow-sm py-4': scrolled, 'pt-6': !scrolled }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <!-- Icon Logo (Simulasi Logo di Gambar) -->
                        <img src="{{ asset('asset/logo-coloured.png') }}" alt="Logo SimpelBS" class="w-12 h-12 object-contain">
                        <div class="leading-tight">
                            <span class="font-bold text-xl text-gray-900 block">SimpelBS</span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-wider font-medium pl-0.5">Sistem Pelayanan Banjarsari</span>
                        </div>
                    </div>

                    <!-- Right Side Buttons -->
                    <div class="hidden md:flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 text-sm font-bold text-white bg-green-700 rounded-lg hover:bg-green-800 transition shadow-lg">Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-lg hover:border-green-600 hover:text-green-600 transition">Daftar</a>
                                <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-white bg-green-700 rounded-lg hover:bg-green-800 transition shadow-md">Masuk</a>
                            @endif
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button class="text-gray-500 hover:text-green-700 focus:outline-none p-2">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden">
            
            <!-- Background Image Layer (Right Side) -->
            <div class="absolute top-0 right-0 w-3/4 h-full z-0">
                <!-- Gambar Pelayanan Desa -->
                <img src="{{ asset('asset/LandingPage1.png') }}" 
                     alt="Background Pelayanan" 
                     class="w-full h-full object-cover hero-fade-mask opacity-70">
            </div>

            <!-- White Gradient Overlay (Left to Right) -->
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-transparent z-0 w-full md:w-2/3"></div>
            
            <!-- Bottom Fade for Smooth Transition -->
            <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>

            <!-- Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full pt-20">
                <div class="grid lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Content (Text) -->
                    <div class="lg:col-span-6 space-y-8">
                        <!-- Badge (Kuning Muda) -->
                        <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-orange-50 text-orange-600 text-xs font-bold shadow-sm border border-orange-100/50">
                            <i class="fas fa-paper-plane"></i> <span>Pengajuan mudah dan cepat</span>
                        </div>
                        
                        <!-- Heading (Besar & Tebal) -->
                        <h1 class="text-5xl lg:text-5xl font-extrabold text-gray-900 leading-[1.15]">
                            Sistem Informasi <br>
                            Pelayanan <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-800 to-green-600">Banjarsari</span>
                        </h1>
                        
                        <!-- Description -->
                        <p class="text-base text-gray-500 leading-relaxed max-w-lg">
                            SimpelBS memudahkan warga Banjarsari dalam mengajukan berbagai layanan administrasi desa secara online sehingga proses menjadi lebih cepat, transparan, dan efisien.
                        </p>
                        
                        <!-- CTA Button (Hijau Tua, Kotak Rounded) -->
                        <div class="pt-2">
                            <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-8 py-4 text-sm font-bold text-white bg-green-700 rounded-xl shadow-xl shadow-green-900/20 hover:bg-green-800 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 w-full sm:w-auto">
                                Mulai Ajukan Surat
                            </a>
                        </div>
                    </div>

                    <!-- Right Content (Kosong untuk visual gambar background, tapi ada Floating Cards) -->
                    <div class="lg:col-span-6 relative h-full min-h-[400px] hidden lg:block pointer-events-none">
                        
                        <!-- Floating Card 1 (Surat Selesai) - Posisi Kanan Atas -->
                        <div class="absolute top-20 right-10 bg-white p-4 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] flex items-center gap-4 animate-bounce-slow max-w-xs z-20 border border-gray-50">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl shrink-0">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Surat Selesai</p>
                                <p class="text-green-700 font-bold text-sm">+24 Hari Ini</p>
                            </div>
                        </div>

                        <!-- Floating Card 2 (Pengajuan Hari Ini) - Posisi Bawah Tengah -->
                        <div class="absolute bottom-20 left-20 bg-white p-4 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] flex items-center gap-4 animate-pulse-slow max-w-xs z-20 border border-gray-50">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl shrink-0">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Pengajuan Hari Ini</p>
                                <p class="text-green-700 font-bold text-sm">+94 Hari Ini</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- PLATFORM INFO SECTION (Gambar Kiosk) -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                     <!-- Image Left -->
                     <div class="order-2 lg:order-1 relative">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                             <!-- Ganti dengan gambar orang pakai tablet/kiosk -->
                            <img src="{{ asset('asset/LandingPage2.png') }}" alt="Digital Platform" class="w-full h-full object-cover">
                        </div>
                        <!-- Green Box Decoration -->
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-400 rounded-2xl -z-10"></div>
                        <div class="absolute -top-6 -left-6 w-32 h-32 border-4 border-gray-200 rounded-full -z-10"></div>
                    </div>

                    <!-- Content Right -->
                    <div class="order-1 lg:order-2">
                        <div class="inline-block px-4 py-1 rounded-full border border-green-200 bg-green-50 text-green-600 text-sm font-bold mb-4">
                        Tentang SimpelBS
                        </div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Platform Pelayanan Digital untuk Desa Modern</h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            SimpelBS (Sistem Pelayanan Banjarsari) adalah platform digital yang menyatukan warga dengan pemerintah desa. Kami hadir untuk mengubah proses administrasi manual menjadi digital yang serba cepat.
                        </p>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Sistem ini mendukung validasi data kependudukan secara real-time, memastikan setiap permohonan surat diproses dengan akurat. Tidak perlu lagi bolak-balik kantor desa untuk urusan yang bisa selesai dari rumah.
                        </p>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-3 gap-8 border-t border-gray-200 pt-8">
                            <div>
                                <h4 class="text-3xl font-bold text-green-600">500+</h4>
                                <p class="text-sm text-gray-500 mt-1">Warga Terdaftar</p>
                            </div>
                            <div>
                                <h4 class="text-3xl font-bold text-green-600">1,200+</h4>
                                <p class="text-sm text-gray-500 mt-1">Surat Diproses</p>
                            </div>
                            <div>
                                <h4 class="text-3xl font-bold text-green-600">98%</h4>
                                <p class="text-sm text-gray-500 mt-1">Kepuasan Warga</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES SECTION -->
        <section id="fitur" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-block px-4 py-1 rounded-full border border-green-200 bg-green-50 text-green-600 text-sm font-bold mb-4">
                        Fitur Unggulan
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Utama SimpelBS</h2>
                    <p class="text-gray-500">Berbagai fitur modern yang memudahkan urusan administrasi desa Anda.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:border-green-100 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-green-600 text-2xl mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pengajuan Surat Online</h3>
                        <p class="text-gray-500 leading-relaxed text-sm">Warga dapat mengajukan berbagai jenis surat dari mana saja dan kapan saja tanpa antri.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:border-blue-100 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Tracking Status Pengajuan</h3>
                        <p class="text-gray-500 leading-relaxed text-sm">Pantau proses pembuatan surat secara real-time, mulai dari verifikasi hingga selesai.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:border-yellow-100 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center text-yellow-600 text-2xl mb-6 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Notifikasi Otomatis</h3>
                        <p class="text-gray-500 leading-relaxed text-sm">Sistem akan mengirimkan pemberitahuan (Email/WA) ketika status surat berubah.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:border-orange-100 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600 text-2xl mb-6 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                            <i class="fas fa-history"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Riwayat Layanan</h3>
                        <p class="text-gray-500 leading-relaxed text-sm">Menyimpan data aktivitas pengajuan surat yang pernah dilakukan sebagai arsip pribadi.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:border-teal-100 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-teal-100 flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Verifikasi Dokumen Cepat</h3>
                        <p class="text-gray-500 leading-relaxed text-sm">Memastikan setiap berkas yang masuk valid dan diproses dengan standar yang tepat.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:border-red-100 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center text-red-600 text-2xl mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Data Terjamin</h3>
                        <p class="text-gray-500 leading-relaxed text-sm">Data pribadi warga disimpan dengan aman menggunakan standar keamanan informasi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- HOW IT WORKS (HIJAU) -->
        <section id="cara-kerja" class="py-24 bg-green-700 text-white relative overflow-hidden">
            <!-- Decorative Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <div class="inline-block px-4 py-1 rounded-full bg-green-600/50 border border-green-500 text-green-100 text-sm font-bold mb-4">
                        Cara Kerja
                    </div>
                    <h2 class="text-4xl font-bold mb-4">Cara Kerja SimpelBS</h2>
                    <p class="text-green-100">Empat langkah mudah untuk menyelesaikan urusan administrasi Anda.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="relative bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-green-500/30 hover:bg-white/20 transition duration-300 group">
                        <div class="absolute -top-4 -right-4 w-10 h-10 bg-white text-green-700 rounded-full flex items-center justify-center font-bold shadow-lg border-4 border-green-800 z-20">01</div>
                        <div class="mb-6 text-green-300 text-4xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Daftar Akun</h3>
                        <p class="text-green-100 text-sm leading-relaxed">Buat akun baru menggunakan NIK dan data diri yang valid agar terdaftar di sistem.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-green-500/30 hover:bg-white/20 transition duration-300 group">
                        <div class="absolute -top-4 -right-4 w-10 h-10 bg-white text-green-700 rounded-full flex items-center justify-center font-bold shadow-lg border-4 border-green-800 z-20">02</div>
                        <div class="mb-6 text-green-300 text-4xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Pilih Jenis Surat</h3>
                        <p class="text-green-100 text-sm leading-relaxed">Pilih surat yang Anda butuhkan dari katalog layanan yang tersedia di dashboard.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-green-500/30 hover:bg-white/20 transition duration-300 group">
                        <div class="absolute -top-4 -right-4 w-10 h-10 bg-white text-green-700 rounded-full flex items-center justify-center font-bold shadow-lg border-4 border-green-800 z-20">03</div>
                        <div class="mb-6 text-green-300 text-4xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Lengkapi Formulir</h3>
                        <p class="text-green-100 text-sm leading-relaxed">Isi formulir digital dengan data yang diperlukan dan unggah berkas pendukung.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-green-500/30 hover:bg-white/20 transition duration-300 group">
                        <div class="absolute -top-4 -right-4 w-10 h-10 bg-white text-green-700 rounded-full flex items-center justify-center font-bold shadow-lg border-4 border-green-800 z-20">04</div>
                        <div class="mb-6 text-green-300 text-4xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-download"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Terima Dokumen</h3>
                        <p class="text-green-100 text-sm leading-relaxed">Notifikasi dikirim saat surat selesai. Unduh surat digital atau ambil di kantor desa.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- BENEFITS SECTION -->
        <section id="manfaat" class="py-24 bg-white">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-block px-4 py-1 rounded-full border border-green-200 bg-green-50 text-green-600 text-sm font-bold mb-4">
                        Manfaat
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Manfaat untuk Warga & Desa</h2>
                    <p class="text-gray-500">SimpelBS memberikan keuntungan bagi seluruh pihak yang terlibat.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Manfaat Warga -->
                    <div class="p-8 rounded-3xl bg-green-50 border border-green-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-green-600 flex items-center justify-center text-white text-xl">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Untuk Warga</h3>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Tidak perlu antri lama di kantor desa</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Hemat waktu dan tenaga (biaya transportasi)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Proses lebih jelas, transparan, dan terpantau</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Akses mudah dari HP / Laptop 24 Jam</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Manfaat Desa -->
                    <div class="p-8 rounded-3xl bg-orange-50 border border-orange-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-orange-500 flex items-center justify-center text-white text-xl">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Untuk Desa</h3>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Administrasi lebih rapi dan terdigitalisasi</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Proses surat menyurat lebih cepat & efisien</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Database/Arsip warga tersimpan aman</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                                <span class="text-gray-600 font-medium">Mengurangi beban administrasi manual staf desa</span>
                            </li>
                        </ul>
                    </div>
                </div>
             </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-[#1f7a38] text-white py-8 mt-auto border-t border-[#268c42]">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    
                    <!-- Bagian Kiri: Logo & Navigasi -->
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <!-- Logo -->
                        <div class="flex items-center gap-3">
                             <!-- Ikon Logo Putih -->
                             <!-- Saya menggunakan fa-paper-plane sebagai placeholder logo, bisa diganti img -->
                             <img src="{{ asset('asset/Logo-white.png') }}" 
                                alt="Logo SimpelBS" 
                                class="h-10 w-auto object-contain">
                             <span class="font-bold text-3xl tracking-tight">SimpelBS</span>
                        </div>

                        <!-- Garis Pemisah (Vertical Divider) - Hidden di Mobile -->
                        <div class="hidden md:block h-8 w-px bg-white/50"></div>

                        <!-- Menu Links -->
                        <div class="flex gap-6 text-sm font-medium">
                            <a href="#" class="hover:text-green-200 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-green-200 transition-colors">Hubungi Kami</a>
                        </div>
                    </div>

                    <!-- Bagian Kanan: Copyright -->
                    <div class="text-sm font-medium text-center md:text-right">
                        &copy; 2025 Sistem Pelayanan Banjarsari. All Rights Reserved.
                    </div>
                </div>
             </div>
        </footer>

    </body>
</html>