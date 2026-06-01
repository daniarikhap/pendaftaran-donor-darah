<section>
    <header>
        <h2 class="text-lg font-bold text-slate-800">
            {{ __('Informasi Pegawai') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __("Perbarui data profil pegawai Anda beserta detail akun login.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="pegawai_nama" :value="__('Nama Pegawai')" />
            <x-text-input id="pegawai_nama" name="pegawai_nama" type="text" class="mt-1 block w-full" :value="old('pegawai_nama', $user->pegawai->pegawai_nama ?? '')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('pegawai_nama')" />
        </div>

        <div>
            <x-input-label for="nomoridentitas" :value="__('Nomor Identitas')" />
            <x-text-input id="nomoridentitas" name="nomoridentitas" type="text" class="mt-1 block w-full" :value="old('nomoridentitas', $user->pegawai->nomoridentitas ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('nomoridentitas')" />
        </div>

        <div>
            <x-input-label for="nomorindukpegawai" :value="__('Nomor Induk Pegawai (NIP)')" />
            <x-text-input id="nomorindukpegawai" name="nomorindukpegawai" type="text" class="mt-1 block w-full" :value="old('nomorindukpegawai', $user->pegawai->nomorindukpegawai ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('nomorindukpegawai')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-rose-600 font-semibold"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
