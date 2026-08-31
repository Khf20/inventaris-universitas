<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\View\View;

class LaporanController extends Controller
{
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
