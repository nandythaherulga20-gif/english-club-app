@extends('layouts.app')

@section('title', 'Peminjaman Barang')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0 text-muted">
            @if (auth()->user()->isAdmin())
                Semua pengajuan peminjaman
            @else
                Pengajuan peminjaman Anda
            @endif
        </h6>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            <x-icon name="plus-lg" /> Ajukan Peminjaman
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Barang</th>
                            <th>Peminjam</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->inventaris->nama_barang ?? '-' }}</td>
                                <td>{{ $item->peminjam->nama ?? '-' }}</td>
                                <td>{{ $item->jumlah_pinjam }}</td>
                                <td>{{ $item->tanggal_pinjam?->format('d-m-Y') }}</td>
                                <td>{{ $item->tanggal_kembali?->format('d-m-Y') ?? '-' }}</td>
                                <td>
                                    @php
                                        $badge = [
                                            'menunggu' => 'warning',
                                            'disetujui' => 'success',
                                            'ditolak' => 'danger',
                                            'dikembalikan' => 'secondary',
                                        ][$item->status] ?? 'light';
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                                </td>
                                <td class="text-nowrap">
                                    @if (auth()->user()->isAdmin())
                                        <a href="{{ route('peminjaman.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Kelola
                                        </a>
                                    @endif
                                    @if (auth()->user()->isAdmin() || ($item->peminjam_id === auth()->id() && $item->status === 'menunggu'))
                                        <form method="POST" action="{{ route('peminjaman.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
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