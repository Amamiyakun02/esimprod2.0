<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengembalian extends Model
{
    use HasFactory;

    protected $table = 'detail_pengembalian';
    protected $fillable = [
        'uuid',
        'kode_detail_pengembalian',
        'kode_pengembalian',
        'kode_barang',
        'status',
        'deskripsi',
    ];
}
