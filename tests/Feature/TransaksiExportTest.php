<?php

use App\Exports\TransaksiExport;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;

it('exports transaksi data with related user and barang details', function () {
    $user = User::factory()->create(['name' => 'Budi']);
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 3,
        'kondisi' => 'baik',
    ]);

    $transaksi = Transaksi::create([
        'user_id' => $user->id,
        'barang_id' => $barang->id,
        'jumlah' => 2,
        'tgl_pinjam' => '2026-11-01',
        'tgl_kembali' => null,
        'status' => 'dipinjam',
    ]);

    $export = new TransaksiExport;

    expect($export->headings())->toBe([
        'ID',
        'Peminjam',
        'Barang',
        'Jumlah',
        'Tgl Pinjam',
        'Tgl Kembali',
        'Status',
    ]);

    expect($export->collection()->map(
        fn (Transaksi $exportedTransaksi): array => $export->map($exportedTransaksi)
    )->all())->toBe([[
        $transaksi->id,
        'Budi',
        'Laptop',
        2,
        '01/11/2026',
        '-',
        'dipinjam',
    ]]);
});
