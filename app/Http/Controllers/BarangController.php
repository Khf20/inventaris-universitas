<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

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

        return view('pages.barang.index', [
            'barangs' => $barangs,
            'kategoris' => Kategori::orderBy('nama')->get(),
            'search' => $request->input('search', ''),
            'kategoriId' => $request->input('kategori_id', ''),
        ]);
    }

    /**
     * Return inventory data for AJAX requests.
     */
    public function apiIndex(): JsonResponse
    {
        $barangs = Barang::with('kategori')
            ->select(['id', 'nama', 'kategori_id', 'jumlah'])
            ->get();

        return response()->json($barangs);
    }

    /**
     * Return server-side inventory data for DataTables.
     */
    public function dataTables(): JsonResponse
    {
        $barangs = Barang::with('kategori')->select('barangs.*');

        return DataTables::of($barangs)
            ->addIndexColumn()
            ->addColumn('kategori', fn (Barang $barang): string => $barang->kategori?->nama ?? 'Tanpa kategori')
            ->addColumn('action', function (Barang $barang): string {
                return '<div class="flex gap-3">'
                    .'<a class="text-blue-600 hover:underline" href="'.route('barang.show', $barang).'">Detail</a>'
                    .'<a class="text-slate-600 hover:underline" href="'.route('barang.edit', $barang).'">Edit</a>'
                    .'</div>';
            })
            ->orderColumn('kategori', function (Builder $query, string $order): void {
                $query->orderBy(
                    Kategori::select('nama')
                        ->whereColumn('kategoris.id', 'barangs.kategori_id'),
                    $order,
                );
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.barang.create', ['kategoris' => Kategori::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();

            $file->storeAs('barang', $filename, 'public');
            $data['gambar'] = 'storage/barang/'.$filename;
        }

        Barang::create($data);

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
        return view('pages.barang.edit', [
            'barang' => $barang,
            'kategoris' => Kategori::orderBy('nama')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request, Barang $barang): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();

            $file->storeAs('barang', $filename, 'public');
            $data['gambar'] = 'storage/barang/'.$filename;
        }

        $barang->update($data);

        return to_route('barang.index')->with('status', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang): RedirectResponse
    {
        if ($barang->transaksis()->where('status', 'dipinjam')->exists()) {
            return to_route('barang.index')->with('error', 'Barang tidak dapat dihapus karena masih dipinjam.');
        }

        $barang->delete();

        return to_route('barang.index')->with('status', 'Barang berhasil dihapus.');
    }
}
