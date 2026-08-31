<?php

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;

test('staff can create a category and an item', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->post(route('kategori.store'), [
        'nama' => 'Elektronik',
        'deskripsi' => 'Perangkat elektronik',
    ])->assertRedirect(route('kategori.index'));

    $kategori = Kategori::firstOrFail();

    $this->post(route('barang.store'), [
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 5,
        'kondisi' => 'baik',
    ])->assertRedirect(route('barang.index'));

    $this->assertDatabaseHas('barangs', [
        'nama' => 'Laptop',
        'jumlah' => 5,
    ]);
});

test('borrowing an item reduces available stock', function () {
    $user = User::factory()->create();
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 5,
        'kondisi' => 'baik',
    ]);

    $this->actingAs($user)
        ->post(route('transaksi.store'), [
            'barang_id' => $barang->id,
            'jumlah' => 2,
            'tgl_pinjam' => now()->toDateString(),
            'status' => 'dipinjam',
        ])
        ->assertRedirect(route('transaksi.index'));

    expect($barang->refresh()->jumlah)->toBe(3);
    expect(Transaksi::first()->jumlah)->toBe(2);
});

test('staff can open the inventory report', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('laporan.index'))
        ->assertSuccessful()
        ->assertViewIs('laporan.index');
});

test('staff only sees their own transactions while admins see all transactions', function () {
    $staff = User::factory()->create(['role' => 'staff']);
    $otherStaff = User::factory()->create(['role' => 'staff']);
    $admin = User::factory()->create(['role' => 'admin']);
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 10,
        'kondisi' => 'baik',
    ]);

    $ownTransaction = Transaksi::create([
        'user_id' => $staff->id,
        'barang_id' => $barang->id,
        'jumlah' => 1,
        'tgl_pinjam' => now()->toDateString(),
        'status' => 'dipinjam',
    ]);
    $otherTransaction = Transaksi::create([
        'user_id' => $otherStaff->id,
        'barang_id' => $barang->id,
        'jumlah' => 1,
        'tgl_pinjam' => now()->toDateString(),
        'status' => 'dipinjam',
    ]);

    $this->actingAs($staff)
        ->get(route('transaksi.index'))
        ->assertViewHas('transaksis', fn ($transaksis) => $transaksis->pluck('id')->all() === [$ownTransaction->id]);

    $this->actingAs($admin)
        ->get(route('transaksi.index'))
        ->assertViewHas('transaksis', fn ($transaksis) => $transaksis->pluck('id')->sort()->values()->all() === collect([$ownTransaction->id, $otherTransaction->id])->sort()->values()->all());
});
