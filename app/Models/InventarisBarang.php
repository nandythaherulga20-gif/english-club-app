<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisBarang extends Model
{
    use HasFactory;

    protected $table = 'inventaris_barang';

    protected $fillable = [
        'no_urut',
        'kategori',
        'nama_barang',
        'jumlah',
        'satuan',
        'kondisi_baik',
        'kondisi_rusak',
        'created_by',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanBarang::class, 'inventaris_id');
    }
}