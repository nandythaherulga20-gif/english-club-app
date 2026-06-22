@extends('layouts.app')

@section('title', 'Kelola Peminjaman')

@section('content')
    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Barang</dt>
                <dd class="col-sm-9">{{ $item->inventaris->nama_barang ?? '-' }}</dd>

                <dt class="col-sm-3">Peminjam</dt>
                <dd class="col-sm-9">{{ $item->peminjam->nama ?? '-' }}</dd>

                <dt class="col-sm-3">Jumlah Pinjam</dt>
                <dd class="col-sm-9">{{ $item->jumlah_pinjam }}</dd>

                <dt class="col-sm-3">Tanggal Pinjam</dt>
                <dd class="col-sm-9">{{ $item->tanggal_pinjam?->format('d-m-Y') }}</dd>
            </dl>

            <hr>

            <form method="POST" action="{{ route('peminjaman.update', $item) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        @foreach (['menunggu', 'disetujui', 'ditolak', 'dikembalikan'] as $status)
                            <option value="{{ $status }}" {{ old('status', $item->status) === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kembali (aktual)</label>
                    <input type="date" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali', $item->tanggal_kembali?->format('Y-m-d')) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $item->keterangan) }}</textarea>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection