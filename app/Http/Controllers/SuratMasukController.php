<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratMasuk::query();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('perihal', 'like', '%' . $request->cari . '%')
                  ->orWhere('nomor_surat', 'like', '%' . $request->cari . '%')
                  ->orWhere('acara', 'like', '%' . $request->cari . '%');
            });
        }

        $items = $query->orderByDesc('tanggal_masuk')->paginate(15)->withQueryString();

        return view('surat-masuk.index', compact('items'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('surat-masuk.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $this->validateData($request);
        $validated['created_by'] = auth()->id();

        SuratMasuk::create($validated);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function edit(SuratMasuk $surat_masuk)
    {
        $this->authorizeAdmin();
        return view('surat-masuk.edit', ['item' => $surat_masuk]);
    }

    public function update(Request $request, SuratMasuk $surat_masuk)
    {
        $this->authorizeAdmin();

        $validated = $this->validateData($request);
        $surat_masuk->update($validated);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil diperbarui.');
    }

    public function destroy(SuratMasuk $surat_masuk)
    {
        $this->authorizeAdmin();
        $surat_masuk->delete();

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'no_urut' => ['required', 'integer'],
            'tanggal_masuk' => ['nullable', 'date'],
            'nomor_surat' => ['required', 'string', 'max:100'],
            'tanggal_surat' => ['nullable', 'date'],
            'kegiatan_teks' => ['nullable', 'string', 'max:180'],
            'tanggal_kegiatan_mulai' => ['nullable', 'date'],
            'tanggal_kegiatan_selesai' => ['nullable', 'date'],
            'perihal' => ['nullable', 'string', 'max:255'],
            'acara' => ['nullable', 'string', 'max:255'],
            'instansi_penerima' => ['nullable', 'string', 'max:150'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function authorizeAdmin(): void
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'Hanya Admin yang dapat melakukan aksi ini.');
        }
    }
}