<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fas fa-user-circle text-green-600"></i>
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Grid Layout: 1 Kolom di Mobile, 3 Kolom di Desktop -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- KOLOM KIRI: Profil & Navigasi -->
                <!-- Perubahan: lg:sticky lg:top-24 (Hanya sticky di desktop) -->
                <div class="lg:col-span-1 lg:sticky lg:top-24 space-y-6">
                    
                    <!-- Kartu Profil -->
                    <div class="p-6 bg-white shadow-lg rounded-3xl border border-gray-100 text-center relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-r from-green-400 to-green-600"></div>
                        
                        <div class="relative z-10 -mt-2">
                            <div class="w-24 h-24 mx-auto bg-white p-1 rounded-full shadow-md">
                                <img class="w-full h-full rounded-full object-contain border-2 border-gray-100 group-hover:border-[#00C07F] transition-all" 
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" 
                                    alt="{{ Auth::user()->name }}" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold border border-green-100">
                                <i class="fas fa-check-circle mr-1"></i> Warga Terdaftar
                            </div>
                        </div>
                    </div>

                    <!-- Menu Navigasi (Hidden di Mobile jika ingin ringkas, atau tetap ditampilkan) -->
                    <div class="bg-white shadow-lg rounded-3xl border border-gray-100 overflow-hidden">
                        <div class="p-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menu Pengaturan</h3>
                        </div>
                        <nav class="flex flex-col">
                            <a href="#profile-info" class="px-6 py-4 text-sm font-medium text-gray-600 hover:bg-green-50 hover:text-green-600 border-l-4 border-transparent hover:border-green-600 transition-colors flex items-center">
                                <i class="fas fa-user-edit w-8 text-lg opacity-70"></i> Informasi Profil
                            </a>
                            <a href="#update-password" class="px-6 py-4 text-sm font-medium text-gray-600 hover:bg-green-50 hover:text-green-600 border-l-4 border-transparent hover:border-green-600 transition-colors flex items-center">
                                <i class="fas fa-key w-8 text-lg opacity-70"></i> Ganti Kata Sandi
                            </a>
                            <a href="#delete-account" class="px-6 py-4 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 border-l-4 border-transparent hover:border-red-600 transition-colors flex items-center">
                                <i class="fas fa-trash-alt w-8 text-lg opacity-70"></i> Hapus Akun
                            </a>
                        </nav>
                    </div>

                </div>

                <!-- KOLOM KANAN: Semua Form -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Section 1: Info Profil -->
                    <div id="profile-info" class="p-6 sm:p-8 bg-white shadow-lg rounded-3xl border border-gray-100 relative overflow-hidden scroll-mt-24">
                        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-32 h-32 bg-green-50 rounded-full blur-3xl opacity-50"></div>
                        <div class="relative z-10">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Section 2: Update Password -->
                    <div id="update-password" class="p-6 sm:p-8 bg-white shadow-lg rounded-3xl border border-gray-100 scroll-mt-24">
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Section 3: Delete Account -->
                    <div id="delete-account" class="p-6 sm:p-8 bg-white shadow-lg rounded-3xl border border-red-50 relative overflow-hidden scroll-mt-24">
                        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-32 h-32 bg-red-50 rounded-full blur-3xl opacity-50"></div>
                        <div class="relative z-10">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>