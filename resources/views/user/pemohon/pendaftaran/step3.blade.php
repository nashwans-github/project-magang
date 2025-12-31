@extends('layout.pendaftaran-layout')

@section('title', 'Upload Berkas')

@section('content')
<div class="min-h-screen bg-black text-white">
    <div class="pt-0">

        {{-- HEADER --}}
        <header class="w-full bg-white/60 backdrop-blur-md shadow">
            <div class="max-w-7xl mx-auto flex items-center justify-between py-5 px-6">
                <div class="flex items-center space-x-3">
                    <img src="/images/logo-pemkot.png" class="w-10" alt="Logo">
                    <span class="font-bold text-[#031CFC] text-[15px] tracking-wide"
                        style="font-family: 'Poppins', sans-serif;">
                        PEMERINTAH KOTA SURABAYA
                    </span>
                </div>

                <div class="text-[#010D96] text-[19px] font-semibold tracking-wide">
                    Formulir Pendaftaran Magang
                </div>
            </div>
        </header>

        {{-- PROGRESS --}}
        <div class="max-w-6xl mx-auto mt-10 relative">

            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[480px] h-[4px] bg-gray-600 rounded-full"></div>

            <div class="absolute top-10 left-1/2 -translate-x-[240px] h-[4px] bg-[#0554F2] rounded-full transition-all duration-500"
                style="width: 344px;"></div>

            <div class="flex justify-center gap-12 relative z-10">
                @php
                $labels = ['Data Diri<br>Pemohon','Data Diri<br>Peserta','Upload<br>Berkas','Review<br>Pengajuan'];
                @endphp

                @foreach ([1,2,3,4] as $i)
                <div class="flex flex-col items-center">
                    <div class="step-circle w-20 h-20 rounded-full flex items-center justify-center shadow-xl
                            {{ $i <= 3 ? 'bg-[#0554F2]' : 'bg-gray-600' }}">
                        <img src="/vector/{{ $i }}.svg" class="max-w-[55%] max-h-[55%] object-contain" />
                    </div>
                    <p class="mt-3 text-sm text-gray-300 text-center leading-tight">{!! $labels[$i-1] !!}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- FORM --}}
        <div class="flex justify-center py-14">
            <div class="bg-black/90 backdrop-blur-xl max-w-[1000px] w-full mx-auto rounded-[40px]
                pb-24 border border-white/10 shadow-[0_0_60px_#FBCD35,_0_0_250px_#FBCD3540,_0_0_400px_#FBCD3520]">

                <h1 class="text-center text-[36px] font-semibold text-[#0554F2] mt-12 mb-10">
                    Upload Berkas Peserta Magang
                </h1>

                <form method="POST" action="{{ route('pendaftaran.step3.store', $slug) }}"
                    enctype="multipart/form-data"
                    class="space-y-6 max-w-[780px] mx-auto">
                    @csrf

                    @foreach($instansi['persyaratan'] as $index => $berkas)
                    @php
                    $field = \Illuminate\Support\Str::slug($berkas, '-');
                    $uploaded = $uploadedFiles[$field] ?? null;
                    @endphp

                    <div class="bg-[#222] rounded-2xl px-10 py-8 shadow-md border border-white/5">
                        <label class="text-white text-[18px] tracking-wide">
                            {{ $berkas }}
                        </label>

                        <div class="relative mt-2">
                            <div class="w-full px-4 py-3 rounded-xl bg-white/50 text-black font-medium
                        flex items-center justify-between cursor-pointer">

                                <span id="lbl-{{ $field }}"
                                    class="{{ $uploaded ? 'text-black font-medium' : 'text-black/50' }}">
                                    {{ $uploaded ?? 'Upload File' }}
                                </span>
                            </div>

                            <input type="file"
                                name="{{ $field }}"
                                id="{{ $field }}"
                                accept="application/pdf,image/jpeg,image/png"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                onchange="updateFile('{{ $field }}','lbl-{{ $field }}')">
                        </div>

                        @error($field)
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endforeach

                    {{-- BUTTONS --}}
                    <div class="flex justify-end gap-4 pt-5">
                        <a href="{{ route('pendaftaran.peserta', $slug) }}"
                            class="px-7 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold">
                            Kembali
                        </a>

                        <button type="submit"
                            class="px-7 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white
                            font-semibold shadow-lg">
                            Lanjutkan
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function updateFile(inputId, labelId) {
        const input = document.getElementById(inputId);
        const label = document.getElementById(labelId);

        if (input.files.length > 0) {
            label.textContent = input.files[0].name;
            label.classList.remove("text-black/50");
            label.classList.add("text-black", "font-medium"); // tambah font-medium
        } else {
            label.textContent = 'Upload File';
            label.classList.remove("text-black", "font-medium");
            label.classList.add("text-black/50");
        }
    }
</script>
@endpush

@endsection