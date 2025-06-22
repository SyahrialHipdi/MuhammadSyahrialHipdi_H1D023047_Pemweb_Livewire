<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Manajemen Barang</h2>

    @if (session()->has('message'))
        <div class="mb-2 text-green-600">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
        <input type="text" wire:model="nama" placeholder="Nama Barang" class="border p-2 w-full mb-2">
        <input type="text" wire:model="kode_barang" placeholder="Kode Barang" class="border p-2 w-full mb-2">

        <select wire:model="kategori_id" class="border p-2 w-full mb-2">
            <option value="">Pilih Kategori</option>
            @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>

        <select wire:model="lokasi_id" class="border p-2 w-full mb-2">
            <option value="">Pilih Lokasi</option>
            @foreach ($lokasiList as $lokasi)
                <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
            @endforeach
        </select>

        <input type="number" wire:model="jumlah" placeholder="Jumlah" class="border p-2 w-full mb-2">

        <button type="submit" class="bg-blue-600 px-4 py-2">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>

        @if ($isEdit)
            <button type="button" wire:click="resetForm" class="ml-2 bg-gray-400 px-4 py-2">Batal</button>
        @endif
    </form>

    <hr class="my-4">

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Kode</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Lokasi</th>
                <th class="px-4 py-2">Jumlah</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangList as $barang)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $barang->nama }}</td>
                    <td class="border px-4 py-2">{{ $barang->kode_barang }}</td>
                    <td class="border px-4 py-2">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $barang->lokasi->nama_lokasi ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $barang->jumlah }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $barang->id }})" class="bg-yellow-400 px-2 py-1">Edit</button>
                        <button wire:click="delete({{ $barang->id }})" class="bg-red-600 px-2 py-1 ml-1">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
