<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <i class="fas fa-id-card text-green-600"></i>
            {{ __('Informasi Pribadi') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nama -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-semibold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-user"></i>
                </div>
                <x-text-input id="name" name="name" type="text" class="block w-full pl-10 rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 transition-shadow" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- NIK (Read Only) -->
            <div>
                <x-input-label for="nik" :value="__('NIK')" class="text-gray-700 font-semibold" />
                <div class="relative mt-1">
                    <x-text-input id="nik" name="nik" type="text" class="block w-full bg-gray-50 text-gray-500 cursor-not-allowed rounded-xl border-gray-200 pl-10" :value="old('nik', $user->nik)" disabled />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                        <i class="fas fa-lock text-xs"></i>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-400 flex items-center gap-1">
                    <i class="fas fa-info-circle"></i> Hubungi admin desa untuk perubahan NIK.
                </p>
            </div>

            <!-- Nomor HP -->
            <div>
                <x-input-label for="no_hp" :value="__('Nomor HP (WhatsApp)')" class="text-gray-700 font-semibold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-phone"></i>
                    </div>
                    <x-text-input id="no_hp" name="no_hp" type="text" class="block w-full pl-10 rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500" :value="old('no_hp', $user->no_hp)" required autocomplete="tel" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
            </div>
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-envelope"></i>
                </div>
                <x-text-input id="email" name="email" type="email" class="block w-full pl-10 rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 rounded-xl border border-yellow-200 flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                    <div>
                        <p class="text-sm text-yellow-800 font-medium">
                            {{ __('Alamat email Anda belum diverifikasi.') }}
                        </p>
                        <button form="send-verification" class="mt-1 text-sm underline font-bold text-yellow-900 hover:text-yellow-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-medium text-green-600 flex items-center gap-1">
                                <i class="fas fa-check-circle"></i>
                                {{ __('Tautan verifikasi baru telah dikirim.') }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100 mt-6">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-green-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                <i class="fas fa-save mr-2"></i> {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center text-sm text-green-600 font-medium bg-green-50 px-3 py-1 rounded-lg border border-green-100"
                >
                    <i class="fas fa-check-circle mr-1.5"></i> {{ __('Berhasil Disimpan.') }}
                </div>
            @endif
        </div>
    </form>
</section>