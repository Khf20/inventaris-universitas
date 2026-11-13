<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection(): Collection
    {
        return Transaksi::with(['user', 'barang'])->latest()->get();
    }

    /**
     * @return array<int, string>
     */
    public function headings(): array
    {
        return [
            'ID',
            'Peminjam',
            'Barang',
            'Jumlah',
            'Tgl Pinjam',
            'Tgl Kembali',
            'Status',
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
     * @return array<int, int|string>
     */
    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->user->name,
            $transaksi->barang->nama,
            $transaksi->jumlah,
            $transaksi->tgl_pinjam->format('d/m/Y'),
            $transaksi->tgl_kembali ? $transaksi->tgl_kembali->format('d/m/Y') : '-',
            $transaksi->status,
        ];
    }
}
