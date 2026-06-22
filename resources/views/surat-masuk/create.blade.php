@extends('layouts.app')

@section('title', 'Tambah Surat Masuk')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('surat-masuk.store') }}">
                @csrf
                @include('surat-masuk._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection