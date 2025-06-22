<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Barang;

class Kategori extends Model
{
    //
     protected $table = 'kategoris';

    protected $fillable = ['nama_kategori'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
