{{-- ========================================================== --}}
{{-- BAGIAN 1: HEADER JUDUL & GARIS ATAS                        --}}
{{-- ========================================================== --}}
<div class="w-full mb-6">
    <h1 class="text-white text-3xl font-bold leading-relaxed">
        {{ $instansi['name'] }}
    </h1>
    {{-- Garis Putih --}}
    <div class="h-1 w-full border-b border-white mt-4"></div>
</div>

{{-- ========================================================== --}}
{{-- BAGIAN 2: STATISTIK (DITARUH DI ATAS)                      --}}
{{-- ========================================================== --}}
<div class="mb-8 w-full max-w-[500px] mx-auto"> 
    
    {{-- Grid 2 Kotak (Pembimbing & Peserta) --}}
    <div class="grid grid-cols-2 gap-4 mb-3">
        
        {{-- Kotak Pembimbing --}}
        <div class="bg-[#242F4D] border border-[#5B5BD8] rounded-[10px] p-5 flex flex-col justify-center h-[120px] relative overflow-hidden group hover:bg-[#2f3d61] transition-colors duration-300">
            <p class="text-white/60 text-sm font-semibold mb-2 z-10">Pembimbing</p>
            {{-- Data Dinamis --}}
            <p class="text-[#93C5E4] text-[50px] font-bold leading-none z-10">
                {{ $instansi['pembimbing'] }}
            </p>
        </div>
        
        {{-- Kotak Peserta --}}
        <div class="bg-[#294032] border border-[#03A703] rounded-[10px] p-5 flex flex-col justify-center h-[120px] relative overflow-hidden group hover:bg-[#345240] transition-colors duration-300">
            <p class="text-white/60 text-sm font-semibold mb-2 z-10">Peserta</p>
            {{-- Data Dinamis --}}
            <p class="text-[#4EFD68] text-[50px] font-bold leading-none z-10">
                {{ $instansi['peserta'] }}
            </p>
        </div>

    </div>

    {{-- Badge Instansi Aktif --}}
    <div class="w-full bg-[#009639]/60 border border-[#00FF2F] text-[#00FF5F] text-center text-lg font-semibold py-2 rounded-[10px] shadow-lg backdrop-blur-sm">
        Instansi Aktif
    </div>

</div>

{{-- ========================================================== --}}
{{-- BAGIAN 3: INFORMASI KONTAK (MENGGUNAKAN LOOPING)           --}}
{{-- ========================================================== --}}
<div class="space-y-6 mb-8">
    
    {{-- 
       ARRAY KONFIGURASI TAMPILAN
       Kita memetakan: Label apa -> Pakai Ikon apa -> Ambil data yang mana 
    --}}
    @php
        $details = [
            [
                'label' => 'Lokasi', 
                'icon'  => 'Lokasi.svg', 
                'value' => is_array($instansi['lokasi']) 
                        ? implode(', ', $instansi['lokasi']) 
                        : ($instansi['lokasi'] ?? '-')
            ],
            [
                'label' => 'No. Telepon', 
                'icon'  => 'telpbiru.svg', 
                'value' => is_array($instansi['telepon']) 
                        ? implode(', ', $instansi['telepon']) 
                        : ($instansi['telepon'] ?? '-')
            ],
            [
                'label' => 'Jam', 
                'icon'  => 'Jam.svg', 
                'value' => is_array($instansi['jam']) 
                        ? implode(', ', $instansi['jam']) 
                        : ($instansi['jam'] ?? '-')
            ],
            [
                'label' => 'Pendidikan', 
                'icon'  => 'Pendidikan.svg', 
                'value' => is_array($instansi['pendidikan']) 
                        ? implode(', ', $instansi['pendidikan']) 
                        : ($instansi['pendidikan'] ?? '-')
            ],
            [
                'label' => 'Persyaratan Dokumen', 
                'icon'  => 'Dokumen.svg', 
                'value' => is_array($instansi['persyaratan']) 
                        ? implode(', ', $instansi['persyaratan']) 
                        : ($instansi['persyaratan'] ?? '-')
            ],
        ];
    @endphp

    {{-- LOOPING HTML AGAR RAPI --}}
    @foreach($details as $item)
    <div class="flex items-start gap-5">
        {{-- Ikon --}}
        <img src="{{ asset('vector/' . $item['icon']) }}" class="w-8 h-8 flex-shrink-0 mt-1" alt="{{ $item['label'] }}">
        
        {{-- Teks --}}
        <div>
            <p class="text-white/60 text-lg font-semibold mb-1">{{ $item['label'] }}</p>
            <p class="text-white text-xl font-semibold leading-relaxed">
                {{ $item['value'] }}
            </p>
        </div>
    </div>
    @endforeach

</div>

{{-- ========================================================== --}}
{{-- BAGIAN 4: GARIS BAWAH & DESKRIPSI                          --}}
{{-- ========================================================== --}}

<div class="h-px w-full bg-white mb-6 border-b border-white"></div>

<div class="mb-4">
    <p class="text-white/60 text-lg font-semibold mb-2">Deskripsi</p>
    <p class="text-white text-xl font-medium leading-relaxed text-justify">
        {{ $instansi['deskripsi'] }}
    </p>
</div>