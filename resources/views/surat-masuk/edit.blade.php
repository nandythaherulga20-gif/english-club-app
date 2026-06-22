@extends('layouts.app')

@section('title', 'Edit Surat Masuk')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('surat-masuk.update', $item) }}">
                @csrf
                @method('PUT')
                @include('surat-masuk._form')
                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection