<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Penghapusan;

class PenghapusanCrud extends Component
{
    public $barang_id, $alasan, $tanggal;

    public function render()
    {
        return view('livewire.penghapusan', [
            'barangList' => Barang::with('lokasi')->get(),
            'hapusList' => Penghapusan::with('barang')->latest()->get(),
        ]);
    }

    public function hapus()
    {
        $this->validate([
            'barang_id' => 'required|exists:barang,id',
            'alasan' => 'required|string|min:5',
            'tanggal' => 'required|date',
        ]);

        $barang = Barang::findOrFail($this->barang_id);

        // Cek validasi: tidak bisa hapus jika sedang dimutasi
        if ($barang->sedangDimutasi()) {
            session()->flash('message', 'Barang sedang dalam proses mutasi dan tidak bisa dihapus.');
            return;
        }

        Penghapusan::create([
            'barang_id' => $this->barang_id,
            'alasan' => $this->alasan,
            'tanggal' => $this->tanggal,
        ]);

        // Hapus dari tabel barang
        $barang->delete();

        session()->flash('message', 'Barang berhasil dihapus dengan alasan.');
        $this->reset(['barang_id', 'alasan', 'tanggal']);
    }
}
