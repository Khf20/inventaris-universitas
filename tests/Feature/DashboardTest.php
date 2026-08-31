<?php

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
});

test('dashboard provides inventory statistics and recent records', function () {
    $user = User::factory()->create();
    $kategori = new Kategori(['nama' => 'Elektronik']);
    $kategori->save();

    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 3,
        'kondisi' => 'baik',
    ]);

    Transaksi::create([
        'user_id' => $user->id,
        'barang_id' => $barang->id,
        'jumlah' => 2,
        'tgl_pinjam' => now()->toDateString(),
        'status' => 'dipinjam',
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertOk()
        ->assertViewIs('dashboard')
        ->assertViewHas('totalBarang', 1)
        ->assertViewHas('totalKategori', 1)
        ->assertViewHas('barangDipinjam', 2)
        ->assertViewHas('totalStok', 3)
        ->assertViewHas('transaksiTerbaru', fn ($transaksi) => $transaksi->count() === 1
            && $transaksi->first()->relationLoaded('user')
            && $transaksi->first()->relationLoaded('barang'))
        ->assertViewHas('stokMenipis', fn ($stokMenipis) => $stokMenipis->count() === 1
            && $stokMenipis->first()->id === $barang->id);
});
