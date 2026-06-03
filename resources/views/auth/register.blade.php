<x-guest-layout>
    <!-- Welcome Header -->
    <div class="mb-8 text-center md:text-left">
        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">
            Daftar Pendonor
        </h2>
        <p class="text-sm text-slate-500 mt-2">
            Lengkapi data diri Anda untuk bergabung sebagai pahlawan kemanusiaan.
        </p>
    </div>

    <form method="POST" id="registerForm" action="{{ route('register') }}" class="space-y-5" novalidate>
        @csrf

        <!-- Nama Lengkap -->
        <div class="space-y-1.5">
            <label for="nama_pegawai" class="block font-semibold text-sm text-slate-700">{{ __('Nama Lengkap Pegawai') }} <span class="text-rose-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- User icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="nama_pegawai" type="text" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required autofocus autocomplete="name" class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm" placeholder="Nama lengkap pegawai" />
            </div>
            <x-input-error :messages="$errors->get('nama_pegawai')" class="mt-1" />
        </div>

        <!-- Nomor Identitas -->
        <div class="space-y-1.5">
            <label for="noidentitas" class="block font-semibold text-sm text-slate-700">{{ __('Nomor Identitas (NIK)') }} <span class="text-rose-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- Identification card icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8h2m-2 2h2m4-4h2" />
                    </svg>
                </div>
                <input id="noidentitas" type="text" name="noidentitas" value="{{ old('noidentitas') }}" required class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm" placeholder="Nomor NIK KTP Anda" />
            </div>
            <x-input-error :messages="$errors->get('noidentitas')" class="mt-1" />
        </div>

        <!-- Nomor Induk Pegawai (NIP) -->
        <div class="space-y-1.5">
            <label for="nomorindukpegawai" class="block font-semibold text-sm text-slate-700">{{ __('Nomor Induk Pegawai (NIP)') }} <span class="text-rose-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- ID badge icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <input id="nomorindukpegawai" type="text" name="nomorindukpegawai" value="{{ old('nomorindukpegawai') }}" required class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm" placeholder="Nomor Induk Pegawai" />
            </div>
            <x-input-error :messages="$errors->get('nomorindukpegawai')" class="mt-1" />
        </div>

        <!-- Username -->
        <div class="space-y-1.5">
            <label for="username" class="block font-semibold text-sm text-slate-700">{{ __('Username') }} <span class="text-rose-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- At icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                    </svg>
                </div>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm" placeholder="Buat username unik" />
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <label for="password" class="block font-semibold text-sm text-slate-700">{{ __('Kata Sandi') }} <span class="text-rose-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- Lock icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm" placeholder="Buat kata sandi minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
            <label for="password_confirmation" class="block font-semibold text-sm text-slate-700">{{ __('Konfirmasi Kata Sandi') }} <span class="text-rose-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- Shield/Lock check icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm" placeholder="Ulangi kata sandi Anda" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 active:from-red-700 active:to-rose-700 text-white font-bold text-sm tracking-wider uppercase rounded-xl shadow-lg shadow-rose-500/25 hover:shadow-rose-500/35 transition duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                <span>{{ __('Daftar Sekarang') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </button>
        </div>
        
        <!-- Login Link -->
        <div class="text-center pt-2">
            <p class="text-sm text-slate-500">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-bold text-rose-600 hover:text-rose-500 hover:underline transition duration-150">
                    Masuk Di Sini
                </a>
            </p>
        </div>
    </form>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;
            const inputs = this.querySelectorAll('input[required]');
            
            inputs.forEach(input => {
                const parent = input.closest('.space-y-1.5');
                const existingError = parent.querySelector('.js-error-msg');
                if (existingError) {
                    existingError.remove();
                }
                
                if (!input.value.trim()) {
                    isValid = false;
                    
                    const label = parent.querySelector('label');
                    let labelText = label ? label.textContent.replace('(Wajib diisi)', '').replace('*', '').trim() : '';
                    
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'js-error-msg mt-1 text-sm text-red-600 font-medium';
                    errorDiv.textContent = 'wajib diisi ' + labelText;
                    
                    parent.appendChild(errorDiv);
                    
                    input.classList.add('border-red-500', 'focus:ring-red-500/20', 'focus:border-red-500');
                    input.classList.remove('border-slate-200', 'focus:ring-rose-500/20', 'focus:border-rose-500');
                } else {
                    input.classList.remove('border-red-500', 'focus:ring-red-500/20', 'focus:border-red-500');
                    input.classList.add('border-slate-200', 'focus:ring-rose-500/20', 'focus:border-rose-500');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const firstInvalid = this.querySelector('input.border-red-500');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            }
        });

        document.querySelectorAll('#registerForm input[required]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    const parent = this.closest('.space-y-1.5');
                    const errorMsg = parent.querySelector('.js-error-msg');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                    this.classList.remove('border-red-500', 'focus:ring-red-500/20', 'focus:border-red-500');
                    this.classList.add('border-slate-200', 'focus:ring-rose-500/20', 'focus:border-rose-500');
                }
            });
        });
    </script>
</x-guest-layout>
