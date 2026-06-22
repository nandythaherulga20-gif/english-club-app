<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangHibah extends Model
{
    use HasFactory;

    protected $table = 'barang_hibah';

    protected $fillable = [
        'no_urut',
        'nama_barang',
        'jumlah',
        'satuan',
        'created_by',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}