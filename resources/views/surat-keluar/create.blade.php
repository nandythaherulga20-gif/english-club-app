@extends('layouts.app')

@section('title', 'Tambah Surat Keluar')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('surat-keluar.store') }}">
                @csrf
                @include('surat-keluar._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection