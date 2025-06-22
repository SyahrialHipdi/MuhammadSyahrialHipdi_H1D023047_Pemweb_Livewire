<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Manajemen Kategori</h2>

    @if (session()->has('message'))
        <div class="mb-2 text-green-600">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
        <input type="text" wire:model="nama_kategori" placeholder="Nama Kategori" class="border p-2 w-full mb-2">

        <button type="submit" class="bg-blue-600 px-4 py-2">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>

        @if ($isEdit)
            <button type="button" wire:click="resetForm" class="ml-2 bg-gray-400  px-4 py-2">Batal</button>
        @endif
    </form>

    <hr class="my-4">

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nama Kategori</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoriList as $kategori)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $kategori->nama_kategori }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $kategori->id }})" class="bg-yellow-400 px-2 py-1 text-black">Edit</button>
                        <button wire:click="delete({{ $kategori->id }})" class="bg-red-600 px-2 py-1 ml-1">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
