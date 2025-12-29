<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    {{-- CARD 1: JUMLAH PESERTA --}}
    <div class="bg-[#262626] p-6 rounded-sm border-l-4 border-[#0554F2] shadow-lg flex justify-between items-center relative overflow-hidden transition-all duration-300 hover:scale-105 hover:bg-[#333] hover:shadow-xl group">
        <div class="z-10">
            <h3 class="text-[#FFFFFF]/50 text-base font-semibold mb-2 transition-colors group-hover:text-white">Jumlah Peserta</h3>
            <p class="text-[#0066FF] text-5xl font-bold transition-transform duration-300 origin-left group-hover:scale-110">
                {{ $totalPeserta ?? 0 }}
            </p>
        </div>
        <div class="w-16 h-16 rounded-full bg-[#1E3A8A]/80 flex items-center justify-center">
            {{-- Pastikan path icon sudah benar --}}
            <img src="{{ asset('vector/icons_stats/pembimbing-jumlah_peserta.svg') }}" alt="Icon Peserta" class="w-8 h-8">
        </div>
    </div>

    {{-- CARD 2: PERMINTAAN SURAT --}}
    <div class="bg-[#262626] p-6 rounded-sm border-l-4 border-[#40C057] shadow-lg flex justify-between items-center relative overflow-hidden transition-all duration-300 hover:scale-105 hover:bg-[#333] hover:shadow-xl group">
        <div>
            <h3 class="text-[#FFFFFF]/50 text-base font-semibold mb-2 transition-colors group-hover:text-white">Permintaan Surat</h3>
            <p class="text-[#0066FF] text-5xl font-bold transition-transform duration-300 origin-left group-hover:scale-110">
                {{ $totalSurat ?? 0 }}
            </p>
        </div>
        <div class="w-16 h-16 rounded-full bg-[#1D5933]/80 flex items-center justify-center">
            <img src="{{ asset('vector/icons_stats/pembimbing-jumlah_penilaian.svg') }}" alt="Icon Surat" class="w-8 h-8">
        </div>
    </div>

    {{-- CARD 3: PESERTA HADIR HARI INI --}}
    <div class="bg-[#262626] p-6 rounded-sm border-l-4 border-[#F89550] shadow-lg flex justify-between items-center relative overflow-hidden transition-all duration-300 hover:scale-105 hover:bg-[#333] hover:shadow-xl group">
        <div>
            <h3 class="text-[#FFFFFF]/50 text-base font-semibold mb-2 transition-colors group-hover:text-white">Peserta Hadir Hari Ini</h3>
            <p class="text-[#0066FF] text-5xl font-bold transition-transform duration-300 origin-left group-hover:scale-110">
                {{ $totalHadir ?? 0 }}
            </p>
        </div>
        <div class="w-16 h-16 rounded-full bg-[#9A3F00]/80 flex items-center justify-center">
            <img src="{{ asset('vector/icons_stats/pembimbing-peserta_aktivJOSJIS.svg') }}" alt="Icon Hadir" class="w-8 h-8">
        </div>
    </div>

    {{-- CARD 4: PROGRES PERLU DITINJAU --}}
    <div class="bg-[#262626] p-6 rounded-sm border-l-4 border-[#FA5252] shadow-lg flex justify-between items-center relative overflow-hidden transition-all duration-300 hover:scale-105 hover:bg-[#333] hover:shadow-xl group">
        <div>
            <h3 class="text-[#FFFFFF]/50 text-base font-semibold mb-2 transition-colors group-hover:text-white">Progres Perlu Ditinjau</h3>
            <p class="text-[#0066FF] text-5xl font-bold transition-transform duration-300 origin-left group-hover:scale-110">
                {{ $totalProgres ?? 0 }}
            </p>
        </div>
        <div class="w-16 h-16 rounded-full bg-[#800000]/80 flex items-center justify-center">
            <img src="{{ asset('vector/icons_stats/pembimbing-progres.svg') }}" alt="Icon Laporan" class="w-8 h-8">
        </div>
    </div>

</div>