<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Migration kosong (placeholder).
     * Tabel users, inventaris_barang, barang_hibah, surat_masuk,
     * surat_keluar, peminjaman_barang SUDAH ADA di database english_club
     * (dibuat manual via SQL) dan TIDAK dibuat ulang oleh Laravel.
     * File ini hanya supaya riwayat migrasi tercatat rapi.
     */
    public function up(): void
    {
        // Sengaja dikosongkan — tabel sudah ada di database.
    }

    public function down(): void
    {
        // Sengaja dikosongkan.
    }
};