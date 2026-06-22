@extends('layouts.app')

@section('title', 'Tambah Barang Hibah')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('barang-hibah.store') }}">
                @csrf
                @include('barang-hibah._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang-hibah.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection