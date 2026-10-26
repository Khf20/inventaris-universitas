<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Data Barang</h2>
            <p class="mt-1 text-sm text-slate-500">Daftar barang dengan DataTables server-side.</p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="overflow-x-auto">
                    <table id="barangTable" class="display min-w-full" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            #barangTable_wrapper .dt-layout-row {
                align-items: center;
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: space-between;
                margin: 0.25rem 0 1rem;
            }

            #barangTable_wrapper .dt-length,
            #barangTable_wrapper .dt-search,
            #barangTable_wrapper .dt-info {
                color: rgb(71 85 105);
                font-size: 0.875rem;
            }

            #barangTable_wrapper select,
            #barangTable_wrapper input {
                border: 1px solid rgb(203 213 225);
                border-radius: 0.5rem;
                padding: 0.5rem 0.75rem;
            }

            #barangTable_wrapper input:focus,
            #barangTable_wrapper select:focus {
                border-color: rgb(59 130 246);
                outline: 2px solid rgb(191 219 254);
                outline-offset: 1px;
            }

            #barangTable thead th {
                background: rgb(248 250 252);
                color: rgb(71 85 105);
                font-size: 0.75rem;
                font-weight: 700;
                letter-spacing: 0.05em;
                padding: 0.75rem 1rem;
                text-transform: uppercase;
            }

            #barangTable tbody td {
                border-top: 1px solid rgb(241 245 249);
                color: rgb(51 65 85);
                padding: 0.875rem 1rem;
            }

            #barangTable tbody tr:hover {
                background: rgb(248 250 252);
            }

            #barangTable_wrapper .dt-paging-button {
                border: 1px solid rgb(226 232 240) !important;
                border-radius: 0.375rem !important;
                color: rgb(71 85 105) !important;
                margin-left: 0.25rem !important;
            }

            #barangTable_wrapper .dt-paging-button.current {
                background: rgb(15 23 42) !important;
                color: white !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            window.addEventListener('load', function () {
                if (!window.DataTable) {
                    console.error('DataTables belum tersedia untuk halaman barang.');

                    return;
                }

                new window.DataTable('#barangTable', {
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('barang.dataTables') }}',
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                        },
                        {
                            data: 'kategori',
                            name: 'kategori',
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                        },
                    ],
                    order: [[1, 'asc']],
                });
            });
        </script>
    @endpush
</x-app-layout>
