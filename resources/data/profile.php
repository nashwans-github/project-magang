<?php

return [
    1 => [
        // BAGIAN 1: PROFIL INSTANSI (Langsung di luar, jangan dibungkus 'instansi' lagi)
        'nama'            => 'Dinas Komunikasi dan Informatika',
        'pembimbing'      => 9,  // Ini nanti akan ditimpa hitungan otomatis di Controller
        'peserta'         => 75, // Ini nanti akan ditimpa hitungan otomatis di Controller
        'lokasi'          => 'Jl. Jimerto No. 25-27 Lantai 5. Surabaya, Jawa Timur 60272',
        'telepon'         => '(031) 5312144',
        'jam_operasional' => '08.00 - 16.00',
        'pendidikan'      => 'SMK, Mahasiswa S1/D4 Sederajat',
        'persyaratan'     => 'KTP, Proposal, Surat Pengantar, CV',
        'deskripsi'       => 'DINKOMINFO Surabaya bertugas mengelola jaringan internet pemerintah, mengembangkan aplikasi layanan publik, mengelola situs web dan sosial media resmi Pemkot Surabaya, serta mengoperasikan layanan darurat Command Center 112.',
        
        // BAGIAN 2: BIDANG (Gunakan kunci 'bidang' tanpa 's')
        'bidang' => [
            [
                'nama' => 'Sosial Media', 
                'icon' => 'Sosial-Media.svg', 
                'gradient' => 'from-[#FF5F6D] to-[#FFC371]'
            ],
            [
                'nama' => 'Desain', 
                'icon' => 'Desain.svg', 
                'gradient' => 'from-[#1C8CFF] to-[#FFFFFF]'
            ],
            [
                'nama' => 'Administrasi', 
                'icon' => 'Administrasi.svg', 
                'gradient' => 'from-[#FF5F6D] to-[#FFFFFF]'
            ],
            [
                'nama' => 'Live Streaming', 
                'icon' => 'Live-Streaming.svg', 
                'gradient' => 'from-[#0F2027] to-[#4296BA]'
            ],
            [
                'nama' => 'Data Sains', 
                'icon' => 'Data-Sains.svg', 
                'gradient' => 'from-[#1CBB7F] to-[#FFC371]'
            ],
            [
                'nama' => 'Aplikasi', 
                'icon' => 'Aplikasi.svg', 
                'gradient' => 'from-[#7D648B] to-[#F9F9F9]'
            ],
            [
                'nama' => 'Jaringan', 
                'icon' => 'Jaringan.svg', 
                'gradient' => 'from-[#F59E9E] to-[#F9F9F9]'
            ],
            [
                'nama' => 'BLC', 
                'icon' => 'BLC.svg', 
                'gradient' => 'from-[#A1C4FD] to-[#C2E9FB]'
            ],
        ],

        // BAGIAN 3: DOKUMENTASI
        'dokumentasi' => [
            ['image' => 'Dokumentasi1.svg', 'id' => 'doc1'],
            ['image' => 'Dokumentasi2.svg', 'id' => 'doc2'],
            ['image' => 'Dokumentasi3.svg', 'id' => 'doc3'],
        ]
    ],
    
    2 => [
        // DATA ID 2 JUGA DISAMAKAN STRUKTURNYA
        'nama'            => 'Dinas Kesehatan Surabaya',
        'pembimbing'      => 12,
        'peserta'         => 40,
        'lokasi'          => 'Jl. Jemursari No. 197, Surabaya',
        'telepon'         => '(031) 8439473',
        'jam_operasional' => '07.30 - 15.30',
        'pendidikan'      => 'D3/S1 Kesehatan Masyarakat, Kedokteran, Farmasi',
        'persyaratan'     => 'KTP, Proposal, Transkrip Nilai',
        'deskripsi'       => 'Dinas Kesehatan bertanggung jawab atas pelayanan kesehatan masyarakat, puskesmas, dan pencegahan penyakit menular di Surabaya.',
        
        'bidang' => [
            ['nama' => 'Pelayanan Medis', 'icon' => 'medis.svg', 'gradient' => 'from-[#11998e] to-[#38ef7d]'],
            ['nama' => 'Farmasi', 'icon' => 'obat.svg', 'gradient' => 'from-[#00b09b] to-[#96c93d]'],
            ['nama' => 'Gizi', 'icon' => 'gizi.svg', 'gradient' => 'from-[#ff9966] to-[#ff5e62]'], 
        ],

        'dokumentasi' => [
            ['image' => 'Dokumentasi3.svg', 'id' => 'doc3'], 
        ]
    ]
];