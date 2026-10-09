<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-semibold text-slate-900">Data Kategori</h2>
            <a href="{{ route('kategori.create') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Tambah Kategori</a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-5xl space-y-5 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="rounded-lg bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ session('error') }}</div>
            @endif

            <x-data-table
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                :headers="[
                    ['label' => 'Nama', 'class' => 'bg-slate-50 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500'],
                    ['label' => 'Jumlah Barang', 'class' => 'bg-slate-50 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500'],
                    ['label' => 'Aksi', 'class' => 'bg-slate-50 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500'],
                ]"
                :paginator="$kategoris"
                table-class="min-w-full text-left text-sm"
            >
                @forelse ($kategoris as $kategori)
                    <tr>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $kategori->nama }}</td>
                        <td class="px-6 py-4">{{ $kategori->barangs_count }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <a class="text-blue-600 hover:underline" href="{{ route('kategori.show', $kategori) }}">Detail</a>
                                <a class="text-slate-600 hover:underline" href="{{ route('kategori.edit', $kategori) }}">Edit</a>
                                <form method="POST" action="{{ route('kategori.destroy', $kategori) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-rose-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-slate-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </x-data-table>
        </div>
    </div>
</x-app-layout>
