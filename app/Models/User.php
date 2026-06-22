<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ----- Helper role -----
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    // ----- Relasi -----
    public function inventarisDibuat()
    {
        return $this->hasMany(InventarisBarang::class, 'created_by');
    }

    public function barangHibahDibuat()
    {
        return $this->hasMany(BarangHibah::class, 'created_by');
    }

    public function suratMasukDibuat()
    {
        return $this->hasMany(SuratMasuk::class, 'created_by');
    }

    public function suratKeluarDibuat()
    {
        return $this->hasMany(SuratKeluar::class, 'created_by');
    }

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanBarang::class, 'peminjam_id');
    }

    public function peminjamanDisetujui()
    {
        return $this->hasMany(PeminjamanBarang::class, 'approved_by');
    }
}