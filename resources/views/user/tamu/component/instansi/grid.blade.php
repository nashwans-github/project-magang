<div class="max-w-[1295px] mx-auto px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-12">

        @php
        $instansis = [
        [
        'slug' => 'komunikasi-informatika',
        'img' => '/images/kominfo.jpg',
        'title' => "Dinas Komunikasi dan<br>Informatika",
        'desc' => "DINKOMINFO Surabaya bertugas mengelola
        jaringan internet pemerintah, mengembangkan
        aplikasi layanan publik, mengelola situs web
        dan sosial media resmi Pemkot Surabaya, serta
        mengoperasikan layanan darurat Command
        Center 112."
        ],
        [
        'slug' => 'pendidikan',
        'img' => '/images/dinpen.jpg',
        'title' => "Dinas Pendidikan",
        'desc' => "DISPENDIK Surabaya bertanggung jawab penuh
        untuk mengelola sekolah negeri, membina
        tenaga pendidik (Guru), menyusun kurikulum
        muatan lokal, mendistribusikan bantuan
        pendidikan, serta mengawasi kualitas
        pembelajaran di seluruh kota."
        ],
        [
        'slug' => 'kesehatan',
        'img' => '/images/dinkes.jpg',
        'title' => "Dinas Kesehatan",
        'desc' => "DINKES Surabaya bertugas untuk mengelola
        Pusat Kesehatan Masyarakat (Puskesmas) yang
        ada di seluruh kecamatan, menjalankan
        program vaksinasi, meengendalikan penyakit
        menular, mengawasi kesehatan lingkungan,
        dan menyelenggarakan program kesehatan."
        ],
        [
        'slug' => 'sumber-daya-air',
        'img' => '/images/dinsumberair.jpg',
        'title' => "Dinas Sumber Daya Air dan<br>Bina Marga",
        'desc' => "DSDABM memiliki dua tugas utama, yakni yang
        pertama melakukan pengelolaan terhadap sistem
        drainase (saluran air), rumah pompa, dan waduk
        untuk mencegah banjir. Yang kedua adalah untuk
        melakukan pembangunan dan perbaikan jalan,
        jembatan, atau trotoar."
        ],
        [
        'slug' => 'ketahanan-pangan',
        'img' => '/images/dinpangan.jpg',
        'title' => "Dinas Ketahanan Pangan dan<br>Pertanian",
        'desc' => "DKPP Kota Surabaya bertanggung jawab atas
        pengawasan keamanan pangan di pasaran,
        membina kelompok tani dan peternak kota,
        serta menjalankan program untuk menjaga
        stabilitas pasokan pangan."
        ],
        [
        'slug' => 'perumahan-permukiman',
        'img' => '/images/dinperumahan.jpg',
        'title' => "Dinas Perumahan Rakyat dan<br>Kawasan Permukiman Serta<br>Pertahanan",
        'desc' => "DPRKPP Surabaya memiliki tugas mengurus
        segala hal yang berhubungan dengan
        perumahan, mengelola Rumah Susun Sewa
        (Rusunawa), menata kawasan kumuh,
        pemakaman umum, serta mengelola aset
        tanah milik Pemkot Surabaya"
        ],
        ];
        @endphp

        @foreach ($instansis as $instansi)
        @include('user.tamu.component.instansi.card', [
        'instansi' => $instansi
        ])
        @endforeach

    </div>
</div>