@php $item = $item ?? null; @endphp

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">No Urut</label>
        <input type="number" name="no_urut" class="form-control" value="{{ old('no_urut', $item->no_urut ?? '') }}" required>
        @error('no_urut') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $item->tanggal_masuk?->format('Y-m-d') ?? '') }}">
    </div>
    <div class="col-md-5 mb-3">
        <label class="form-label">Nomor Surat</label>
        <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $item->nomor_surat ?? '') }}" required>
        @error('nomor_surat') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Tanggal Surat</label>
        <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $item->tanggal_surat?->format('Y-m-d') ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Tgl Kegiatan Mulai</label>
        <input type="date" name="tanggal_kegiatan_mulai" class="form-control" value="{{ old('tanggal_kegiatan_mulai', $item->tanggal_kegiatan_mulai?->format('Y-m-d') ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Tgl Kegiatan Selesai</label>
        <input type="date" name="tanggal_kegiatan_selesai" class="form-control" value="{{ old('tanggal_kegiatan_selesai', $item->tanggal_kegiatan_selesai?->format('Y-m-d') ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Kegiatan (teks bebas)</label>
    <input type="text" name="kegiatan_teks" class="form-control" value="{{ old('kegiatan_teks', $item->kegiatan_teks ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Perihal</label>
    <input type="text" name="perihal" class="form-control" value="{{ old('perihal', $item->perihal ?? '') }}">
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Acara</label>
        <input type="text" name="acara" class="form-control" value="{{ old('acara', $item->acara ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Instansi Penerima</label>
        <input type="text" name="instansi_penerima" class="form-control" value="{{ old('instansi_penerima', $item->instansi_penerima ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Keterangan</label>
    <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $item->keterangan ?? '') }}">
</div>