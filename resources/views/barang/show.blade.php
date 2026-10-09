<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-slate-900">Detail Barang</h2>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex justify-center rounded-xl bg-slate-50 p-5">
                    @if ($barang->gambar)
                        <img
                            src="{{ asset($barang->gambar) }}"
                            alt="Gambar {{ $barang->nama }}"
                            style="max-width:300px;border-radius:10px"
                        >
                    @else
                        <div class="flex min-h-40 w-full flex-col items-center justify-center text-slate-400">
                            <i class="fas fa-image text-4xl" aria-hidden="true"></i>
                            <p class="mt-2 text-sm">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>

                <dl class="divide-y divide-slate-100">
                    <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Nama</dt><dd class="font-semibold text-slate-900">{{ $barang->nama }}</dd></div>
                    <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Kategori</dt><dd>{{ $barang->kategori?->nama ?? 'Tanpa kategori' }}</dd></div>
                    <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Stok</dt><dd>{{ $barang->jumlah }}</dd></div>
                    <div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Kondisi</dt><dd>{{ ucfirst($barang->kondisi) }}</dd></div>
                </dl>

                <a class="mt-6 inline-block rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white" href="{{ route('barang.edit', $barang) }}">Edit Barang</a>
            </div>
        </div>
    </div>
</x-app-layout>
