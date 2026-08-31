<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-semibold text-slate-900">Data Barang</h2>
            <a href="{{ route('barang.create') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Tambah Barang</a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
            @endif
            <form method="GET" action="{{ route('barang.index') }}" class="grid gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:grid-cols-[1fr_220px_auto_auto] sm:items-end">
                <div>
                    <label for="search" class="block text-sm font-medium text-slate-700">Cari barang</label>
                    <input id="search" name="search" value="{{ $search }}" type="search" placeholder="Nama barang…" class="mt-1 block w-full rounded-lg border-slate-300">
                </div>
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-slate-700">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="mt-1 block w-full rounded-lg border-slate-300">
                        <option value="">Semua kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" @selected((string) $kategoriId === (string) $kategori->id)>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Filter</button>
                <a href="{{ route('barang.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">Reset</a>
            </form>
            <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr><th class="px-6 py-3">Nama</th><th class="px-6 py-3">Kategori</th><th class="px-6 py-3">Stok</th><th class="px-6 py-3">Kondisi</th><th class="px-6 py-3">Aksi</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($barangs as $barang)
                            <tr><td class="px-6 py-4 font-medium text-slate-900">{{ $barang->nama }}</td><td class="px-6 py-4">{{ $barang->kategori->nama }}</td><td class="px-6 py-4">{{ $barang->jumlah }}</td><td class="px-6 py-4">{{ ucfirst($barang->kondisi) }}</td><td class="px-6 py-4"><div class="flex gap-3"><a class="text-blue-600 hover:underline" href="{{ route('barang.show', $barang) }}">Detail</a><a class="text-slate-600 hover:underline" href="{{ route('barang.edit', $barang) }}">Edit</a><form method="POST" action="{{ route('barang.destroy', $barang) }}" onsubmit="return confirm('Hapus barang ini?')">@csrf @method('DELETE')<button class="text-rose-600 hover:underline">Hapus</button></form></div></td></tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada barang.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $barangs->links() }}
        </div>
    </div>
</x-app-layout>
