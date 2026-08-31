<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriMap = [
            'Elektronik' => Kategori::where('nama', 'Elektronik')->value('id'),
            'Perabotan' => Kategori::where('nama', 'Perabotan')->value('id'),
            'Alat Tulis' => Kategori::where('nama', 'Alat Tulis')->value('id'),
            'Komputer' => Kategori::where('nama', 'Komputer')->value('id'),
        ];

        $barangs = [
            ['nama' => 'Laptop', 'kategori_id' => $kategoriMap['Komputer'], 'jumlah' => 5, 'kondisi' => 'baik', 'deskripsi' => 'Laptop untuk kerja dan pembelajaran', 'gambar' => null],
            ['nama' => 'Monitor', 'kategori_id' => $kategoriMap['Komputer'], 'jumlah' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Monitor LCD 24 inch', 'gambar' => null],
            ['nama' => 'Printer', 'kategori_id' => $kategoriMap['Elektronik'], 'jumlah' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Printer kantor', 'gambar' => null],
            ['nama' => 'Meja Kerja', 'kategori_id' => $kategoriMap['Perabotan'], 'jumlah' => 6, 'kondisi' => 'baik', 'deskripsi' => 'Meja kerja staff', 'gambar' => null],
            ['nama' => 'Pensil', 'kategori_id' => $kategoriMap['Alat Tulis'], 'jumlah' => 30, 'kondisi' => 'baik', 'deskripsi' => 'Pensil 2B', 'gambar' => null],
            ['nama' => 'Kertas A4', 'kategori_id' => $kategoriMap['Alat Tulis'], 'jumlah' => 100, 'kondisi' => 'baik', 'deskripsi' => 'Kertas untuk pencetakan', 'gambar' => null],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
