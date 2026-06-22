<?php

namespace App\Http\Controllers;

use App\Models\InventarisBarang;
use Illuminate\Http\Request;

class InventarisBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = InventarisBarang::query();

        if ($request->filled('cari')) {
            $query->where('nama_barang', 'like', '%' . $request->cari . '%');
        }

        $items = $query->orderBy('no_urut')->paginate(15)->withQueryString();

        return view('inventaris.index', compact('items'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('inventaris.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'no_urut' => ['required', 'integer'],
            'kategori' => ['required', 'string', 'max:50'],
            'nama_barang' => ['required', 'string', 'max:150'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:30'],
            'kondisi_baik' => ['required', 'integer', 'min:0'],
            'kondisi_rusak' => ['required', 'integer', 'min:0'],
        ]);

        $validated['created_by'] = auth()->id();

        InventarisBarang::create($validated);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function edit(InventarisBarang $inventaris)
    {
        $this->authorizeAdmin();

        return view('inventaris.edit', ['item' => $inventaris]);
    }

    public function update(Request $request, InventarisBarang $inventaris)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'no_urut' => ['required', 'integer'],
            'kategori' => ['required', 'string', 'max:50'],
            'nama_barang' => ['required', 'string', 'max:150'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:30'],
            'kondisi_baik' => ['required', 'integer', 'min:0'],
            'kondisi_rusak' => ['required', 'integer', 'min:0'],
        ]);

        $inventaris->update($validated);

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(InventarisBarang $inventaris)
    {
        $this->authorizeAdmin();

        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil dihapus.');
    }

    private function authorizeAdmin(): void
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'Hanya Admin yang dapat melakukan aksi ini.');
        }
    }
}