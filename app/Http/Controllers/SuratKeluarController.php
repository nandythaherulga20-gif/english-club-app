<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratKeluar::query();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('perihal', 'like', '%' . $request->cari . '%')
                  ->orWhere('nomor_surat', 'like', '%' . $request->cari . '%')
                  ->orWhere('acara', 'like', '%' . $request->cari . '%');
            });
        }

        $items = $query->orderByDesc('tanggal_keluar')->paginate(15)->withQueryString();

        return view('surat-keluar.index', compact('items'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('surat-keluar.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $this->validateData($request);
        $validated['no_urut']    = (SuratKeluar::max('no_urut') ?? 0) + 1;
        $validated['created_by'] = auth()->id();

        SuratKeluar::create($validated);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function edit(SuratKeluar $surat_keluar)
    {
        $this->authorizeAdmin();
        return view('surat-keluar.edit', ['item' => $surat_keluar]);
    }

    public function update(Request $request, SuratKeluar $surat_keluar)
    {
        $this->authorizeAdmin();

        $validated = $this->validateData($request);
        $surat_keluar->update($validated);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function destroy(SuratKeluar $surat_keluar)
    {
        $this->authorizeAdmin();

        $surat_keluar->delete();

        // Resequence no_urut dari 1
        SuratKeluar::orderBy('id')->each(function ($item, $index) {
            $item->updateQuietly(['no_urut' => $index + 1]);
        });

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tanggal_keluar'          => ['nullable', 'date'],
            'nomor_surat'             => ['required', 'string', 'max:100'],
            'tanggal_surat'           => ['nullable', 'date'],
            'kegiatan_teks'           => ['nullable', 'string', 'max:180'],
            'tanggal_kegiatan_mulai'  => ['nullable', 'date'],
            'tanggal_kegiatan_selesai'=> ['nullable', 'date'],
            'perihal'                 => ['nullable', 'string', 'max:255'],
            'acara'                   => ['nullable', 'string', 'max:255'],
            'instansi_penerima'       => ['nullable', 'string', 'max:100'],
            'keterangan'              => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function authorizeAdmin(): void
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'Hanya Admin yang dapat melakukan aksi ini.');
        }
    }
}