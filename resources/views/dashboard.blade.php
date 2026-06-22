@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h3>Selamat datang, {{ auth()->user()->nama }}!</h3>
    <p class="text-muted">Role: {{ auth()->user()->role }}</p>

    <div class="row mt-4 g-3">
        <div class="col-md-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h6>Total Inventaris</h6>
                    <h3>{{ \App\Models\InventarisBarang::count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h6>Barang Hibah</h6>
                    <h3>{{ \App\Models\BarangHibah::count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info">
                <div class="card-body">
                    <h6>Surat Masuk</h6>
                    <h3>{{ \App\Models\SuratMasuk::count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h6>Surat Keluar</h6>
                    <h3>{{ \App\Models\SuratKeluar::count() }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection