<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.18em] text-slate-500">Inventaris Universitas</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Ringkasan inventaris</h1>
                <p class="mt-2 text-slate-600">Pantau stok dan aktivitas peminjaman terbaru.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                @foreach ([
                    ['label' => 'Total Barang', 'value' => $totalBarang, 'icon' => '▦', 'class' => 'from-[#667eea] to-[#536dce]'],
                    ['label' => 'Total Kategori', 'value' => $totalKategori, 'icon' => '◈', 'class' => 'from-[#11998e] to-[#087f75]'],
                    ['label' => 'Barang Dipinjam', 'value' => $barangDipinjam, 'icon' => '↗', 'class' => 'from-[#f093fb] to-[#d86fe4]'],
                    ['label' => 'Total Stok', 'value' => $totalStok, 'icon' => '✓', 'class' => 'from-[#4facfe] to-[#2588dc]'],
                ] as $stat)
                    <div class="overflow-hidden rounded-2xl bg-gradient-to-br {{ $stat['class'] }} p-5 text-white shadow-lg shadow-slate-200">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-white/80">{{ $stat['label'] }}</p>
                                <p class="mt-3 text-3xl font-bold">{{ number_format($stat['value']) }}</p>
                            </div>
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-xl" aria-hidden="true">{{ $stat['icon'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid gap-6 xl:grid-cols-[minmax(0,1.5fr)_minmax(320px,1fr)]">
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="flex items-center justify-between gap-4 border-b border-slate-200 px-6 py-5">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Transaksi terbaru</h2>
                            <p class="mt-1 text-sm text-slate-500">Lima aktivitas peminjaman terakhir.</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="px-6 py-3 font-semibold">Barang</th>
                                    <th class="px-6 py-3 font-semibold">Peminjam</th>
                                    <th class="px-6 py-3 font-semibold">Jumlah</th>
                                    <th class="px-6 py-3 font-semibold">Tanggal</th>
                                    <th class="px-6 py-3 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($transaksiTerbaru as $transaksi)
                                    <tr class="text-slate-700">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900">{{ $transaksi->barang->nama }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $transaksi->user->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ number_format($transaksi->jumlah) }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $transaksi->tgl_pinjam?->format('d/m/Y') ?? '-' }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $transaksi->status === 'dipinjam' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                                                {{ ucfirst($transaksi->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada transaksi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-lg font-semibold text-slate-900">Stok menipis</h2>
                        <p class="mt-1 text-sm text-slate-500">Barang dengan stok kurang dari 5 unit.</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="px-6 py-3 font-semibold">Barang</th>
                                    <th class="px-6 py-3 font-semibold">Kategori</th>
                                    <th class="px-6 py-3 font-semibold">Stok</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($stokMenipis as $barang)
                                    <tr class="text-slate-700">
                                        <td class="px-6 py-4 font-medium text-slate-900">{{ $barang->nama }}</td>
                                        <td class="px-6 py-4">{{ $barang->kategori->nama }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <span class="rounded-full bg-rose-100 px-3 py-1 text-sm font-semibold text-rose-700">{{ $barang->jumlah }} unit</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-slate-500">Semua stok masih aman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Aksi cepat</h2>
                    <p class="mt-1 text-sm text-slate-500">Akses cepat ke alur kerja inventaris.</p>
                </div>
                <div class="mt-5 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                    <a href="{{ route('barang.create') }}" class="flex items-center justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-2">Tambah Barang</a>
                    <a href="{{ route('kategori.create') }}" class="flex items-center justify-center rounded-xl bg-violet-600 px-4 py-3 text-sm font-semibold text-white hover:bg-violet-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-violet-600 focus-visible:ring-offset-2">Tambah Kategori</a>
                    <a href="{{ route('transaksi.create') }}" class="flex items-center justify-center rounded-xl bg-amber-500 px-4 py-3 text-sm font-semibold text-white hover:bg-amber-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2">Pinjam Barang</a>
                    <a href="{{ route('laporan.index') }}" class="flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 focus-visible:ring-offset-2">Cetak Laporan</a>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
