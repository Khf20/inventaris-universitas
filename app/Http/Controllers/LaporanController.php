<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function exportPdfBarang(): Response
    {
        $barangs = Barang::with('kategori')->latest()->get();

        return Pdf::loadView('laporan.pdf.barang', compact('barangs'))
            ->download('laporan-barang-'.now()->format('Y-m-d').'.pdf');
    }

    public function exportPdfTransaksi(): Response
    {
        $transaksi = Transaksi::with(['user', 'barang'])->latest()->get();

        return Pdf::loadView('laporan.pdf.transaksi', compact('transaksi'))
            ->download('laporan-transaksi-'.now()->format('Y-m-d').'.pdf');
    }

    public function index(): View
    {
        return view('laporan.index', [
            'totalBarang' => Barang::count(),
            'totalKategori' => Kategori::count(),
            'totalStok' => Barang::sum('jumlah'),
            'transaksi' => Transaksi::with(['user', 'barang'])->latest()->get(),
        ]);
    }
}
