<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lokasi;

class LokasiCrud extends Component
{
    public $nama_lokasi, $gedung, $lokasi_id;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.lokasi-crud', [
            'lokasiList' => Lokasi::all(),
        ]);
    }

    public function resetForm()
    {
        $this->nama_lokasi = '';
        $this->gedung = '';
        $this->lokasi_id = null;
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate([
            'nama_lokasi' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
        ]);

        Lokasi::create([
            'nama_lokasi' => $this->nama_lokasi,
            'gedung' => $this->gedung,
        ]);

        session()->flash('message', 'Data lokasi berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $this->lokasi_id = $lokasi->id;
        $this->nama_lokasi = $lokasi->nama_lokasi;
        $this->gedung = $lokasi->gedung;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama_lokasi' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
        ]);

        $lokasi = Lokasi::findOrFail($this->lokasi_id);
        $lokasi->update([
            'nama_lokasi' => $this->nama_lokasi,
            'gedung' => $this->gedung,
        ]);

        session()->flash('message', 'Data lokasi berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Lokasi::findOrFail($id)->delete();
        session()->flash('message', 'Data lokasi berhasil dihapus.');
    }
}
