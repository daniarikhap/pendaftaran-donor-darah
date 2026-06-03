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
            <x-input-label for="nama_pegawai" :value="__('Nama Pegawai')" />
            <x-text-input id="nama_pegawai" name="nama_pegawai" type="text" class="mt-1 block w-full" :value="old('nama_pegawai', $user->pegawai->nama_pegawai ?? '')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nama_pegawai')" />
        </div>

        <div>
            <x-input-label for="noidentitas" :value="__('Nomor Identitas')" />
            <x-text-input id="noidentitas" name="noidentitas" type="text" class="mt-1 block w-full" :value="old('noidentitas', $user->pegawai->noidentitas ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('noidentitas')" />
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
