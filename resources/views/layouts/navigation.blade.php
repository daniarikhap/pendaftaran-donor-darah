<aside x-data="{ sidebarOpen: true, masterOpen: {{ (request()->routeIs('kuesioner.*') || request()->routeIs('ruangan.*') || request()->routeIs('pekerjaan.*')) ? 'true' : 'false' }}, informasiOpen: false }" 
       class="flex flex-col h-screen sticky top-0 bg-slate-900 border-r border-slate-800/60 transition-all duration-300 ease-in-out shrink-0"
       :class="sidebarOpen ? 'w-64' : 'w-20'">
    
    <!-- Header: Avatar Box and Toggle -->
    <div class="p-4 flex items-center justify-between border-b border-slate-800/60 min-h-[73px]">
        <!-- Profile Box -->
        <div class="flex items-center space-x-3 overflow-hidden" x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="w-10 h-10 rounded-lg border border-rose-500/20 flex items-center justify-center bg-rose-500/10 overflow-hidden shrink-0">
                <!-- Person Icon -->
                <svg class="w-6 h-6 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.603 17.103A9 9 0 006 21h12a9 9 0 00.603-3.897z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="truncate">
                <div class="font-semibold text-xs text-slate-200 leading-tight">
                    {{ Auth::user()->pegawai->pegawai_nama ?? Auth::user()->username }}
                </div>
                <div class="text-[10px] text-slate-400">
                    NIP: {{ Auth::user()->pegawai->nomorindukpegawai ?? '-' }}
                </div>
            </div>
        </div>

        <!-- Person icon when collapsed -->
        <div x-show="!sidebarOpen" class="w-10 h-10 rounded-lg border border-rose-500/20 flex items-center justify-center bg-rose-500/10 overflow-hidden mx-auto shrink-0">
            <svg class="w-6 h-6 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.603 17.103A9 9 0 006 21h12a9 9 0 00.603-3.897z" clip-rule="evenodd" />
            </svg>
        </div>

        <!-- Hamburger Icon -->
        <button @click="sidebarOpen = !sidebarOpen" class="p-1.5 rounded-md hover:bg-slate-800 text-slate-400 hover:text-slate-200 focus:outline-none shrink-0 ml-auto">
            <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu Items -->
    <div class="flex-1 py-4 overflow-y-auto px-3 space-y-1">
        <!-- Dashboard Link -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'text-rose-400 bg-rose-500/10 font-semibold border-l-4 border-rose-500 pl-2 pr-3' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 shrink-0 {{ request()->routeIs('dashboard') ? 'text-rose-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">Dashboard</span>
        </a>

        <!-- Master Menu Group -->
        <div>
            <button @click="masterOpen = !masterOpen" 
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-slate-300 rounded-md hover:bg-slate-800/60 hover:text-white transition-colors duration-150">
                <div class="flex items-center">
                    <!-- Icon for Master -->
                    <svg class="w-5 h-5 mr-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1.5 3 3.5 3h9c2 0 3.5-1 3.5-3V7M4 7c0-2 1.5-3 3.5-3h9c2 0 3.5 1 3.5 3M4 7h16" />
                    </svg>
                    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">Master</span>
                </div>
                <svg x-show="sidebarOpen" 
                     class="w-4 h-4 text-slate-400 transform transition-transform duration-200 shrink-0" 
                     :class="masterOpen ? 'rotate-90' : ''" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <!-- Submenu Master -->
            <div x-show="masterOpen && sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-1" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-1 pl-8 space-y-1">
                <a href="{{ route('kuesioner.index') }}" 
                   class="block px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150 {{ request()->routeIs('kuesioner.*') ? 'text-rose-400 bg-rose-500/10 font-semibold' : 'text-slate-400 hover:text-rose-400 hover:bg-slate-800/40' }}">
                    Kuesioner
                </a>
                <a href="{{ route('ruangan.index') }}" 
                   class="block px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150 {{ request()->routeIs('ruangan.*') ? 'text-rose-400 bg-rose-500/10 font-semibold' : 'text-slate-400 hover:text-rose-400 hover:bg-slate-800/40' }}">
                    Ruangan
                </a>
                <a href="{{ route('pekerjaan.index') }}" 
                   class="block px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150 {{ request()->routeIs('pekerjaan.*') ? 'text-rose-400 bg-rose-500/10 font-semibold' : 'text-slate-400 hover:text-rose-400 hover:bg-slate-800/40' }}">
                    Pekerjaan
                </a>
            </div>
        </div>

        <!-- Informasi Menu Group -->
        <div>
            <button @click="informasiOpen = !informasiOpen" 
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-slate-300 rounded-md hover:bg-slate-800/60 hover:text-white transition-colors duration-150">
                <div class="flex items-center">
                    <!-- Icon for Informasi -->
                    <svg class="w-5 h-5 mr-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">Informasi</span>
                </div>
                <svg x-show="sidebarOpen" 
                     class="w-4 h-4 text-slate-400 transform transition-transform duration-200 shrink-0" 
                     :class="informasiOpen ? 'rotate-90' : ''" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <!-- Submenu Informasi -->
            <div x-show="informasiOpen && sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-1" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-1 pl-8 space-y-1">
                <a href="#" 
                   class="block px-3 py-2 text-sm font-medium text-slate-400 hover:text-rose-400 hover:bg-slate-800/40 rounded-md transition-colors duration-150">
                    Data Donor
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Sidebar Section (Settings and Logout) -->
    <div class="p-4 border-t border-slate-800/60 space-y-2">
        <!-- Settings Link -->
        <a href="{{ route('profile.edit') }}" 
           class="flex items-center px-3 py-2 text-sm font-medium text-slate-300 rounded-md hover:bg-slate-800/60 hover:text-white transition-colors duration-150">
            <svg class="w-5 h-5 mr-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">Setting</span>
        </a>

        <!-- Logout Link -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center px-3 py-2 text-sm font-medium text-rose-400 rounded-md hover:bg-rose-500/10 transition-colors duration-150 text-left">
                <svg class="w-5 h-5 mr-3 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">Logout</span>
            </button>
        </form>
    </div>
</aside>
