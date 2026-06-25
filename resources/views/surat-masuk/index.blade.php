@extends('layouts.app')

@section('title', 'Surat Masuk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="cari" class="form-control" placeholder="Cari perihal/nomor surat..." value="{{ request('cari') }}">
            <button class="btn btn-outline-secondary"><x-icon name="search" /></button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('surat-masuk.create') }}" class="btn btn-primary">
                <x-icon name="plus-lg" /> Tambah Surat Masuk
            </a>
        @endif
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tgl Masuk</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Acara</th>
                            <th>Instansi</th>
                            @if (auth()->user()->isAdmin())
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $items->firstItem() + $loop->index }}</td>
                                <td>{{ $item->tanggal_masuk?->format('d-m-Y') }}</td>
                                <td>{{ $item->nomor_surat }}</td>
                                <td>{{ $item->perihal }}</td>
                                <td>{{ $item->acara }}</td>
                                <td>{{ $item->instansi_penerima }}</td>
                                @if (auth()->user()->isAdmin())
                                    <td class="text-nowrap">
                                        <a href="{{ route('surat-masuk.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <x-icon name="pencil" />
                                        </a>
                                        <form method="POST" action="{{ route('surat-masuk.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><x-icon name="trash" /></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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