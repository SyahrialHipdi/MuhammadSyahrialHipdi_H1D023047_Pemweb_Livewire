<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Lokasi;
use Illuminate\Support\Facades\DB;

class LaporanBarang extends Component
{
    public $lokasiDipilih = null;

    public function render()
    {
        $lokasiList = Lokasi::withCount(['barang as total_barang' => function ($query) {
            $query->select(DB::raw("SUM(jumlah)"));
        }])->get();

        $barangList = [];
        if ($this->lokasiDipilih) {
            $barangList = Barang::with('kategori')
                ->where('lokasi_id', $this->lokasiDipilih)
                ->get();
        }

        return view('livewire.laporan-barang', [
            'lokasiList' => $lokasiList,
            'barangList' => $barangList,
        ]);
    }
}
