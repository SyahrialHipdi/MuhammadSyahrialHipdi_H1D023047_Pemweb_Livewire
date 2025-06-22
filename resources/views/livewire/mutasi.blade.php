<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Mutasi Barang Antar Lokasi</h2>

    @if (session()->has('message'))
        <div class="text-green-600">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="mutasi" class="space-y-2 mb-6">
        <select wire:model="barang_id" class="w-full border p-2">
            <option value="">Pilih Barang</option>
            @foreach ($barangList as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama }} - ({{ $barang->lokasi->nama_lokasi ?? 'Unknown' }})</option>
            @endforeach
        </select>

        <select wire:model="asal" class="w-full border p-2">
            <option value="">Asal Lokasi</option>
            @foreach ($lokasiList as $lokasi)
                <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
            @endforeach
        </select>

        <select wire:model="tujuan" class="w-full border p-2">
            <option value="">Tujuan Lokasi</option>
            @foreach ($lokasiList as $lokasi)
                <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
            @endforeach
        </select>

        <input type="date" wire:model="tanggal" class="w-full border p-2" />

        <button class="bg-blue-600 px-4 py-2">Mutasi</button>
    </form>

    <h3 class="font-semibold mb-2">Riwayat Mutasi</h3>
    <table class="table-auto w-full text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-2 py-1">Tanggal</th>
                <th class="px-2 py-1">Barang</th>
                <th class="px-2 py-1">Asal</th>
                <th class="px-2 py-1">Tujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayat as $m)
                <tr>
                    <td class="border px-2 py-1">{{ $m->tanggal }}</td>
                    <td class="border px-2 py-1">{{ $m->barang->nama }}</td>
                    <td class="border px-2 py-1">{{ $m->lokasiAsal->nama_lokasi }}</td>
                    <td class="border px-2 py-1">{{ $m->lokasiTujuan->nama_lokasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
