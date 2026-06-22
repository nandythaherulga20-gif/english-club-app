@extends('layouts.app')

@section('title', 'Edit Inventaris Barang')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('inventaris.update', $item) }}">
                @csrf
                @method('PUT')
                @include('inventaris._form')
                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection