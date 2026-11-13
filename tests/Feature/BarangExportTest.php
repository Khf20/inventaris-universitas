<?php

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Kategori;

it('exports barang data with category and formatted creation date', function () {
    $kategori = Kategori::create([
        'nama' => 'Elektronik',
        'deskripsi' => 'Peralatan elektronik',
    ]);

    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 3,
        'kondisi' => 'baik',
        'deskripsi' => 'Laptop untuk laboratorium',
    ]);

    $export = new BarangExport;

    expect($export->headings())->toBe([
        'ID',
        'Kategori',
        'Nama',
        'Jumlah',
        'Kondisi',
        'Deskripsi',
        'Dibuat',
    ]);

    expect($export->collection()->map(
        fn (Barang $exportedBarang): array => $export->map($exportedBarang)
    )->all())->toBe([[
        $barang->id,
        'Elektronik',
        'Laptop',
        3,
        'baik',
        'Laptop untuk laboratorium',
        $barang->created_at->format('d/m/Y'),
    ]]);
});
