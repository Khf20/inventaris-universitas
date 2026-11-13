<?php

use App\Exports\BarangExport;
use App\Exports\TransaksiExport;
use App\Models\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

it('downloads the requested excel report', function (string $jenis, string $filename, string $exportClass) {
    Excel::fake();

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('laporan.excel', $jenis));

    $response->assertSuccessful();
    Excel::assertDownloaded($filename, fn (object $export): bool => $export instanceof $exportClass);
})->with([
    'barang' => ['barang', 'laporan-barang-'.Carbon::today()->format('Y-m-d').'.xlsx', BarangExport::class],
    'transaksi' => ['transaksi', 'laporan-transaksi-'.Carbon::today()->format('Y-m-d').'.xlsx', TransaksiExport::class],
]);

it('downloads a real xlsx file', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('laporan.excel', 'barang'));

    $response->assertSuccessful()
        ->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
});
