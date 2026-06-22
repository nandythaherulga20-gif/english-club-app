@extends('layouts.app')

@section('title', 'Tambah Inventaris Barang')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('inventaris.store') }}">
                @csrf
                @include('inventaris._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection