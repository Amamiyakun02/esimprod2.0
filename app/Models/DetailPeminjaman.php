<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'uuid',
        'kode_detail_peminjaman',
        'kode_peminjaman',
        'kode_barang',
    ];

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class, '', 'kode_jenis_barang');
    }
}
