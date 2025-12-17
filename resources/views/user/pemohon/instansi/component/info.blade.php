{{-- ===================== INFORMASI LENGKAP ===================== --}}
@php
$alamat = $instansi['lokasi'] ?? ($instansi['alamat'] ?? null);
$telepon = $instansi['telepon'] ?? ($instansi['kontak'] ?? null);
$jam = $instansi['jam'] ?? null;
$pendidikan = $instansi['pendidikan'] ?? ($instansi['education'] ?? []);
$persyaratan = $instansi['persyaratan'] ?? ($instansi['requirements'] ?? []);
@endphp

<div class="w-full max-w-7xl mx-auto px-6 flex flex-col items-end">

    {{-- CARD INFORMASI --}}
    <div class="relative bg-[#0a0a0a] border border-yellow-600/30 shadow-[0_4px_80px_0_#FBCD35]
        rounded-[20px] 
        w-full lg:w-[750px] 
        translate-x-6
        py-10 pr-8 
        pl-10 md:pl-16
        flex flex-col
        mb-6 mt-16">

        <h3 class="text-[#0554F2] text-2xl font-bold mb-10 pl-2">Informasi Lengkap</h3>

        <div class="flex flex-col justify-start space-y-10 text-white">

            {{-- Lokasi --}}
            @if($alamat)
            <div class="flex items-start gap-5">
                <div class="mt-1 w-8 shrink-0 flex justify-center">
                    <img src="{{ asset('vector/lokbiru.svg') }}" class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h4 class="font-semibold text-white text-2xl">Lokasi</h4>
                    <p class="text-white text-[20px] mt-1 leading-relaxed max-w-[450px]">
                        {{ $alamat }}
                    </p>
                </div>
            </div>
            @endif

            {{-- Telepon --}}
            @if($telepon)
            <div class="flex items-start gap-5">
                <div class="mt-1 w-8 shrink-0 flex justify-center">
                    <img src="{{ asset('vector/telpbiru.svg') }}" class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h4 class="font-semibold text-white text-2xl">No. Telepon</h4>
                    <p class="text-white text-[20px] mt-1">{{ $telepon }}</p>
                </div>
            </div>
            @endif

            {{-- Jam --}}
            @if($jam)
            <div class="flex items-start gap-5">
                <div class="mt-1 w-8 shrink-0 flex justify-center">
                    <img src="{{ asset('vector/jambiru.svg') }}" class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h4 class="font-semibold text-white text-2xl">Jam Operasional</h4>
                    <p class="text-white text-[20px] mt-1">{{ $jam }}</p>
                </div>
            </div>
            @endif

            {{-- Pendidikan --}}
            @if(!empty($pendidikan))
            <div class="flex items-start gap-5">
                <div class="mt-1 w-8 shrink-0 flex justify-center">
                    <img src="{{ asset('vector/pddbiru.svg') }}" class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h4 class="font-semibold text-white text-2xl">Pendidikan</h4>
                    <p class="text-white text-[20px] mt-1">
                        {{ is_array($pendidikan) ? implode(', ', $pendidikan) : $pendidikan }}
                    </p>
                </div>
            </div>
            @endif

            {{-- Persyaratan --}}
            @if(!empty($persyaratan))
            <div class="flex items-start gap-5">
                <div class="mt-1 w-8 shrink-0 flex justify-center">
                    <img src="{{ asset('vector/docbiru.svg') }}" class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h4 class="font-semibold text-white text-2xl">Persyaratan Dokumen</h4>
                    <ul class="text-white text-[20px] mt-1 list-disc list-inside space-y-1">
                        @foreach($persyaratan as $p)
                        <li>{{ $p }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>