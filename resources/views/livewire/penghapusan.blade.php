<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Penghapusan Barang Rusak</h2>

    @if (session()->has('message'))
        <div class="text-red-600">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="hapus" class="space-y-2 mb-6">
        <select wire:model="barang_id" class="w-full border p-2">
            <option value="">Pilih Barang</option>
            @foreach ($barangList as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama }} - ({{ $barang->lokasi->nama_lokasi ?? 'Unknown' }})</option>
            @endforeach
        </select>

        <textarea wire:model="alasan" placeholder="Alasan Penghapusan" class="w-full border p-2"></textarea>
        <input type="date" wire:model="tanggal" class="w-full border p-2">

        <button class="bg-red-600 text-white px-4 py-2">Hapus Barang</button>
    </form>

    <h3 class="font-semibold mb-2">Riwayat Penghapusan</h3>
    <table class="table-auto w-full text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-2 py-1">Tanggal</th>
                <th class="px-2 py-1">Barang</th>
                <th class="px-2 py-1">Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hapusList as $h)
                <tr>
                    <td class="border px-2 py-1">{{ $h->tanggal }}</td>
                    <td class="border px-2 py-1">{{ $h->barang->nama ?? '—' }}</td>
                    <td class="border px-2 py-1">{{ $h->alasan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
