<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;

class BarangCrud extends Component
{
    public $nama, $kode_barang, $kategori_id, $lokasi_id, $jumlah, $barang_id;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.barang-crud', [
            'barangList' => Barang::with(['kategori', 'lokasi'])->get(),
            'kategoriList' => Kategori::all(),
            'lokasiList' => Lokasi::all(),
        ]);
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->kode_barang = '';
        $this->kategori_id = '';
        $this->lokasi_id = '';
        $this->jumlah = '';
        $this->barang_id = null;
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:barang,kode_barang',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        Barang::create([
            'nama' => $this->nama,
            'kode_barang' => $this->kode_barang,
            'kategori_id' => $this->kategori_id,
            'lokasi_id' => $this->lokasi_id,
            'jumlah' => $this->jumlah,
        ]);

        session()->flash('message', 'Barang berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $this->barang_id = $barang->id;
        $this->nama = $barang->nama;
        $this->kode_barang = $barang->kode_barang;
        $this->kategori_id = $barang->kategori_id;
        $this->lokasi_id = $barang->lokasi_id;
        $this->jumlah = $barang->jumlah;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:barang,kode_barang,' . $this->barang_id,
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($this->barang_id);
        $barang->update([
            'nama' => $this->nama,
            'kode_barang' => $this->kode_barang,
            'kategori_id' => $this->kategori_id,
            'lokasi_id' => $this->lokasi_id,
            'jumlah' => $this->jumlah,
        ]);

        session()->flash('message', 'Barang berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Barang::findOrFail($id)->delete();
        session()->flash('message', 'Barang berhasil dihapus.');
    }
}
