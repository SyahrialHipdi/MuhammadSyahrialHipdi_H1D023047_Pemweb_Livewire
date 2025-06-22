<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';
    protected $fillable = ['barang_id', 'asal', 'tujuan', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function lokasiAsal()
    {
        return $this->belongsTo(Lokasi::class, 'asal');
    }

    public function lokasiTujuan()
    {
        return $this->belongsTo(Lokasi::class, 'tujuan');
    }
}
