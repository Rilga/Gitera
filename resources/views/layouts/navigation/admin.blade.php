<nav x-data="{ open: false }" class="bg-white border-r border-gray-200 fixed left-0 top-0 h-screen w-64 flex flex-col justify-between z-50 hidden lg:flex">
    
    <!-- Bagian Atas: Logo & Menu -->
    <div>
        <!-- Logo Area -->
        <div class="flex items-center px-6 h-20 border-b border-gray-50">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <!-- Logo Icon -->
                <img src="{{ asset('asset/Logo-coloured.png') }}" 
                    alt="Ilustrasi Background" 
                    class="w-8 h-9 object-cover object-centermix-blend-multiply">
                <span class="font-bold text-xl text-gray-900 tracking-tight">SimpelBS</span>
            </a>
        </div>

        <!-- Menu Links -->
        <div class="px-4 py-6 space-y-1">
            
            <!-- Dashboard Link (Active State sesuai gambar) -->
            <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700 font-semibold shadow-sm ring-1 ring-green-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <i class="{{ request()->routeIs('admin.dashboard') ? 'fas fa-th-large' : 'fas fa-th-large' }} w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                <span>Dashboard</span>
            </a>

            <!-- Data Pengajuan -->
            <a href="{{ route('admin.pengajuan.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.pengajuan.index') ? 'bg-green-50 text-green-700 font-semibold shadow-sm ring-1 ring-green-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <i class="{{ request()->routeIs('admin.dashboard') ? 'fas fa-clipboard-list' : 'fas fa-clipboard-list' }} w-5 text-center {{ request()->routeIs('admin.pengajuan.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                <span>Data Pengajuan</span>
            </a>

            <!-- Data User (Menu yang sudah kita buat) -->
            <a href="{{ route('verification.list') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('verification.list') ? 'bg-green-50 text-green-700 font-semibold shadow-sm ring-1 ring-green-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <i class="fas fa-users w-5 text-center {{ request()->routeIs('verification.list') ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                <span>Data User</span>
            </a>

        </div>
    </div>

    <!-- Bagian Bawah: Profil User (Sesuai Gambar) -->
    <div class="p-4 border-t border-gray-100">
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center gap-3 w-full p-2 rounded-lg hover:bg-gray-50 transition-colors group focus:outline-none">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                     <!-- Menggunakan UI Avatars sebagai placeholder yang dinamis -->
                    <img class="h-10 w-10 rounded-full object-cover border border-gray-200 group-hover:border-green-200" 
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1da746&color=fff" 
                         alt="{{ Auth::user()->name }}" />
                </div>
                
                <!-- Nama & Role -->
                <div class="flex-1 text-left">
                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Admin Desa</p>
                </div>

                <!-- Icon Dropdown -->
                <div class="text-gray-400">
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </div>
            </button>

            <!-- Dropdown Menu (Log Out) -->
            <div x-show="open" 
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute bottom-full left-0 w-full mb-2 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50"
                 style="display: none;">
                
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                    <i class="fas fa-user-circle mr-2"></i> Profil Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Header & Hamburger (Hanya muncul di layar kecil) -->
<div class="lg:hidden fixed top-0 left-0 w-full bg-white border-b border-gray-200 z-40 h-16 flex items-center justify-between px-4">
    <div class="flex items-center gap-2">
        <img src="{{ asset('asset/Logo-coloured.png') }}" 
            alt="Ilustrasi Background" 
            class="w-8 h-9 object-cover object-centermix-blend-multiply">
        <span class="font-bold text-lg text-gray-900">SimpelBS</span>
    </div>
    <button @click="open = !open" class="text-gray-500 hover:text-gray-900 p-2">
        <i class="fas fa-bars text-xl"></i>
    </button>
</div>

<!-- Mobile Menu Sidebar (Offcanvas) -->
<div x-data="{ open: false }" 
     @keydown.window.escape="open = false" 
     x-show="open" 
     class="relative z-50 lg:hidden" 
     style="display: none;">
    
    <!-- Backdrop -->
    <div x-show="open" 
         x-transition:enter="transition-opacity ease-linear duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="transition-opacity ease-linear duration-300" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 bg-gray-900/80" 
         @click="open = false"></div>

    <!-- Sidebar Panel -->
    <div x-show="open" 
         x-transition:enter="transition ease-in-out duration-300 transform" 
         x-transition:enter-start="-translate-x-full" 
         x-transition:enter-end="translate-x-0" 
         x-transition:leave="transition ease-in-out duration-300 transform" 
         x-transition:leave-start="translate-x-0" 
         x-transition:leave-end="-translate-x-full" 
         class="fixed inset-y-0 left-0 flex w-full max-w-xs flex-col bg-white shadow-xl">
        
         <!-- Mobile Menu Content (Sama seperti desktop tapi disesuaikan) -->
         <div class="flex items-center justify-between px-6 h-16 border-b border-gray-100">
             <span class="font-bold text-xl">Menu</span>
             <button @click="open = false" class="text-gray-500 hover:text-gray-900">
                 <i class="fas fa-times text-xl"></i>
             </button>
         </div>
         
         <div class="flex-1 overflow-y-auto px-4 py-4 space-y-1">
             <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600' }}">
                 <i class="fas fa-th-large w-5"></i> Dashboard
             </a>
             <a href="{{ route('verification.list') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('verification.list') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600' }}">
                 <i class="fas fa-users w-5"></i> Data User
             </a>
             <!-- Tambahkan menu lain di sini -->
         </div>
    </div>
</div>