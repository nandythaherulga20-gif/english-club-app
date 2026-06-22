@extends('layouts.app')

@section('title', 'Edit Barang Hibah')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('barang-hibah.update', $item) }}">
                @csrf
                @method('PUT')
                @include('barang-hibah._form')
                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('barang-hibah.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection