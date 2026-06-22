<?php

namespace App\Http\Controllers;

use App\Models\InventarisBarang;
use App\Models\PeminjamanBarang;
use Illuminate\Http\Request;

class PeminjamanBarangController extends Controller
{
    public function index()
    {
        $query = PeminjamanBarang::with(['inventaris', 'peminjam', 'approver']);

        // Anggota hanya lihat pengajuan miliknya sendiri, Admin lihat semua
        if (! auth()->user()->isAdmin()) {
            $query->where('peminjam_id', auth()->id());
        }

        $items = $query->orderByDesc('created_at')->paginate(15);

        return view('peminjaman.index', compact('items'));
    }

    public function create()
    {
        $barang = InventarisBarang::orderBy('nama_barang')->get();
        return view('peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventaris_id' => ['required', 'exists:inventaris_barang,id'],
            'jumlah_pinjam' => ['required', 'integer', 'min:1'],
            'tanggal_pinjam' => ['required', 'date'],
            'tanggal_kembali' => ['nullable', 'date', 'after_or_equal:tanggal_pinjam'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['peminjam_id'] = auth()->id();
        $validated['status'] = 'menunggu';

        PeminjamanBarang::create($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dikirim, menunggu persetujuan Admin.');
    }

    public function edit(PeminjamanBarang $peminjaman)
    {
        // Hanya admin yang boleh mengubah status (approve/tolak)
        $this->authorizeAdmin();

        $barang = InventarisBarang::orderBy('nama_barang')->get();

        return view('peminjaman.edit', ['item' => $peminjaman, 'barang' => $barang]);
    }

    public function update(Request $request, PeminjamanBarang $peminjaman)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,disetujui,ditolak,dikembalikan'],
            'tanggal_kembali' => ['nullable', 'date'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['approved_by'] = auth()->id();

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    public function destroy(PeminjamanBarang $peminjaman)
    {
        // Admin boleh hapus apapun; anggota hanya boleh hapus pengajuan miliknya yang masih "menunggu"
        if (! auth()->user()->isAdmin()) {
            if ($peminjaman->peminjam_id !== auth()->id() || $peminjaman->status !== 'menunggu') {
                abort(403, 'Anda tidak dapat menghapus pengajuan ini.');
            }
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    private function authorizeAdmin(): void
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'Hanya Admin yang dapat melakukan aksi ini.');
        }
    }
}