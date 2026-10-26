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

test('category validation returns custom messages', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->from(route('kategori.create'))
        ->post(route('kategori.store'), ['nama' => ''])
        ->assertSessionHasErrors([
            'nama' => 'Nama kategori wajib diisi.',
        ]);
});

test('category with items cannot be deleted', function () {
    $user = User::factory()->create();
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 5,
        'kondisi' => 'baik',
    ]);

    $this->actingAs($user)
        ->delete(route('kategori.destroy', $kategori))
        ->assertRedirect(route('kategori.index'))
        ->assertSessionHas('error', 'Kategori tidak dapat dihapus karena masih memiliki barang.');

    $this->assertDatabaseHas('kategoris', ['id' => $kategori->id]);
    $this->assertDatabaseHas('barangs', ['kategori_id' => $kategori->id]);
});

test('item with an active loan cannot be deleted', function () {
    $user = User::factory()->create();
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 5,
        'kondisi' => 'baik',
    ]);
    Transaksi::create([
        'user_id' => $user->id,
        'barang_id' => $barang->id,
        'jumlah' => 1,
        'tgl_pinjam' => now()->toDateString(),
        'status' => 'dipinjam',
    ]);

    $this->actingAs($user)
        ->delete(route('barang.destroy', $barang))
        ->assertRedirect(route('barang.index'))
        ->assertSessionHas('error', 'Barang tidak dapat dihapus karena masih dipinjam.');

    $this->assertDatabaseHas('barangs', ['id' => $barang->id]);
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

test('staff can fetch inventory data with category details', function () {
    $user = User::factory()->create();
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 5,
        'kondisi' => 'baik',
    ]);

    $this->actingAs($user)
        ->getJson(route('barang.api'))
        ->assertSuccessful()
        ->assertJson([
            [
                'id' => $barang->id,
                'nama' => 'Laptop',
                'kategori_id' => $kategori->id,
                'jumlah' => 5,
                'kategori' => [
                    'id' => $kategori->id,
                    'nama' => 'Elektronik',
                ],
            ],
        ]);
});

test('staff can fetch server-side datatables inventory data', function () {
    $user = User::factory()->create();
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    $barang = Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 5,
        'kondisi' => 'baik',
    ]);

    $this->actingAs($user)
        ->getJson(route('barang.dataTables', [
            'draw' => 1,
            'start' => 0,
            'length' => 10,
        ]))
        ->assertSuccessful()
        ->assertJsonPath('draw', 1)
        ->assertJsonPath('recordsTotal', 1)
        ->assertJsonPath('recordsFiltered', 1)
        ->assertJsonPath('data.0.nama', $barang->nama)
        ->assertJsonPath('data.0.DT_RowIndex', 1)
        ->assertJsonPath('data.0.kategori', $kategori->nama)
        ->assertJsonPath('data.0.action', fn (string $action): bool => str_contains($action, route('barang.edit', $barang)));
});

test('datatables applies server-side sorting and pagination', function () {
    $user = User::factory()->create();
    $kategori = Kategori::create(['nama' => 'Elektronik']);
    Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Laptop',
        'jumlah' => 5,
        'kondisi' => 'baik',
    ]);
    Barang::create([
        'kategori_id' => $kategori->id,
        'nama' => 'Monitor',
        'jumlah' => 4,
        'kondisi' => 'baik',
    ]);

    $this->actingAs($user)
        ->getJson(route('barang.dataTables', [
            'draw' => 2,
            'start' => 0,
            'length' => 1,
            'order' => [
                ['column' => 1, 'dir' => 'desc'],
            ],
            'columns' => [
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'searchable' => 'false', 'orderable' => 'false'],
                ['data' => 'nama', 'name' => 'nama', 'searchable' => 'true', 'orderable' => 'true'],
                ['data' => 'kategori', 'name' => 'kategori', 'searchable' => 'true', 'orderable' => 'true'],
                ['data' => 'jumlah', 'name' => 'jumlah', 'searchable' => 'true', 'orderable' => 'true'],
                ['data' => 'action', 'name' => 'action', 'searchable' => 'false', 'orderable' => 'false'],
            ],
        ]))
        ->assertSuccessful()
        ->assertJsonPath('draw', 2)
        ->assertJsonPath('recordsTotal', 2)
        ->assertJsonPath('recordsFiltered', 2)
        ->assertJsonPath('data.0.nama', 'Monitor')
        ->assertJsonCount(1, 'data');
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
