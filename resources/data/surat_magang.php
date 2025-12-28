<?php

return [
    // KASUS 1: Nashwan (Permintaan Baru - Surat Diterima - Belum Selesai)
    // Sesuai Gambar 2 (Hanya muncul 1 slot upload kosong)
    [
        'id' => 1,
        'id_dinas' => 3,
        'nama' => 'Nashwan Bima Andika',
        'instansi' => 'Universitas Negeri Surabaya',
        'dinas' => 'Dinas Komunikasi dan Informatika',
        'jurusan' => 'Teknik Informatika',
        'bidang' => 'Website',
        'no_telfon' => '08155142348',
        'periode' => '18 Agustus 2025 - 19 Desember 2025',
        'tanggal' => '22-10-2025',
        'deskripsi' => 'Mengajukan Surat Diterima Magang', // Keterangan di List
        'status_pengajuan' => 'pending', // Pending = Belum diupload admin
        'dokumen' => [
            // Dokumen yang diminta saat ini (Kosong)
            [
                'title' => 'Surat Keterangan Diterima Magang',
                'status' => 'empty', // Minta upload
                'file' => null,
                'is_current_request' => true // Penanda ini yang sedang diminta
            ]
        ]
    ],

    // KASUS 2: Bagas (Permintaan Kedua - Surat Selesai - Belum Selesai)
    // Sesuai Gambar 3 (Ada history Surat Diterima, dan slot baru Surat Selesai)
    [
        'id' => 2,
        'id_dinas' => 3,
        'nama' => 'Bagas Yudo Nugroho',
        'instansi' => 'ITS',
        'dinas' => 'Dinas Komunikasi dan Informatika',
        'jurusan' => 'Sistem Informasi',
        'bidang' => 'Jaringan',
        'no_telfon' => '081234567890',
        'periode' => '15 September 2025 - 15 Januari 2026',
        'tanggal' => '15-09-2025',
        'deskripsi' => 'Mengajukan Surat Selesai Magang',
        'status_pengajuan' => 'pending', 
        'dokumen' => [
            // History (Sudah ada sebelumnya)
            [
                'title' => 'Surat Keterangan Diterima Magang',
                'status' => 'uploaded',
                'file' => 'surat_diterima_bagas.pdf',
                'is_current_request' => false
            ],
            // Permintaan Baru (Kosong)
            [
                'title' => 'Surat Keterangan Selesai Magang',
                'status' => 'empty',
                'file' => null,
                'is_current_request' => true
            ]
        ]
    ],

    // KASUS 3: Hildan (Permintaan Lama - Surat Diterima - SUDAH SELESAI)
    // Akan ditaruh di paling bawah list
    [
        'id' => 3,
        'id_dinas' => 3, 
        'nama' => 'Hildan Abiansyah',
        'instansi' => 'UPN Veteran Jatim',
        'dinas' => 'Dinas Komunikasi dan Informatika',
        'jurusan' => 'Informatika',
        'bidang' => 'Mobile App',
        'no_telfon' => '081299887766',
        'periode' => '07 November 2025 - 07 Maret 2026',
        'tanggal' => '07-11-2025',
        'deskripsi' => 'Mengajukan Surat Diterima Magang',
        'status_pengajuan' => 'selesai', // Status Selesai
        'dokumen' => [
            [
                'title' => 'Surat Keterangan Diterima Magang',
                'status' => 'uploaded',
                'file' => 'surat_diterima_hildan.pdf',
                'is_current_request' => true
            ]
        ]
    ],
    
    // ==========================================
    // DATA MILIK DINKES (DINAS ID: 2) - Untuk Tes
    // ==========================================
    [
        'id' => 4,
        'id_dinas' => 2, // Milik Dinkes
        'nama' => 'Siti Aminah',
        'instansi' => 'UNAIR',
        'dinas' => 'Dinas Kesehatan Surabaya',
        'jurusan' => 'Farmasi',
        'bidang' => 'Farmasi',
        'no_telfon' => '081234567777',
        'periode' => '01 Januari 2025 - 01 April 2025',
        'tanggal' => '02-01-2025',
        'deskripsi' => 'Mengajukan Surat Selesai Magang',
        'status_pengajuan' => 'pending',
        'dokumen' => [
            [
                'title' => 'Surat Keterangan Selesai Magang',
                'status' => 'empty',
                'file' => null,
                'is_current_request' => true
            ]
        ]
    ]
    /*[
        'id' => 5,
        'id_dinas' => 1, 
        'nama' => 'Hildan Abiansyah',
        'instansi' => 'UPN Veteran Jatim',
        'dinas' => 'Dinas Komunikasi dan Informatika',
        'jurusan' => 'Informatika',
        'bidang' => 'Mobile App',
        'no_telfon' => '081299887766',
        'periode' => '07 November 2025 - 07 Maret 2026',
        'tanggal' => '09-03-2026',
        'deskripsi' => 'Mengajukan Surat Diterima Magang',
        'status_pengajuan' => 'pending', 
        'dokumen' => [
            [
                'title' => 'Surat Keterangan Selesai Magang',
                'status' => 'empty',
                'file' => 'null',
                'is_current_request' => true
            ]
        ]
    ],*/
];