<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('kategori.index', ['kategoris' => Kategori::withCount('barangs')->latest()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriRequest $request): RedirectResponse
    {
        Kategori::create($request->validated());

        return to_route('kategori.index')->with('status', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori): View
    {
        return view('kategori.show', ['kategori' => $kategori->load('barangs')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori): View
    {
        return view('kategori.edit', ['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
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
        $kategori->delete();

        return to_route('kategori.index')->with('status', 'Kategori berhasil dihapus.');
    }
}
