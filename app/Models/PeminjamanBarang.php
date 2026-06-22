<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_barang';

    protected $fillable = [
        'inventaris_id',
        'peminjam_id',
        'jumlah_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'keterangan',
        'approved_by',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function inventaris()
    {
        return $this->belongsTo(InventarisBarang::class, 'inventaris_id');
    }

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}