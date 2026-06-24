@extends('layouts.app')

@section('title', 'Inventaris Barang')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama barang..." value="{{ request('cari') }}">
            <button class="btn btn-outline-secondary"><x-icon name="search" /></button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('inventaris.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Barang
            </a>
        @endif
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Baik</th>
                        <th>Rusak</th>
                        @if (auth()->user()->isAdmin())
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->no_urut }}</td>
                            <td><span class="badge bg-secondary">{{ $item->kategori }}</span></td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td class="text-success">{{ $item->kondisi_baik }}</td>
                            <td class="text-danger">{{ $item->kondisi_rusak }}</td>
                            @if (auth()->user()->isAdmin())
                                <td>
                                    <a href="{{ route('inventaris.edit', $item) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('inventaris.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $items->links() }}
    </div>
@endsection