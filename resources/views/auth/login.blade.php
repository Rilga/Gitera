<x-guest-layout>
    <!-- Container Utama: Flexbox untuk Split Screen -->
    <div class="flex min-h-screen bg-white overflow-hidden">

        <!-- Bagian Kiri (Hijau) -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#1da746] flex-col justify-center px-12 relative text-white overflow-hidden">
            
            <!-- Background Image Layer (Full Cover) -->
            <!-- PERBAIKAN DISINI: Menggunakan inset-0 agar gambar memenuhi seluruh area div hijau -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('asset/Login.png') }}" 
                    alt="Ilustrasi Background" 
                    class="w-full h-full object-cover object-center opacity-45 mix-blend-multiply">
                <!-- Overlay gradient agar teks tetap terbaca jelas di atas gambar -->
                <div class="absolute inset-0 bg-gradient-to-b from-[#188D3C]/80 to-[#188D3C]/30"></div>
            </div>

            <!-- Logo SuratKu (Pojok Kiri Atas) -->
            <div class="absolute top-8 left-8 z-20 flex items-center gap-3">
                <img src="{{ asset('asset/Logo-white.png') }}" alt="Logo SimpelBS" class="w-10 h-10 object-contain ml-5">
                <span class="text-2xl font-bold tracking-wide">SimpelBS</span>
            </div>
            <!-- Konten Teks Tengah -->
            <div class="relative z-20 mt-10">
                <h1 class="text-5xl font-bold leading-tight mb-6 drop-shadow-lg select-none">
                    Pengajuan Surat<br>
                    Pengantar <span class="font-extrabold text-green-50">Online, Praktis</span><br>
                    <span class="font-extrabold text-green-50">dan Efisien!</span>
                </h1>
                
                <!-- Tombol -->
                <div onclick="document.getElementById('email').focus()"
                    class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-md border border-white/40 rounded-full text-white font-semibold hover:bg-white/30 transition cursor-default shadow-lg select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                    </svg>
                    Ajukan Sekarang
                </div>
            </div>
        </div>

        <!-- Bagian Kanan (Putih): Form Login -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 md:px-20 lg:px-32 py-12">
            <div class="w-full max-w-md mx-auto">
                
                <!-- Header Form -->
                <h2 class="text-3xl font-bold text-gray-900 mb-2 select-none">Ajukan Surat Pengantar</h2>
                <p class="text-gray-500 text-sm mb-10 select-none">
                    Masukkan kredensial untuk mengakses akun Anda!
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1 select-none">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Icon Amplop -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out sm:text-sm" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                placeholder="Masukkan Email"
                                required autofocus autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Input Password -->
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1 select-none">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Icon Gembok -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            
                            <input id="password" 
                                class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out sm:text-sm" 
                                :type="show ? 'text' : 'password'"
                                name="password"
                                placeholder="Masukkan Kata Sandi"
                                required autocomplete="current-password" />

                            <!-- Toggle Visibility -->
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600" @click="show = !show">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" style="display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Checkbox Syarat & Ketentuan -->
                    <div class="flex items-center">
                        <input id="terms" type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <label for="terms" class="ml-2 block text-sm text-gray-500 select-none">
                            Saya setuju dengan <a href="#" class="text-green-600 font-semibold hover:underline">Syarat & Ketentuan</a>
                        </label>
                    </div>

                    <!-- Tombol Login -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#1da746] hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Register Link (Opsional) -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 select-none">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-500">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>