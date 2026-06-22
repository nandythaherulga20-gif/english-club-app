<?php

namespace App\Http\Controllers;

use App\Models\BarangHibah;
use Illuminate\Http\Request;

class BarangHibahController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangHibah::query();

        if ($request->filled('cari')) {
            $query->where('nama_barang', 'like', '%' . $request->cari . '%');
        }

        $items = $query->orderBy('no_urut')->paginate(15)->withQueryString();

        return view('barang-hibah.index', compact('items'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('barang-hibah.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'no_urut' => ['required', 'integer'],
            'nama_barang' => ['required', 'string', 'max:150'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:30'],
        ]);

        $validated['created_by'] = auth()->id();

        BarangHibah::create($validated);

        return redirect()->route('barang-hibah.index')->with('success', 'Data barang hibah berhasil ditambahkan.');
    }

    public function edit(BarangHibah $barang_hibah)
    {
        $this->authorizeAdmin();
        return view('barang-hibah.edit', ['item' => $barang_hibah]);
    }

    public function update(Request $request, BarangHibah $barang_hibah)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'no_urut' => ['required', 'integer'],
            'nama_barang' => ['required', 'string', 'max:150'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:30'],
        ]);

        $barang_hibah->update($validated);

        return redirect()->route('barang-hibah.index')->with('success', 'Data barang hibah berhasil diperbarui.');
    }

    public function destroy(BarangHibah $barang_hibah)
    {
        $this->authorizeAdmin();
        $barang_hibah->delete();

        return redirect()->route('barang-hibah.index')->with('success', 'Data barang hibah berhasil dihapus.');
    }

    private function authorizeAdmin(): void
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'Hanya Admin yang dapat melakukan aksi ini.');
        }
    }
}