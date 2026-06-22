<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'no_urut',
        'tanggal_keluar',
        'nomor_surat',
        'tanggal_surat',
        'kegiatan_teks',
        'tanggal_kegiatan_mulai',
        'tanggal_kegiatan_selesai',
        'perihal',
        'acara',
        'instansi_penerima',
        'keterangan',
        'created_by',
    ];

    protected $casts = [
        'tanggal_keluar' => 'date',
        'tanggal_surat' => 'date',
        'tanggal_kegiatan_mulai' => 'date',
        'tanggal_kegiatan_selesai' => 'date',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}