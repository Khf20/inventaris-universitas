<x-app-layout>
    <x-slot name="header"><div class="flex flex-wrap items-center justify-between gap-4"><h2 class="text-xl font-semibold text-slate-900">Transaksi Peminjaman</h2><a href="{{ route('transaksi.create') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Pinjam Barang</a></div></x-slot>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
            @endif
            <form method="GET" action="{{ route('transaksi.index') }}" class="grid gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:grid-cols-[1fr_220px_auto_auto] sm:items-end">
                <div>
                    <label for="search" class="block text-sm font-medium text-slate-700">Cari transaksi</label>
                    <input id="search" name="search" value="{{ $search }}" type="search" placeholder="Nama barang atau peminjam..." class="mt-1 block w-full rounded-lg border-slate-300">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full rounded-lg border-slate-300">
                        <option value="">Semua status</option>
                        <option value="dipinjam" @selected($status === 'dipinjam')>Dipinjam</option>
                        <option value="dikembalikan" @selected($status === 'dikembalikan')>Dikembalikan</option>
                    </select>
                </div>
                <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Filter</button>
                <a href="{{ route('transaksi.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">Reset</a>
            </form>
            <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-6 py-3">Barang</th><th class="px-6 py-3">Peminjam</th><th class="px-6 py-3">Jumlah</th><th class="px-6 py-3">Pinjam</th><th class="px-6 py-3">Status</th><th class="px-6 py-3">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-slate-100">@forelse ($transaksis as $transaksi)<tr><td class="px-6 py-4 font-medium text-slate-900">{{ $transaksi->barang->nama }}</td><td class="px-6 py-4">{{ $transaksi->user->name }}</td><td class="px-6 py-4">{{ $transaksi->jumlah }}</td><td class="px-6 py-4">{{ $transaksi->tgl_pinjam->format('d/m/Y') }}</td><td class="px-6 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $transaksi->status === 'dipinjam' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">{{ ucfirst($transaksi->status) }}</span></td><td class="px-6 py-4"><div class="flex gap-3"><a class="text-blue-600 hover:underline" href="{{ route('transaksi.show', $transaksi) }}">Detail</a><a class="text-slate-600 hover:underline" href="{{ route('transaksi.edit', $transaksi) }}">Edit</a><form method="POST" action="{{ route('transaksi.destroy', $transaksi) }}" onsubmit="return confirm('Hapus transaksi ini?')">@csrf @method('DELETE')<button class="text-rose-600 hover:underline">Hapus</button></form></div></td></tr>@empty<tr><td colspan="6" class="px-6 py-10 text-center text-slate-500">Belum ada transaksi.</td></tr>@endforelse</tbody>
                </table>
            </div>
            {{ $transaksis->links() }}
        </div>
    </div>
</x-app-layout>
