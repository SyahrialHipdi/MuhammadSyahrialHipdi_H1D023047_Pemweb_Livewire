<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Lokasi extends Model
{
    //
     protected $table = 'lokasis';

    protected $fillable = ['nama_lokasi', 'gedung'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
