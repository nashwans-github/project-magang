<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    {{-- KARTU 1: JUMLAH PESERTA --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] h-[150px] px-6 py-4 rounded-sm shadow-lg flex justify-between items-center relative overflow-hidden group hover:bg-[#2a2a2e] transition-all">
        <div class="z-10 flex flex-col justify-center">
            <h3 class="text-[#0554F2] text-xl font-bold mb-4 tracking-wide -mt-4">Jumlah Peserta</h3>
            {{-- Data dari peserta.php --}}
            <p class="text-[#0554F2] text-[43px] font-bold leading-none">
                {{ $stats['jumlah_peserta'] }}
            </p>
        </div>
        <div class="w-[70px] h-[70px] rounded-full bg-[#1E3A8A] flex items-center justify-center">
            <img src="{{ asset('vector/JumlahPeserta.svg') }}" alt="Peserta" class="w-10 h-10">
        </div>
    </div>

    {{-- KARTU 2: PERMOHONAN MAGANG (3 Badge Status) --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] h-[150px] px-6 py-4 rounded-sm shadow-lg flex justify-between items-center relative overflow-hidden">
        <div class="z-10 w-full">
            <h3 class="text-[#0554F2] text-xl font-bold mb-4 tracking-wide -mt-4">Permohonan Magang</h3>
            <div class="flex items-center gap-3">
                {{-- Menunggu --}}
                <div class="relative flex items-center justify-center px-2 py-1 w-[70px] h-[45px] rounded-[10px] border border-[#FBCD35] bg-[#A07A00]/60">
                    <img src="{{ asset('vector/Menunggu.svg') }}" class="w-6 h-6 absolute top-0.5 left-0.5">
                    <span class="text-[#FBCD35] font-bold text-2xl ml-10">{{ $stats['permohonan']['menunggu'] }}</span>
                </div>
                {{-- Diterima --}}
                <div class="relative flex items-center justify-between px-2 py-1 w-[70px] h-[45px] rounded-[10px] border border-[#00FF5F] bg-[#009639]/45">
                    <img src="{{ asset('vector/Diterima.svg') }}" class="w-6 h-6 absolute top-0.5 left-0.5">
                    <span class="text-[#00FF5F] font-bold text-2xl ml-10">{{ $stats['permohonan']['diterima'] }}</span>
                </div>
                {{-- Ditolak --}}
                <div class="relative flex items-center justify-between px-2 py-1 w-[70px] h-[45px] rounded-[10px] border border-[#FF0000] bg-[#B20000]/45">
                    <img src="{{ asset('vector/Ditolak.svg') }}" class="w-6 h-6 absolute top-0.5 left-0.5">
                    <span class="text-[#FF0000] font-bold text-2xl ml-10">{{ $stats['permohonan']['ditolak'] }}</span>
                </div>
            </div>
        </div>
        <div class="w-[70px] h-[70px] rounded-full bg-[#9A3F00] flex items-center justify-center shrink-0">
            <img src="{{ asset('vector/PermohonanMagang.svg') }}" class="w-9 h-9 ml-1">
        </div>
    </div>

    {{-- KARTU 3: JUMLAH PEMBIMBING --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] h-[150px] px-6 py-4 rounded-sm shadow-lg flex justify-between items-center relative overflow-hidden group hover:bg-[#2a2a2e] transition-all">
        <div class="z-10 flex flex-col justify-center">
            <h3 class="text-[#0554F2] text-xl font-bold mb-4 tracking-wide -mt-4">Jumlah Pembimbing</h3>
            <p class="text-[#0554F2] text-[43px] font-bold leading-none">
                {{ $stats['jumlah_pembimbing'] }}
            </p>
        </div>
        <div class="w-[70px] h-[70px] rounded-full bg-[#800000] flex items-center justify-center">
            <img src="{{ asset('vector/JumlahPembimbing.svg') }}" class="w-11 h-11 mb-3">
        </div>
    </div>

    {{-- KARTU 4: SURAT MAGANG (LIST) --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] h-[150px] px-6 py-4 rounded-sm shadow-lg flex justify-between items-center relative overflow-hidden group hover:bg-[#2a2a2e] transition-all">
        <div class="z-10 w-full">
            <h3 class="text-[#0554F2] text-xl font-bold mb-4 tracking-wide -mt-4">Permintaan Surat Magang</h3>
            <div class="flex flex-col gap-1 text-gray-400 font-medium text-[15px]">
                <div class="flex items-center">
                    <span class="w-[180px]">Surat Diterima Magang</span>
                    <span class="text-white">: {{ $stats['surat']['diterima'] }}</span>
                </div>
                <div class="flex items-center">
                    <span class="w-[180px]">Surat Selesai Magang</span>
                    <span class="text-white">: {{ $stats['surat']['selesai'] }}</span>
                </div>
            </div>
        </div>
        <div class="w-[70px] h-[70px] rounded-full bg-[#1D5933] flex items-center justify-center shrink-0">
            <img src="{{ asset('vector/PermintaanSurat.svg') }}" class="w-10 h-10">
        </div>
    </div>

</div>