@extends('layouts.app')

@section('title', 'Barang Hibah')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama barang..." value="{{ request('cari') }}">
            <button class="btn btn-outline-secondary"><x-icon name="search" /></button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('barang-hibah.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Barang Hibah
            </a>
        @endif
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        @if (auth()->user()->isAdmin())
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->no_urut }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->satuan }}</td>
                            @if (auth()->user()->isAdmin())
                                <td>
                                    <a href="{{ route('barang-hibah.edit', $item) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('barang-hibah.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between align-items-center">
    <small class="text-muted">
        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results
    </small>
    <div class="d-flex gap-2">
        @if ($items->onFirstPage())
            <button class="btn btn-outline-secondary btn-sm" disabled>« Previous</button>
        @else
            <a href="{{ $items->previousPageUrl() }}" class="btn btn-outline-primary btn-sm">« Previous</a>
        @endif

        @if ($items->hasMorePages())
            <a href="{{ $items->nextPageUrl() }}" class="btn btn-primary btn-sm">Next »</a>
        @else
            <button class="btn btn-outline-secondary btn-sm" disabled>Next »</button>
        @endif
    </div>
</div>
@endsection