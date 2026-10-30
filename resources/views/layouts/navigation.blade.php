<nav x-data="{ open: false }" class="relative z-20">
    <aside class="fixed inset-y-0 left-0 hidden w-64 bg-gradient-to-b from-[#17182d] via-[#17213d] to-[#10365d] text-white md:block">
        <div class="flex h-20 items-center gap-3 border-b border-white/10 px-6">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#e94762] text-xl font-bold shadow-lg shadow-rose-950/30" aria-hidden="true">▣</span>
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
                    <x-nav-link :href="route('barang.datatables')" :active="request()->routeIs('barang.datatables')">▤ <span>DataTables</span></x-nav-link>
                    <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">⇄ <span>Transaksi</span></x-nav-link>
                </div>
            </div>

            @if (Auth::user() && (Auth::user()->isAdmin() || Auth::user()->role === 'staff'))
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
        </div>
    </aside>

    <header class="border-b border-slate-200 bg-white md:ml-64">
        <div class="flex h-20 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <button type="button" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 md:hidden" @click="open = ! open" :aria-expanded="open.toString()" aria-label="Buka menu navigasi">
                <span class="text-xl" aria-hidden="true">☰</span>
            </button>
            <p class="hidden text-xs font-medium text-slate-400 sm:block">Panel Manajemen Inventaris</p>
            <div class="ml-auto flex items-center gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-violet-600 text-sm font-bold text-white" aria-hidden="true">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition class="border-t border-slate-200 bg-white p-4 md:hidden">
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">Kategori</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">Barang</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('barang.datatables')" :active="request()->routeIs('barang.datatables')">DataTables</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">Transaksi</x-responsive-nav-link>
                @if (Auth::user() && (Auth::user()->isAdmin() || Auth::user()->role === 'staff'))
                    <x-responsive-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">Laporan</x-responsive-nav-link>
                @endif
            </div>
        </div>
    </header>
</nav>
