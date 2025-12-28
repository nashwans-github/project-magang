<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="text-base uppercase text-white border-b border-white">
            <tr>
                <th class="py-4 pr-4 text-center font-medium tracking-wider w-[25%]">NAMA</th>
                <th class="py-4 px-2 text-center font-medium tracking-wider w-[35%]">BIDANG</th>
                <th class="py-4 px-2 text-center font-medium tracking-wider w-[25%]">EMAIL</th>
                <th class="py-4 px-2 text-center font-medium tracking-wider w-[20%]">AKSI</th>
            </tr>
        </thead>
        
        <tbody id="tableBody" class="divide-y divide-white text-white">
            @forelse($pembimbings as $p)
            <tr class="data-row">
                <td class="py-5 pr-4 text-center font-regular">{{ $p['nama'] }}</td>
                <td class="py-5 px-2 text-center font-regular">{{ $p['bidang'] }}</td>
                <td class="py-5 px-2 text-center font-regular">{{ $p['email'] }}</td>
                <td class="py-5 px-2 align-middle text-center">
                {{-- Container Flex ini hanya untuk memastikan tombol & form ada di tengah secara horizontal --}}
                <div class="inline-flex justify-center items-center">
                    <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembimbing ini?');">
                        @csrf {{-- Jangan lupa @csrf jika nanti sudah masuk ke backend Laravel --}}
                        @method('DELETE') {{-- Tambahkan ini juga untuk best practice delete --}}
                        
                        <button type="submit" class="bg-[#C01212] border border-white text-white p-1 transition shadow-sm flex items-center justify-center hover:bg-red-700">
                            <img src="{{ asset('vector/Hapus Akun.svg') }}" alt="Hapus" class="w-4 h-4 object-contain">                    
                        </button>
                    </form>
                </div>
            </td>
            </tr>
            @empty
            {{-- Jika data kosong dari controller --}}
            <tr>
                <td colspan="4" class="text-center py-10 text-lg font-light italic">
                    Belum ada data pembimbing.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pesan Data Kosong (Untuk Hasil Search JS) --}}
    <div id="noDataMessage" class="hidden text-center text-white py-10 text-lg font-light italic">
        Nama tidak ditemukan.
    </div>
</div>