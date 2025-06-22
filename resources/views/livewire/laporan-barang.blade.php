<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Laporan Barang Aktif per Lokasi</h2>

    <label class="block mb-2">Pilih Lokasi:</label>
    <select wire:model="lokasiDipilih" class="border p-2 w-full mb-4">
        <option value="">-- Semua Lokasi --</option>
        @foreach ($lokasiList as $lokasi)
            <option value="{{ $lokasi->id }}">
                {{ $lokasi->nama_lokasi }} - Total Barang: {{ $lokasi->total_barang ?? 0 }}
            </option>
        @endforeach
    </select>

    @if ($lokasiDipilih && count($barangList))
        <table class="table-auto w-full text-sm mb-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-2 py-1">Nama Barang</th>
                    <th class="px-2 py-1">Kategori</th>
                    <th class="px-2 py-1">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangList as $barang)
                    <tr>
                        <td class="border px-2 py-1">{{ $barang->nama }}</td>
                        <td class="border px-2 py-1">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                        <td class="border px-2 py-1">{{ $barang->jumlah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-right font-semibold">
            Total: {{ $barangList->sum('jumlah') }} barang
        </p>
    @elseif ($lokasiDipilih)
        <p>Tidak ada barang di lokasi ini.</p>
    @endif
</div>
