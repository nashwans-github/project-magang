@extends('layout.admin-layout')

{{-- Mengambil Nama Instansi dengan aman (bisa 'nama' atau 'name' tergantung dummy data) --}}
@section('title', 'Detail OPD - ' . ($opd['nama'] ?? $opd['name']))
@section('header-title', 'Detail OPD')

@section('content')

{{-- CONTAINER 1: Judul Hlaman --}}
<div class="bg-[#232226] border-[3px] border-[#011640] p-6 shadow-2xl rounded-sm mb-8">
    <h2 class="text-[#0066FF] text-3xl font-bold tracking-wide">
        Manajemen OPD
    </h2>
</div>

{{-- CONTAINER 2: Informasi Dinas --}}
<div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-2xl rounded-sm mb-8">
    
    {{-- Background Gradient (Agar senada dengan Index) --}}
    <div class="relative z-10">
        
        {{-- HEADER: NAMA & TOMBOL AKSI --}}
        <div class="flex flex-col md:flex-row justify-between items-start mb-6">
            <div>
                <h1 class="text-white text-2xl font-semibold leading-tight mb-1">
                    {{ $opd['nama'] ?? $opd['name'] }}
                </h1>
                <div class="flex items-center gap-2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span class="text-base font-medium">{{ $opd['email'] ?? 'email@instansi.go.id' }}</span>
                </div>
            </div>
            
            {{-- Tombol Nonaktifkan (Warna Orange/Merah) --}}
            <button onclick="alert('Fitur Nonaktifkan (Simulasi)')" 
                    class="mt-4 md:mt-0 bg-[#FF8000] hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-bold text-sm transition shadow-lg">
                Nonaktifkan
            </button>
        </div>

        {{-- Divider --}}
        <hr class="border-white/20 mb-8">

        {{-- AREA TENGAH: STATISTIK --}}
        <div class="flex justify-center mb-10">
            <div class="w-full max-w-[500px]">
                
                {{-- Grid Statistik --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    {{-- Box Pembimbing --}}
                    <div class="bg-[#242F4D] border border-[#5B5BD8] rounded-lg p-5 flex flex-col justify-center items-start h-[120px] relative overflow-hidden">
                        <p class="text-white/60 text-sm font-semibold mb-2 z-10">Pembimbing</p>
                        <p class="text-[#93C5E4] text-5xl font-bold leading-none z-10">{{ $jumlahPembimbing }}</p>
                    </div>
                    
                    {{-- Box Peserta --}}
                    <div class="bg-[#294032] border border-[#03A703] rounded-lg p-5 flex flex-col justify-center items-start h-[120px] relative overflow-hidden">
                        <p class="text-white/60 text-sm font-semibold mb-2 z-10">Peserta</p>
                        <p class="text-[#4EFD68] text-5xl font-bold leading-none z-10">{{ $jumlahPeserta }}</p>
                    </div>
                </div>

                {{-- Badge Status --}}
                @php $isActive = true; @endphp 
                @if($isActive)
                    <div class="w-full bg-[#009639]/60 border border-[#00FF2F] py-3 rounded-lg flex items-center justify-center shadow-lg">
                        <span class="text-[#00FF5F] text-lg font-bold tracking-wide">AKTIF</span>
                    </div>
                @else
                    <div class="w-full bg-red-900/60 border border-red-500 py-3 rounded-lg flex items-center justify-center shadow-lg">
                        <span class="text-red-400 text-lg font-bold tracking-wide">NONAKTIF</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- AREA BAWAH: DETAIL DATA --}}
        <div class="space-y-6 text-white">
            
            {{-- Lokasi --}}
            <div class="flex gap-5">
                <div class="w-8 flex-shrink-0 flex justify-center mt-1">
                    {{-- Icon Map --}}
                    <img src="{{ asset('images/icons/IKON-lokasi.svg') }}" class="w-6 h-6" alt="Lokasi">
                </div>
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Lokasi</p>
                    <p class="text-lg font-medium leading-relaxed">{{ $opd['lokasi'] }}</p>
               </div>
            </div>

            {{-- Telepon --}}
            <div class="flex gap-5">
                <div class="w-8 flex-shrink-0 flex justify-center mt-1">
                    {{-- Icon Phone --}}
                    <img src="{{ asset('images/icons/IKON-notelp.svg') }}" class="w-6 h-6" alt="Phone">
                </div>
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">No. Telepon</p>
                    <p class="text-lg font-medium">{{ $opd['telepon'] }}</p>
                </div>
            </div>

            {{-- Jam Operasional --}}
            <div class="flex gap-5">
                <div class="w-8 flex-shrink-0 flex justify-center mt-1">
                    <img src="{{ asset('images/icons/IKON-jam_operasional.svg') }}" class="w-6 h-6" alt="Clock">
                </div>
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Jam Operasional</p>
                    <p class="text-lg font-medium">{{ $opd['jam'] }}</p>
                </div>
            </div>

            {{-- Persyaratan --}}
            <div class="flex gap-5">
                <div class="w-8 flex-shrink-0 flex justify-center mt-1">
                     <img src="{{ asset('images/icons/IKON-pendidikan.svg') }}" class="w-6 h-6" alt="Edu">
                </div>
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Pendidikan</p>
                    <p class="text-lg font-medium">
                        {{ is_array($opd['persyaratan'] ?? []) ? implode(', ', $opd['persyaratan']) : ($opd['persyaratan'] ?? '-') }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Divideer --}}
        <hr class="border-white/70 my-8">

        {{-- Deskripsi --}}
        <div class="mt-8">
            <p class="text-white/60 text-lg font-semibold mb-3">Deskripsi</p>
            <div class="bg-[#333]/30 p-5 rounded-lg border-l-4 border-[#0066FF]">
                <p class="text-white/90 text-base leading-relaxed text-justify">
                    {{ $opd['deskripsi'] ?? 'Tidak ada deskripsi.' }}
                </p>
            </div>
        </div>

    </div>

