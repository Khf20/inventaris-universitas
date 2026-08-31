<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategories = [
            ['nama' => 'Elektronik', 'deskripsi' => 'Perangkat elektronik rumah dan kantor'],
            ['nama' => 'Perabotan', 'deskripsi' => 'Perabot dan furnitur'],
            ['nama' => 'Alat Tulis', 'deskripsi' => 'Alat tulis dan kebutuhan administrasi'],
            ['nama' => 'Komputer', 'deskripsi' => 'Perangkat komputer dan aksesoris'],
        ];

        foreach ($kategories as $kategori) {
            Kategori::create($kategori);
        }
    }
}
