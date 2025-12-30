<table id="pesertaTable" class="w-full text-left border-collapse">
    <thead>
        <tr>
            <th class="py-4 text-white font-semibold uppercase text-base tracking-wider border-b border-white w-[30%] text-center">Nama</th>
            <th class="py-4 text-white font-semibold uppercase text-base tracking-wider border-b border-white w-[20%] text-center">Bidang</th>
            <th class="py-4 text-white font-semibold uppercase text-base tracking-wider border-b border-white w-[25%] text-center">Tanggal Mulai</th>
            <th class="py-4 text-white font-semibold uppercase text-base tracking-wider border-b border-white w-[25%] text-center">Tanggal Selesai</th>
        </tr>
    </thead>

    <tbody class="text-white text-base">
        @forelse($peserta as $p)
        <tr class="group border-b border-white transition-all duration-300 hover:bg-[#333] hover:scale-[1.01] hover:shadow-xl cursor-pointer relative hover:z-10">
            <td class="py-6 border-b border-white font-medium text-center">
                {{-- Ganti ke route show yang benar --}}
                <a href="{{ route('opd.peserta.show', $p['id']) }}" class="relative z-20 block w-full h-full">
                    {{ $p['nama'] }}
                </a>
            </td>
            <td class="py-6 border-b border-white text-center text-white/60">{{ $p['bidang'] }}</td>
            <td class="py-6 border-b border-white text-center text-white/60">{{ $p['tgl_mulai'] }}</td>
            <td class="py-6 border-b border-white text-center text-white/60">{{ $p['tgl_selesai'] }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-10 text-lg font-light italic text-gray-400">
                Belum ada data peserta.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>