</div>

{{-- CONTAINER 3: Dokumentasi --}}
<div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-2xl rounded-sm mb-8">
    <h3 class="text-white/60 text-lg font-semibold mb-6 border-b border-white/10 pb-2">Dokumentasi</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @if(isset($opd['gallery']) && count($opd['gallery']) > 0)
            @foreach($opd['gallery'] as $img)
                <div class="w-full aspect-[4/3] rounded-lg overflow-hidden border border-gray-700 group hover:border-[#0066FF] transition-colors">
                    <img src="{{ asset($img) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Dokumentasi">
                </div>
            @endforeach
        @else
            <div class="col-span-3 text-center py-12 text-gray-500 italic bg-[#333]/30 rounded-lg border border-dashed border-gray-600">
                <svg class="w-12 h-12 text-gray-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="text-gray-400">Belum ada foto dokumentasi.</p>
            </div>
        @endif
    </div>
</div>

{{-- CONTAINER 4: Badang Tersedia --}}
<div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-2xl rounded-sm">
    <h3 class="text-white/60 text-lg font-semibold mb-8 border-b border-white/10 pb-2">Bidang</h3>
    
    <div class="flex flex-wrap justify-center gap-x-12 gap-y-10 max-w-6xl mx-auto">
        
        @if(isset($opd['bidang']) && count($opd['bidang']) > 0)
            @foreach($opd['bidang'] as $bidang)
                <div class="flex flex-col items-center w-[100px] group cursor-default">
                    
                    {{-- Icon Wrapper --}}
                    <div class="relative w-[64px] h-[64px] flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 rounded-[20px] rotate-[10deg] shadow-lg opacity-90 group-hover:rotate-[0deg] transition-all"
                             style="background: linear-gradient(to bottom right, {{ $bidang['gradient_start'] ?? '#333' }}, {{ $bidang['gradient_end'] ?? '#000' }});">
                        </div>
                        {{-- Icon Image --}}
                        <img src="{{ asset('images/icons/' . ($bidang['icon'] ?? 'default.svg')) }}" 
                             class="relative z-10 w-9 h-9 drop-shadow-md object-contain" 
                             alt="{{ $bidang['name'] ?? 'Bidang' }}">
                    </div>
                    
                    {{-- Nama Bidang --}}
                    <span class="mt-4 text-white text-sm font-medium text-center leading-tight group-hover:text-[#0066FF] transition-colors">
                        {{ $bidang['name'] ?? 'Nama Bidang' }}
                    </span>
                </div>
            @endforeach
        @else
             <div class="text-center py-8 w-full bg-[#333]/30 rounded-xl border border-dashed border-gray-600">
                <p class="text-gray-400">Tidak ada data bidang.</p>
            </div>
        @endif

    </div>
</div>

@endsection