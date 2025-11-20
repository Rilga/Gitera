<x-guest-layout>
    <!-- Container Utama -->
    <div class="flex min-h-screen w-full bg-white overflow-hidden">

        <!-- Bagian Kiri (Hijau) -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#1da746] flex-col justify-center px-12 relative text-white overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/asset/Login.png') }}" 
                    alt="Ilustrasi Background" 
                    class="w-full h-full object-cover object-center opacity-45 mix-blend-multiply">
                <div class="absolute inset-0 bg-gradient-to-b from-[#188D3C]/80 to-[#188D3C]/30"></div>
            </div>

            <!-- Logo -->
            <div class="absolute top-8 left-8 z-20 flex items-center gap-3">
                <img src="{{ asset('images/asset/logo-white.png') }}" alt="Logo SimpelBS" class="w-10 h-10 object-contain ml-5">
                <span class="text-2xl font-bold tracking-wide">SimpelBS</span>
            </div>

            <!-- Konten Teks -->
            <div class="relative z-20 mt-10">
                <h1 class="text-4xl font-bold leading-tight mb-4 drop-shadow-lg select-none">
                    Bergabung Bersama<br>
                    <span class="font-extrabold text-green-100">Masyarakat Digital</span><br>
                    Desa Banjarsari
                </h1>
                <p class="text-green-50 text-lg mb-8 font-light select-none">
                    Nikmati kemudahan layanan administrasi desa dalam satu genggaman.
                </p>
            </div>
        </div>

        <!-- Bagian Kanan (Putih): Form Register Wizard -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 md:px-20 lg:px-24 py-12 overflow-y-auto relative" x-data="{ step: 1 }">
            <div class="w-full max-w-lg mx-auto">
                
                <h2 class="text-3xl font-bold text-gray-900 mb-2 select-none">Daftar Akun Baru</h2>
                <p class="text-gray-500 text-sm mb-6 select-none select-none">
                    Lengkapi data diri Anda untuk membuat akun.
                </p>

                <!-- Progress Indicator -->
                <div class="flex items-center mb-8">
                    <!-- Step 1 -->
                    <div class="flex items-center text-[#1da746] relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-8 w-8 py-3 border-2 border-[#1da746] flex items-center justify-center" :class="{'bg-[#1da746] text-white': step >= 1}">
                            <span class="font-bold select-none">1</span>
                        </div>
                        <div class="absolute top-0 -ml-12 text-center mt-10 w-32 text-xs font-medium text-[#1da746] select-none">Akun</div>
                    </div>
                    <!-- Line -->
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out" :class="step === 2 ? 'border-[#1da746]' : 'border-gray-300'"></div>
                    <!-- Step 2 -->
                    <div class="flex items-center relative" :class="step === 2 ? 'text-[#1da746]' : 'text-gray-500'">
                        <div class="rounded-full transition duration-500 ease-in-out h-8 w-8 py-3 border-2 flex items-center justify-center" :class="step === 2 ? 'border-[#1da746] bg-[#1da746] text-white' : 'border-gray-300 bg-white'">
                            <span class="font-bold select-none">2</span>
                        </div>
                        <div class="absolute top-0 -ml-12 text-center mt-10 w-32 text-xs font-medium select-none" :class="step === 2 ? 'text-[#1da746]' : 'text-gray-500'">Data Diri</div>
                    </div>
                </div>

                <!-- Tambahkan novalidate di form agar browser tidak memblokir submit karena input hidden -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registerForm" novalidate>
                    @csrf

                    <!-- STEP 1: Akun -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        
                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1 select-none">Nama Lengkap</label>
                            <input id="name" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1da746] focus:border-transparent transition sm:text-sm" 
                                type="text" name="name" :value="old('name')" placeholder="Contoh: Budi Santoso" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1 select-none">Alamat Email</label>
                            <input id="email" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1da746] focus:border-transparent transition sm:text-sm" 
                                type="email" name="email" :value="old('email')" placeholder="nama@email.com" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4" x-data="{ show: false }">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1 select-none">Kata Sandi</label>
                                <div class="relative">
                                    <input id="password" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1da746] focus:border-transparent transition sm:text-sm" 
                                        :type="show ? 'text' : 'password'" name="password" placeholder="Min 8 karakter" required autocomplete="new-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1 select-none">Ulangi Sandi</label>
                                <div class="relative">
                                    <input id="password_confirmation" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1da746] focus:border-transparent transition sm:text-sm" 
                                        :type="show ? 'text' : 'password'" name="password_confirmation" placeholder="Ulangi sandi" required />
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <!-- Toggle Show Password -->
                            <div class="md:col-span-2 flex items-center">
                                <input type="checkbox" id="show_password" @click="show = !show" class="w-4 h-4 rounded border-gray-300 text-[#1da746] focus:ring-[#1da746]">
                                <label for="show_password" class="ml-2 text-xs text-gray-500 cursor-pointer select-none">Tampilkan Kata Sandi</label>
                            </div>
                        </div>

                        <!-- Tombol Lanjut (LOGIKA PERBAIKAN) -->
                        <div class="pt-4">
                            <button type="button" @click="
                                    const nameInput = document.getElementById('name');
                                    const emailInput = document.getElementById('email');
                                    const passInput = document.getElementById('password');
                                    const passConfInput = document.getElementById('password_confirmation');

                                    // Reset pesan validasi kustom
                                    passConfInput.setCustomValidity('');

                                    // Cek validitas per elemen
                                    let valid = true;

                                    if (!nameInput.checkValidity()) { nameInput.reportValidity(); valid = false; }
                                    else if (!emailInput.checkValidity()) { emailInput.reportValidity(); valid = false; }
                                    else if (!passInput.checkValidity()) { passInput.reportValidity(); valid = false; }
                                    else if (passInput.value !== passConfInput.value) {
                                        // Set pesan error kustom jika password tidak cocok
                                        passConfInput.setCustomValidity('Konfirmasi kata sandi tidak cocok.');
                                        passConfInput.reportValidity();
                                        valid = false;
                                    } else if (!passConfInput.checkValidity()) { passConfInput.reportValidity(); valid = false; }

                                    if (valid) {
                                        step = 2;
                                    }
                                " 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-[#1da746] hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1da746] transition duration-150 ease-in-out">
                                Selanjutnya <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: Data Diri -->
                    <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        
                        <!-- NIK -->
                        <div class="mb-4">
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-1 select-none">NIK (Nomor Induk Kependudukan)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                </div>
                                <input id="nik" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1da746] focus:border-transparent transition sm:text-sm font-mono" 
                                    type="text" name="nik" :value="old('nik')" placeholder="16 Digit NIK" required maxlength="16" />
                            </div>
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>

                        <!-- No HP -->
                        <div class="mb-6">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1 select-none">Nomor HP (WhatsApp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                </div>
                                <input id="no_hp" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1da746] focus:border-transparent transition sm:text-sm" 
                                    type="text" name="no_hp" :value="old('no_hp')" placeholder="Contoh: 0812xxxx" required />
                            </div>
                            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                        </div>

                        <!-- Tombol Navigasi -->
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="step = 1" class="w-1/3 flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1da746] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg> Kembali
                            </button>
                            <!-- Tambahkan logika validasi untuk tombol submit juga agar tidak kosong -->
                            <button type="submit" @click="
                                const nikInput = document.getElementById('nik');
                                const hpInput = document.getElementById('no_hp');
                                
                                if (!nikInput.checkValidity()) { nikInput.reportValidity(); return false; }
                                if (!hpInput.checkValidity()) { hpInput.reportValidity(); return false; }
                            " class="w-2/3 flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-[#1da746] hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1da746] transition duration-150 ease-in-out">
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 select-none">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="font-bold text-[#1da746] hover:text-green-800 underline">
                                Masuk di sini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>