<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-red-500 hover:to-rose-500 active:from-red-700 active:to-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm']) }}>
    {{ $slot }}
</button>
