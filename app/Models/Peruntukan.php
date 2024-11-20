<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peruntukan extends Model
{
    use HasFactory;

    protected $table = 'peruntukan';
    protected $fillable = ['uuid', 'peruntukan'];

    public function peminjaman(): HasOne
    {
        return $this->hasOne(Peminjaman::class);
    }
}
