<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Mutasi;
use Illuminate\Support\Facades\DB;

class MutasiCrud extends Component
{
    public $barang_id, $asal, $tujuan, $tanggal;

    public function render()
    {
        return view('livewire.mutasi', [
            'barangList' => Barang::with('lokasi')->get(),
            'lokasiList' => Lokasi::all(),
            'riwayat' => Mutasi::with(['barang', 'lokasiAsal', 'lokasiTujuan'])->latest()->get(),
        ]);
    }

    public function mutasi()
    {
        $this->validate([
            'barang_id' => 'required|exists:barang,id',
            'asal' => 'required|exists:lokasis,id',
            'tujuan' => 'required|exists:lokasis,id|different:asal',
            'tanggal' => 'required|date',
        ]);

        DB::transaction(function () {
            Mutasi::create([
                'barang_id' => $this->barang_id,
                'asal' => $this->asal,
                'tujuan' => $this->tujuan,
                'tanggal' => $this->tanggal,
            ]);

            Barang::find($this->barang_id)->update([
                'lokasi_id' => $this->tujuan,
            ]);
        });

        session()->flash('message', 'Mutasi berhasil.');
        $this->reset(['barang_id', 'asal', 'tujuan', 'tanggal']);
    }
}
