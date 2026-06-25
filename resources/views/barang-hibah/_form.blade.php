@php $item = $item ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Nama Barang</label>
    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $item->nama_barang ?? '') }}" required>
    @error('nama_barang') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $item->jumlah ?? 0) }}" required>
        @error('jumlah') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Satuan</label>
        <input type="text" name="satuan" class="form-control" value="{{ old('satuan', $item->satuan ?? '') }}" required>
        @error('satuan') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>