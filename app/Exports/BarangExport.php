<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection(): Collection
    {
        return Barang::with('kategori')->get();
    }

    /**
     * @return array<int, string>
     */
    public function headings(): array
    {
        return [
            'ID',
            'Kategori',
            'Nama',
            'Jumlah',
            'Kondisi',
            'Deskripsi',
            'Dibuat',
        ];
    }

    /**
     * @return array<int, array<string, array<string, bool>>>
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * @return array<int, int|string|null>
     */
    public function map($barang): array
    {
        return [
            $barang->id,
            $barang->kategori->nama,
            $barang->nama,
            $barang->jumlah,
            $barang->kondisi,
            $barang->deskripsi,
            $barang->created_at->format('d/m/Y'),
        ];
    }
}
