<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Ajax Test</h2>
                <p class="mt-1 text-sm text-slate-500">Uji coba request Ajax dengan jQuery</p>
            </div>
            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                API Demo
            </span>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-5xl space-y-5 px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Daftar Barang</h3>
                        <p class="mt-1 text-sm text-slate-500">Muat data barang dan kategori tanpa me-refresh halaman.</p>
                    </div>
                    <button id="loadData" type="button" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                        <i class="fas fa-sync" aria-hidden="true"></i>
                        <span>Muat Barang</span>
                    </button>
                </div>

                <div id="result" class="mt-6">
                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-10 text-center">
                        <i class="fas fa-box-open text-3xl text-slate-300" aria-hidden="true"></i>
                        <p class="mt-3 text-sm text-slate-500">Klik tombol untuk memuat data barang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const $ = window.jQuery;

                if (!$) {
                    console.error('jQuery belum tersedia untuk halaman Ajax Test.');

                    return;
                }

                $('#loadData').click(function () {
                    const button = $(this);
                    button.prop('disabled', true).addClass('cursor-wait opacity-75');
                    $('#result').html('<div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-10 text-center text-sm text-slate-500"><i class="fas fa-spinner fa-spin mr-2" aria-hidden="true"></i>Memuat data...</div>');

                    $.getJSON('{{ route('barang.api') }}', function (data) {
                        let html = '';

                        if (data.length === 0) {
                            html = '<div class="rounded-xl border border-dashed border-slate-300 px-4 py-10 text-center text-sm text-slate-500">Belum ada data barang.</div>';
                        } else {
                            html = '<div class="overflow-hidden rounded-xl border border-slate-200"><div class="overflow-x-auto"><table class="min-w-full text-left text-sm"><thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-5 py-3 font-semibold">Nama Barang</th><th class="px-5 py-3 font-semibold">Kategori</th><th class="px-5 py-3 font-semibold">Jumlah</th></tr></thead><tbody class="divide-y divide-slate-100 bg-white">';

                            $.each(data, function (index, item) {
                                html += '<tr class="transition hover:bg-slate-50"><td class="whitespace-nowrap px-5 py-4 font-medium text-slate-900">' + item.nama + '</td><td class="px-5 py-4 text-slate-600">' + (item.kategori ? item.kategori.nama : 'Tanpa kategori') + '</td><td class="px-5 py-4 text-slate-600">' + item.jumlah + '</td></tr>';
                            });

                            html += '</tbody></table></div></div>';
                        }

                        $('#result').html(html);
                    }).fail(function () {
                        $('#result').html('<div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-4 text-sm text-rose-700">Data barang gagal dimuat. Silakan coba lagi.</div>');
                    }).always(function () {
                        button.prop('disabled', false).removeClass('cursor-wait opacity-75');
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
