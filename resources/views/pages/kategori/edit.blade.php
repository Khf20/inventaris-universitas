<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-xl font-semibold text-slate-900">Edit Kategori</h2>
            <a href="{{ route('kategori.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <form method="POST" action="{{ route('kategori.update', $kategori) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama" class="mb-2 block text-sm font-medium text-slate-700">
                            <span class="inline-flex items-center gap-2">
                                <span aria-hidden="true">🏷️</span>
                                <span>Nama</span>
                            </span>
                        </label>
                        <input
                            id="nama"
                            name="nama"
                            type="text"
                            value="{{ old('nama', $kategori->nama) }}"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm transition focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 @error('nama') border-rose-300 focus:border-rose-400 focus:ring-rose-100 @enderror"
                            placeholder="Masukkan nama kategori"
                        >
                        @error('nama')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="mb-2 block text-sm font-medium text-slate-700">
                            <span class="inline-flex items-center gap-2">
                                <span aria-hidden="true">📝</span>
                                <span>Deskripsi</span>
                            </span>
                        </label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="5"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm transition focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 @error('deskripsi') border-rose-300 focus:border-rose-400 focus:ring-rose-100 @enderror"
                            placeholder="Masukkan deskripsi kategori (opsional)"
                        >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap items-center justify-end gap-3 pt-2">
                        <a href="{{ route('kategori.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                            Batal
                        </a>
                        <button type="submit" class="rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
