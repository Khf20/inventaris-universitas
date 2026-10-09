<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-slate-900">Tambah Barang</h2>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <x-card header="Tambah Barang" icon="fa-box" icon-bg="#eef2ff" icon-color="#4f46e5" body-class="p-6">
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-form-input
                            name="nama"
                            label="Nama Barang"
                            icon="fa-box"
                            placeholder="Nama barang"
                            value="{{ old('nama') }}"
                            required
                        />

                        <x-form-input name="kategori_id" label="Kategori" type="select" icon="fa-tags" required>
                            <option value="">Pilih kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>{{ $kategori->nama }}</option>
                            @endforeach
                        </x-form-input>

                        <x-form-input
                            name="jumlah"
                            label="Jumlah"
                            type="number"
                            icon="fa-hashtag"
                            min="0"
                            value="{{ old('jumlah', 0) }}"
                            required
                        />

                        <x-form-input name="kondisi" label="Kondisi" type="select" icon="fa-clipboard-check" required>
                            @foreach (['baik', 'rusak', 'hilang'] as $kondisi)
                                <option value="{{ $kondisi }}" @selected(old('kondisi', 'baik') === $kondisi)>{{ ucfirst($kondisi) }}</option>
                            @endforeach
                        </x-form-input>
                    </div>

                    <x-form-input
                        name="deskripsi"
                        label="Deskripsi"
                        type="textarea"
                        icon="fa-align-left"
                        placeholder="Deskripsi barang"
                        class="mt-5"
                        value="{{ old('deskripsi') }}"
                    />

                    <div class="mt-5">
                        <label for="gambar" class="block text-sm font-semibold text-slate-700">Gambar</label>
                        <div class="relative mt-2 flex min-h-24 items-center justify-center rounded-xl border-2 border-dashed border-slate-300 bg-slate-50 px-4 text-center text-sm text-slate-500 transition hover:border-blue-400 hover:bg-blue-50">
                            <span class="pointer-events-none"><i class="fas fa-image mr-2" aria-hidden="true"></i>Pilih gambar barang</span>
                            <input
                                id="gambar"
                                name="gambar"
                                type="file"
                                accept="image/*"
                                class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                            >
                        </div>
                        @error('gambar')
                            <p class="mt-2 text-xs font-medium text-rose-600" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex gap-3 border-t border-slate-200 pt-5">
                        <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                            Simpan
                        </button>
                        <a href="{{ route('barang.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Batal
                        </a>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
