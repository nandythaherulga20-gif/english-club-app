@extends('layouts.app')

@section('title', 'Ajukan Peminjaman Barang')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('peminjaman.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Barang</label>
                    <select name="inventaris_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" {{ old('inventaris_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->nama_barang }} (tersedia: {{ $b->jumlah }} {{ $b->satuan }})
                            </option>
                        @endforeach
                    </select>
                    @error('inventaris_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jumlah Pinjam</label>
                        <input type="number" name="jumlah_pinjam" class="form-control" min="1" value="{{ old('jumlah_pinjam', 1) }}" required>
                        @error('jumlah_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam') }}" required>
                        @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Rencana Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali') }}">
                        @error('tanggal_kembali') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan / Tujuan Peminjaman</label>
                    <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
                </div>

                <button class="btn btn-primary">Ajukan</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection