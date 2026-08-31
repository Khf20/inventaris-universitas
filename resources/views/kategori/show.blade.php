<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-slate-900">Detail Kategori</h2></x-slot>
    <div class="min-h-screen bg-slate-50 py-8"><div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8"><div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"><h3 class="text-2xl font-bold text-slate-900">{{ $kategori->nama }}</h3><p class="mt-3 text-slate-600">{{ $kategori->deskripsi ?: 'Tidak ada deskripsi.' }}</p><p class="mt-6 text-sm text-slate-500">{{ $kategori->barangs->count() }} barang dalam kategori ini.</p><a class="mt-6 inline-block rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white" href="{{ route('kategori.edit', $kategori) }}">Edit Kategori</a></div></div></div>
</x-app-layout>
