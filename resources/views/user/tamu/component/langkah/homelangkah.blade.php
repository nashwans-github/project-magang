<section class="w-full bg-black py-5 px-5">
    <div id="langkah" class="w-44 h-[3.3px] bg-[#0554F2] mx-auto mt-[50px] mb-[30px]"></div>

    <h2 class="text-center text-white text-3xl md:text-[40px] font-medium mb-14 leading-[55px]">
        Ingin daftar tapi masih bingung? Berikut <span class="font-bold">tahapan
            <br class="hidden md:block"> pendaftaran </span> magang di
        <span class="font-bold">Pemerintah Kota Surabaya</span>
    </h2>

    <div class="max-w-[1230px] mx-auto bg-[#656565] rounded-[40px] p-10 relative" style="height: 1150px;">

        <div class="absolute left-1/2 w-[5px] bg-[#B4B4B4] rounded-full"
            style="top: 60px; bottom: 60px; transform: translateX(-50%);">
        </div>

        @php
        $steps = [
        [
        'number' => 1,
        'title' => 'REGISTRASI AKUN',
        'text' => "Calon peserta magang melakukan pembuatan akun.",
        'image' => '/images/regis.png',
        'numberImage' => '/images/no1.png',
        'position' => 'right',
        ],
        [
        'number' => 2,
        'title' => 'ADMINISTRASI',
        'text' => "Calon peserta magang melengkapi data diri dan melakukan upload berkas. Kemudian pihak Instansi akan melakukan verifikasi.",
        'image' => '/images/administrasi.png',
        'numberImage' => '/images/no2.png',
        'position' => 'left',
        ],
        [
        'number' => 3,
        'title' => 'PENERIMAAN',
        'text' => "Calon peserta magang yang diterima akan mendapatkan email verifikasi dari pihak Instansi dan menjadi peserta magang.",
        'image' => '/images/penerimaan.png',
        'numberImage' => '/images/no3.png',
        'position' => 'right',
        ],
        [
        'number' => 4,
        'title' => 'PELAKSANAAN',
        'text' => "Peserta magang akan melaksanakan kegiatan magang sesuai dengan durasi yang telah ditentukan pada pendaftaran.",
        'image' => '/images/pelaksanaan.png',
        'numberImage' => '/images/no4.png',
        'position' => 'left',
        ],
        [
        'number' => 5,
        'title' => 'KELULUSAN',
        'text' => "Peserta magang akan dinyatakan lulus setelah periode magang selesai dan akan mendapatkan sertifikat magang.",
        'image' => '/images/kelulusan.png',
        'numberImage' => '/images/no5.png',
        'position' => 'right',
        ],
        ];
        @endphp

        {{-- LOOP STEP --}}
        @foreach ($steps as $index => $step)
        <div class="mb-[-50px] last:mb-0"> {{-- Atur jarak antar step di sini --}}
            @include('user.tamu.component.langkah.step', $step)
        </div>
        @endforeach

    </div>
</section>