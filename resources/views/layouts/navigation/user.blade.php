<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <!-- Left: Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 group">
                    <!-- Logo Image (Ganti dengan aset logo asli Anda) -->
                    <img src="{{ asset('asset/Logo-coloured.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                    
                    <!-- Brand Text -->
                    <div class="flex flex-col">
                        <span class="font-extrabold text-xl text-gray-900 leading-tight tracking-tight">SimpelBS</span>
                        <span class="text-[10px] text-gray-500 font-medium tracking-wide uppercase">Sistem Pelayanan Banjarsari</span>
                    </div>
                </a>
            </div>

            <!-- Center: Navigation Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <!-- Beranda (Dashboard) - Active State: Text Green & Bold -->
                <a href="{{ route('user.dashboard') }}" 
                   class="flex items-center gap-2 text-sm font-medium transition-colors duration-200 
                          {{ request()->routeIs('user.dashboard') ? 'text-[#00C07F] font-bold' : 'text-gray-500 hover:text-[#00C07F]' }}">
                    <i class="fas fa-home text-lg {{ request()->routeIs('user.dashboard') ? 'text-[#00C07F]' : 'text-gray-400' }}"></i>
                    <span>Beranda</span>
                </a>

                <!-- Info Layanan -->
                <a href="{{ route('user.layanan') }}" 
                   class="flex items-center gap-2 text-sm font-medium transition-colors duration-200 
                          {{ request()->routeIs('user.layanan') ? 'text-[#00C07F] font-bold' : 'text-gray-500 hover:text-[#00C07F]' }}">
                    <i class="fas fa-info-circle text-lg {{ request()->routeIs('user.layanan') ? 'text-[#00C07F]' : 'text-gray-400' }}"></i>
                    <span>Info Layanan</span>
                </a>

                <!-- IRiwayat -->
                <a href="{{ route('user.riwayat') }}" 
                   class="flex items-center gap-2 text-sm font-medium transition-colors duration-200 
                          {{ request()->routeIs('user.riwayat') ? 'text-[#00C07F] font-bold' : 'text-gray-500 hover:text-[#00C07F]' }}">
                    <i class="fas fa-history text-lg {{ request()->routeIs('user.riwayat') ? 'text-[#00C07F]' : 'text-gray-400' }}"></i>
                    <span>Riwayat</span>
                </a>
            </div>

            <!-- Right: Notification & Profile -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-6">
                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 focus:outline-none group">
                            <!-- Avatar -->
                            <div class="relative">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-100 group-hover:border-[#00C07F] transition-all" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" 
                                     alt="{{ Auth::user()->name }}" />
                                <!-- Status Indicator (Optional) -->
                                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-green-500"></span>
                            </div>
                            
                            <!-- Name & Role -->
                            <div class="text-left hidden lg:block">
                                <div class="text-sm font-bold text-gray-900 group-hover:text-[#00C07F] transition-colors">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500 font-medium">Warga</div>
                            </div>

                            <!-- Chevron Icon -->
                            <i class="fas fa-chevron-down text-xs text-gray-400 group-hover:text-gray-600 transition-transform duration-200"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100 lg:hidden">
                            <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fas fa-user-circle mr-2 text-gray-400"></i> {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 hover:text-red-700 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <i class="fas fa-bars text-xl" x-show="!open"></i>
                    <i class="fas fa-times text-xl" x-show="open" style="display: none;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100 bg-gray-50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                <i class="fas fa-home w-6 text-center"></i> {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.layanan')" :active="request()->routeIs('layanan.*')">
                <i class="fas fa-info-circle w-6 text-center"></i> {{ __('Info Layanan') }}
            </x-responsive-nav-link>
             <x-responsive-nav-link :href="route('user.riwayat')" :active="request()->routeIs('user.riwayat')">
                <i class="fas fa-history w-6 text-center"></i> {{ __('Riwayat') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
            <div class="px-4 flex items-center gap-3">
                <div class="flex-shrink-0">
                     <img class="h-10 w-10 rounded-full object-cover border border-gray-200" 
                          src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" 
                          alt="{{ Auth::user()->name }}" />
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-600">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>