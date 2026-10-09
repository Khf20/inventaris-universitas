<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-semibold text-slate-900">Data Kategori</h2>
            <a href="{{ route('kategori.create') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-6xl space-y-5 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-slate-700">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">No</th>
                                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Nama</th>
                                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Deskripsi</th>
                                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Jumlah Barang</th>
                                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategoris as $kategori)
                                <tr class="border-t border-slate-200">
                                    <td class="px-6 py-4 text-slate-600">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 font-medium text-slate-900">
                                            <span aria-hidden="true">📁</span>
                                            <span>{{ $kategori->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $kategori->deskripsi ?: '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $kategori->barangs_count ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap items-center gap-3">
                                            <a href="{{ route('kategori.edit', $kategori) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 hover:underline">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('kategori.destroy', $kategori) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-rose-600 hover:text-rose-700 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <span class="text-3xl" aria-hidden="true">📂</span>
                                            <p class="text-base font-medium text-slate-600">Belum ada kategori.</p>
                                            <p class="text-sm text-slate-400">Klik tombol “Tambah Kategori” untuk menambahkan data yang pertama.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
