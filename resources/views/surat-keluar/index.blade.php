@extends('layouts.app')

@section('title', 'Surat Keluar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="cari" class="form-control" placeholder="Cari perihal/nomor surat..." value="{{ request('cari') }}">
            <button class="btn btn-outline-secondary"><x-icon name="search" /></button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Surat Keluar
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
                            <th>Tgl Keluar</th>
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
                                <td>{{ $item->no_urut }}</td>
                                <td>{{ $item->tanggal_keluar?->format('d-m-Y') }}</td>
                                <td>{{ $item->nomor_surat }}</td>
                                <td>{{ $item->perihal }}</td>
                                <td>{{ $item->acara }}</td>
                                <td>{{ $item->instansi_penerima }}</td>
                                @if (auth()->user()->isAdmin())
                                    <td class="text-nowrap">
                                        <a href="{{ route('surat-keluar.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('surat-keluar.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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

    <div class="mt-3">
        {{ $items->links() }}
    </div>
@endsection