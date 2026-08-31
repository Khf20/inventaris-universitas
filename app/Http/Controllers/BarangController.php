<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $barangs = Barang::with('kategori')
            ->when($request->filled('search'), function ($query) use ($request): void {
                $query->where('nama', 'like', '%'.$request->input('search').'%');
            })
            ->when($request->filled('kategori_id'), function ($query) use ($request): void {
                $query->where('kategori_id', $request->integer('kategori_id'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('barang.index', [
            'barangs' => $barangs,
            'kategoris' => Kategori::orderBy('nama')->get(),
            'search' => $request->input('search', ''),
            'kategoriId' => $request->input('kategori_id', ''),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('barang.create', ['kategoris' => Kategori::orderBy('nama')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request): RedirectResponse
    {
        Barang::create($request->validated());

        return to_route('barang.index')->with('status', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang): View
    {
        return view('barang.show', ['barang' => $barang->load('kategori')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang): View
    {
        return view('barang.edit', [
            'barang' => $barang,
            'kategoris' => Kategori::orderBy('nama')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request, Barang $barang): RedirectResponse
    {
        $barang->update($request->validated());

        return to_route('barang.index')->with('status', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang): RedirectResponse
    {
        $barang->delete();

        return to_route('barang.index')->with('status', 'Barang berhasil dihapus.');
    }
}
