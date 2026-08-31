<nav x-data="{ open: false }" class="relative z-20 border-b border-slate-200 bg-white md:ml-64">
        <aside class="fixed inset-y-0 left-0 hidden w-64 bg-gradient-to-b from-[#17182d] via-[#17213d] to-[#10365d] text-white md:block">
            <aside class="fixed inset-y-0 left-0 hidden w-64 bg-gradient-to-b from-[#17182d] via-[#17213d] to-[#10365d] text-white md:block">
                <div class="flex h-20 items-center gap-3 border-b border-white/10 px-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#e94762] text-xl font-bold shadow-lg shadow-rose-950/30">▣</span>
                        <span>
                            <span class="block text-sm font-extrabold tracking-wide">INVENTARIS</span>
                            <span class="block text-[9px] font-semibold tracking-[0.25em] text-slate-300">UNIVERSITAS</span>
                        </span>
                    </a>
                </div>

                <div class="space-y-7 px-4 py-8">
                    <div>
                        <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.24em] text-slate-400">Menu</p>
                        <div class="space-y-1">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">▦ <span>Dashboard</span></x-nav-link>
                            <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">◈ <span>Kategori</span></x-nav-link>
                            <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">▣ <span>Barang</span></x-nav-link>
                            <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">⇄ <span>Transaksi</span></x-nav-link>
                        </div>
                    </div>

                    @if (Auth::user()->isAdmin())
                        <div>
                            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.24em] text-slate-400">Laporan</p>
                            <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">▤ <span>Laporan</span></x-nav-link>
                        </div>
                    @endif

                    <div>
                        <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.24em] text-slate-400">Akun</p>
                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">♙ <span>Profile</span></x-nav-link>
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/70">↪ <span>Logout</span></button>
                        </form>
                    </div>
        <div class="ml-auto hidden items-center sm:flex">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-slate-500 hover:text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">@csrf<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link></form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-slate-200 bg-white p-4 md:hidden">
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">Kategori</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">Barang</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">Transaksi</x-responsive-nav-link>
            @if (Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">Laporan</x-responsive-nav-link>
            @endif
        </div>
        <div class="mt-4 border-t border-slate-200 pt-4 sm:hidden">
            <p class="px-4 text-sm font-medium text-slate-800">{{ Auth::user()->name }}</p>
            <p class="px-4 text-sm text-slate-500">{{ Auth::user()->email }}</p>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">@csrf<x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link></form>
            </div>
        </div>
    </div>
</nav>
