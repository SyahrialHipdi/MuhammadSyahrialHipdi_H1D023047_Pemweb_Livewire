<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kategori;

class KategoriCrud extends Component
{
    public $nama_kategori, $kategori_id;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.kategori-crud', [
            'kategoriList' => Kategori::all(),
        ]);
    }

    public function resetForm()
    {
        $this->nama_kategori = '';
        $this->kategori_id = null;
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $this->nama_kategori,
        ]);

        session()->flash('message', 'Data lokasi berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->kategori_id = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($this->kategori_id);
        $kategori->update([
            'nama_kategori' => $this->nama_kategori,
        ]);

        session()->flash('message', 'Data Kategori berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Kategori::findOrFail($id)->delete();
        session()->flash('message', 'Data lokasi berhasil dihapus.');
    }
}
