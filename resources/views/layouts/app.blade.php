<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SimplelBS') }}</title>

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- Navigation --}}
            @if(Auth::user()->role === 'admin')
                @include('layouts.navigation.admin')
            @else
                @include('layouts.navigation.user')
            @endif

            <div class="min-h-screen flex flex-col transition-all duration-300 {{ Auth::user()->role === 'admin' ? 'lg:ml-64' : '' }}">
                
                {{-- <!-- Top Navbar (Header Putih) -->
                <header class="bg-white border-b border-gray-200 h-16 sticky top-0 z-30 w-full flex items-center px-4 sm:px-6 lg:px-8 shadow-sm {{ Auth::user()->role === 'admin' ? '' : 'lg:hidden' }}">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center gap-4">
                            <div class="lg:hidden mr-2">
                                <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="fas fa-bars text-xl"></i>
                                </button>
                            </div>

                            <div>
                                <h1 class="text-xl font-bold text-gray-900 leading-tight">
                                    {{ $header ?? 'Dashboard' }}
                                </h1>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="lg:hidden flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </div>
                </header> --}}

                <!-- Page Content Area -->
                <main class="p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>
                
            </div>
        </div>
    </body>
</html>
