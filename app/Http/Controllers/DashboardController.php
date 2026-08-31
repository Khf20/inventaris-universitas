<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'totalBarang' => Barang::count(),
            'totalKategori' => Kategori::count(),
            'barangDipinjam' => Transaksi::where('status', 'dipinjam')->count(),
            'totalStok' => Barang::sum('jumlah'),
            'transaksiTerbaru' => Transaksi::with(['user', 'barang'])
                ->latest()
                ->take(5)
                ->get(),
            'stokMenipis' => Barang::with('kategori')
                ->where('jumlah', '<', 5)
                ->orderBy('jumlah')
                ->take(5)
                ->get(),
        ]);
    }
}
