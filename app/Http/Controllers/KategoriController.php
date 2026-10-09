<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(): View
    {
        return view('kategori.index', ['kategoris' => Kategori::withCount('barangs')->latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('kategori.create');
    }

    public function store(KategoriRequest $request): RedirectResponse
    {
        Kategori::create($request->validated());

        return to_route('kategori.index')->with('status', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori): View
    {
        return view('kategori.show', ['kategori' => $kategori->load('barangs')]);
    }

    public function edit(Kategori $kategori): View
    {
        return view('kategori.edit', ['kategori' => $kategori]);
    }

    public function update(KategoriRequest $request, Kategori $kategori): RedirectResponse
    {
        $kategori->update($request->validated());

        return to_route('kategori.index')->with('status', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori): RedirectResponse
    {
        if ($kategori->barangs()->exists()) {
            return to_route('kategori.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki barang.');
        }

        $kategori->delete();

        return to_route('kategori.index')->with('status', 'Kategori berhasil dihapus.');
    }
}
