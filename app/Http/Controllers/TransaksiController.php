<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiRequest;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Transaksi::with(['user', 'barang']);

        if (Auth::user()->role === 'staff') {
            $query->where('user_id', Auth::id());
        }

        return view('transaksi.index', [
            'transaksis' => $query->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('transaksi.create', ['barangs' => Barang::orderBy('nama')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiRequest $request, DatabaseManager $database): RedirectResponse
    {
        $data = $request->validated();

        $database->transaction(function () use ($data, $request): void {
            $barang = Barang::lockForUpdate()->findOrFail($data['barang_id']);

            if ($data['status'] === 'dipinjam' && $data['jumlah'] > $barang->jumlah) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Jumlah pinjaman melebihi stok yang tersedia.',
                ]);
            }

            if ($data['status'] === 'dipinjam') {
                $barang->decrement('jumlah', $data['jumlah']);
            }

            Transaksi::create([...$data, 'user_id' => $request->user()->id]);
        });

        return to_route('transaksi.index')->with('status', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi): View
    {
        return view('transaksi.show', ['transaksi' => $transaksi->load(['user', 'barang'])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi): View
    {
        return view('transaksi.edit', [
            'transaksi' => $transaksi,
            'barangs' => Barang::orderBy('nama')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransaksiRequest $request, Transaksi $transaksi, DatabaseManager $database): RedirectResponse
    {
        $data = $request->validated();

        $database->transaction(function () use ($data, $transaksi): void {
            $oldBarang = Barang::lockForUpdate()->findOrFail($transaksi->barang_id);

            if ($transaksi->status === 'dipinjam') {
                $oldBarang->increment('jumlah', $transaksi->jumlah);
            }

            $newBarang = $data['barang_id'] === $transaksi->barang_id
                ? $oldBarang->refresh()
                : Barang::lockForUpdate()->findOrFail($data['barang_id']);

            if ($data['status'] === 'dipinjam' && $data['jumlah'] > $newBarang->jumlah) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Jumlah pinjaman melebihi stok yang tersedia.',
                ]);
            }

            if ($data['status'] === 'dipinjam') {
                $newBarang->decrement('jumlah', $data['jumlah']);
            }

            $transaksi->update($data);
        });

        return to_route('transaksi.index')->with('status', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi, DatabaseManager $database): RedirectResponse
    {
        $database->transaction(function () use ($transaksi): void {
            if ($transaksi->status === 'dipinjam') {
                Barang::lockForUpdate()->findOrFail($transaksi->barang_id)->increment('jumlah', $transaksi->jumlah);
            }

            $transaksi->delete();
        });

        return to_route('transaksi.index')->with('status', 'Transaksi berhasil dihapus.');
    }
}
