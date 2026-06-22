@extends('layouts.app')

@section('title', 'Edit Surat Keluar')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('surat-keluar.update', $item) }}">
                @csrf
                @method('PUT')
                @include('surat-keluar._form')
                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection