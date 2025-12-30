@extends('layout.admin-layout')

@section('content')
<div class="text-white font-sans min-h-screen">

    {{-- KOTAK 1: JUDUL HALAMAN --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 mb-6 shadow-lg">
        <h1 class="text-4xl font-bold text-[#0554f2]">Verifikasi</h1>
    </div>

    {{-- KOTAK 2: INFORMASI UTAMA PESERTA --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 mb-6 shadow-lg relative overflow-hidden">
        <h2 class="text-3xl font-bold text-white mb-6 border-b border-white pb-6">
            {{ $applicant['nama'] }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
            <div class="space-y-6">
                <div class="flex items-start gap-3">
                    <img src="{{ asset('vector/Email.svg') }}" alt="email icon" class="w-7 h-7 mt-3">
                    <div>
                        <label class="text-white/60 text-base font-semibold block">Email</label>
                        <div class="text-white font-semibold text-xl">{{ $applicant['email'] }}</div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <img src="{{ asset('vector/Instansi.svg') }}" alt="instansi icon" class="w-7 h-7 mt-3">
                    <div>
                        <label class="text-white/60 text-base font-semibold block">Instansi</label>
                        <div class="text-white font-semibold text-xl">{{ $applicant['instansi'] }}</div>
                    </div>
                </div>
                 <div class="flex items-start gap-3">
                    <img src="{{ asset('vector/Telfon.svg') }}" alt="phone icon" class="w-7 h-7 mt-3">
                    <div>
                        <label class="text-white/60 text-base font-semibold block">Nomor Handphone</label>
                        <div class="text-white font-semibold text-xl">{{ $applicant['no_telfon'] }}</div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                 <div class="flex items-start gap-3">
                    <img src="{{ asset('vector/Dinas.svg') }}" alt="dinas icon" class="w-7 h-7 mt-3">
                    <div>
                        <label class="text-white/60 text-base font-semibold block">Dinas</label>
                        <div class="text-white font-semibold text-xl">{{ $applicant['dinas_tujuan'] ?? 'Dinas Terkait' }}</div>
                    </div>
                </div>
                 <div class="flex items-start gap-3">
                    <img src="{{ asset('vector/Tanggal Pendaftaran.svg') }}" alt="calendar icon" class="w-7 h-7 mt-3">
                    <div>
                        <label class="text-white/60 text-base font-semibold block">Tanggal Pendaftaran</label>
                        <div class="text-white font-semibold text-xl">{{ $applicant['tanggal_pendaftaran'] }}</div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <img src="{{ asset('vector/Periode Magang.svg') }}" alt="periode icon" class="w-7 h-7 mt-3">
                    <div>
                        <label class="text-white/60 text-base font-semibold block">Periode Magang</label>
                        <div class="text-white font-semibold text-xl">{{ $applicant['periode'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KOTAK 3: TABEL DATA DIRI PESERTA --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 mb-6 shadow-lg">
        <h3 class="text-2xl font-semibold text-white mb-8">Data Diri Peserta</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm font-medium text-center border-separate border-spacing-0">
                <thead class="bg-[#333238] text-white uppercase text-sm font-semibold tracking-wider">
                    <tr>
                        <th class="px-6 py-5 rounded-tl-[10px] border-b border-white/50">Nama</th>
                        <th class="px-6 py-5 border-b border-white/50">Email</th>
                        <th class="px-6 py-5 border-b border-white/50">No Handphone</th>
                        <th class="px-6 py-5 border-b border-white/50">Bidang</th>
                        <th class="px-6 py-5 rounded-tr-[10px] border-b border-white/50">Jurusan</th>
                    </tr>
                </thead>
                <tbody class="text-white bg-[#232226]">
                    @foreach($applicant['anggota'] as $anggota)
                    <tr>
                        <td class="px-6 py-5 font-medium {{ !$loop->last ? 'border-b border-white/50' : '' }}">{{ $anggota['nama'] }}</td>
                        <td class="px-6 py-5 {{ !$loop->last ? 'border-b border-white/50' : '' }}">{{ $anggota['email'] }}</td>
                        <td class="px-6 py-5 {{ !$loop->last ? 'border-b border-white/50' : '' }}">{{ $anggota['no_telfon'] }}</td>
                        <td class="px-6 py-5 {{ !$loop->last ? 'border-b border-white/50' : '' }}">{{ $anggota['bidang'] }}</td>
                        <td class="px-6 py-5 {{ !$loop->last ? 'border-b border-white/50' : '' }}">{{ $anggota['jurusan'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- KOTAK 4: BERKAS PERSYARATAN --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 mb-8 shadow-lg">
        <h3 class="text-xl font-bold text-white mb-6">Berkas Persyaratan</h3>
        <div class="space-y-4">
            @php $files = ['Surat_Pengantar.pdf', 'Proposal.pdf', 'KTP.pdf']; @endphp
            @foreach($files as $file)
            <div class="flex items-center justify-between bg-[#2D2D2D] p-4 rounded-[10px] group">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('vector/Berkas Persyaratan.svg') }}" alt="pdf icon" class="w-8 h-8 p-1 bg-red-500/10 rounded-lg">
                    <span class="text-base font-medium text-gray-200 group-hover:text-white transition">{{ $file }}</span>
                </div>
                <button class="bg-[#0554f2] text-white px-4 py-2 rounded-[10px] text-base font-medium shadow-md">Lihat File</button>
            </div>
            @endforeach
        </div>
    </div>

    {{-- FOOTER ACTION --}}
    <div class="flex flex-col md:flex-row items-center justify-between mt-8 pb-8 px-2">
        <div class="text-white text-base italic mb-4 md:mb-0 font-medium">
            @if(strtolower($applicant['status']) == 'diterima') Pemohon ini telah diterima.
            @elseif(strtolower($applicant['status']) == 'ditolak') Pemohon ini telah ditolak.
            @endif
        </div>

        <div class="flex gap-4">
            @if(strtolower($applicant['status']) == 'menunggu verifikasi')
                <button class="bg-[#00B65A] hover:bg-green-600 text-white px-8 py-3 rounded-[15px] font-bold shadow-lg text-lg">Terima</button>
                <button class="bg-[#FF0000] hover:bg-red-600 text-white px-8 py-3 rounded-[15px] font-bold shadow-lg text-lg">Tolak</button>
            @elseif(strtolower($applicant['status']) == 'diterima')
                <button class="bg-[#FF0000] hover:bg-red-600 text-white px-8 py-3 rounded-[15px] font-bold shadow-lg text-lg">Nonaktifkan</button>
            @endif
        </div>
    </div>
</div>
@endsection