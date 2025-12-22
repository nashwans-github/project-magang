<?php

// resources/data/peserta.php

// --------------------------------------------------------------------------
// 1. LOAD DATA DARI PEMOHON (RELASI DATA)
// --------------------------------------------------------------------------
// Kita ambil data pemohon untuk mengetahui asal instansi setiap anggota
$allPemohon = include resource_path('data/pemohon.php');

// Buat "Kamus" untuk mencocokkan Nama -> Asal Instansi
// Format: ['Nashwan Bima' => 'UNESA', 'Vanezza' => 'UNESA', ...]
$instansiMap = [];

foreach ($allPemohon as $pemohon) {
    $sekolah = $pemohon['asal_instansi'] ?? 'Instansi Tidak Dikenal';
    
    // Loop setiap anggota di dalam pemohon tersebut
    if (isset($pemohon['anggota']) && is_array($pemohon['anggota'])) {
        foreach ($pemohon['anggota'] as $anggota) {
            // Kita simpan mapping: Nama Peserta => Asal Instansi
            $instansiMap[$anggota['nama']] = $sekolah;
        }
    }
}

// --------------------------------------------------------------------------
// 2. DATA MANUAL (Disesuaikan dengan Map diatas)
// --------------------------------------------------------------------------
$manualData = [
    [
        'id' => 'peserta1',
        'nama' => 'Nashwan Bima Andika',
        'no_telp' => '08155142348',
        'email' => 'peserta01@gmail.com',
        'instansi_slug' => 'kominfo',
        'password' => 'HANSOLTOPUP123',
        'jurusan' => 'Teknik Informatika',
        'bidang' => 'Website',
        'tgl_mulai' => '2025-08-18',
        'tgl_selesai' => '2025-12-20',
        'status_keaktifan' => 'Aktif'
    ],
    [
        'id' => 'peserta2',
        'nama' => 'Vanezza Brilliance',
        'no_telp' => '0815679324',
        'email' => 'peserta02@gmail.com',
        'instansi_slug' => 'kominfo',
        'password' => 'SeasonBesokPastiEternal',
        'jurusan' => 'Teknik Informatika',
        'bidang' => 'Media Sosial',
        'tgl_mulai' => '2025-08-18',
        'tgl_selesai' => '2025-12-20',
        'status_keaktifan' => 'Aktif'
    ],
    [
        'id' => 'peserta3',
        'nama' => 'Hildan Abiansyah',
        'no_telp' => '08585298871',
        'email' => 'hildan.abiansyah32@gmail.com',
        'instansi_slug' => 'kominfo',
        'password' => 'SeasonBesokPastiimmortal',
        'jurusan' => 'Teknik Informatika',
        'bidang' => 'Aplikasi',
        'tgl_mulai' => '2026-01-14',
        'tgl_selesai' => '2026-12-14',
        'status_keaktifan' => 'Aktif'
    ],
    [
        'id' => 'peserta4',
        'nama' => 'Wildan Galih Ramadhan',
        'no_telp' => '08134998871',
        'email' => 'wildan.galih21@gmail.com',
        'instansi_slug' => 'dinas-perhubungan',
        'password' => 'TahunDepanBeliSHIJIRO',
        'jurusan' => 'Teknik Informatika',
        'bidang' => 'Jaringan',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2025-12-24',
        'status_keaktifan' => 'Aktif'
    ],
    [
        'id' => 'peserta5',
        'nama' => 'Bagas Yudho Nugroho',
        'no_telp' => '081339220982',
        'email' => 'bagaszs@gmail.com',
        'instansi_slug' => 'dinas-sosial',
        'password' => 'BAGAS12345',
        'jurusan' => 'Teknik Informatika',
        'bidang' => 'Website',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2027-12-19',
        'status_keaktifan' => 'Aktif'
    ],
    [
        'id' => 'peserta6',
        'nama' => 'Satria Nugroho Putra',
        'no_telp' => '083898772211',
        'email' => 'satria@gmail.com',
        'instansi_slug' => 'dinas-sosial',
        'password' => 'Crowded12345',
        'jurusan' => 'Teknik Informatika',
        'bidang' => 'BLC',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2027-12-19',
        'status_keaktifan' => 'Nonaktif'
    ],
    [
        'id' => 'peserta7',
        'nama' => 'Rehan Ginsol',
        'no_telp' => '0838xxxxxx',
        'email' => 'rehanginsolxyz@gmail.com',
        'instansi_slug' => 'dinas-sosial',
        'password' => 'reginsolhan987',
        'jurusan' => 'Ekonomi Islam',
        'bidang' => 'Administrasi',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2027-12-19',
        'status_keaktifan' => 'Nonaktif'
    ],
    [
        'id' => 'peserta8',
        'nama' => 'Ahmad Fajar',
        'no_telp' => '081234567890',
        'email' => 'ahmad.fajar@gmail.com',
        'instansi_slug' => 'dinas-sosial',
        'password' => 'FAJARRRR12345',
        'jurusan' => 'Pendidikan Pemadam Kebakaran',
        'bidang' => 'BLC',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2027-12-19',
        'status_keaktifan' => 'Nonaktif'
    ],
    [
        'id' => 'peserta9',
        'nama' => ' Monica Everett',
        'no_telp' => '08123xxxxxxx',
        'email' => 'everettmonica@gmail.com',
        'instansi_slug' => 'dinas-sosial',
        'password' => 'evemo32456',
        'jurusan' => 'Ilmu Komunikasi',
        'bidang' => 'Sosial Media',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2027-12-19',
        'status_keaktifan' => 'Aktif'
    ],
];

// PROSES INJECT 'asal_instansi' KE MANUAL DATA
// Kita loop manual data, lalu kita cari namanya di $instansiMap
foreach ($manualData as &$data) {
    // Jika nama peserta ada di daftar pemohon, ambil sekolahnya
    if (isset($instansiMap[$data['nama']])) {
        $data['asal_instansi'] = $instansiMap[$data['nama']];
    } else {
        // Fallback jika tidak ditemukan (misal typo nama)
        $data['asal_instansi'] = 'Instansi Tidak Diketahui'; 
    }
}
unset($data); // Hapus referensi memori

// --------------------------------------------------------------------------
// 3. GENERATOR OTOMATIS (Based on Pemohon Generator)
// --------------------------------------------------------------------------
// Agar data sinkron, kita buat peserta DARI data anggota yang ada di pemohon.php
// (Bukan generate random lagi, tapi mengambil dari anggota dummy pemohon)

$generatedData = [];
$counter = 10; // Lanjut dari ID peserta9

foreach ($allPemohon as $pemohon) {
    // Skip data manual (karena sudah ditulis diatas), kita ambil yang generated saja
    // Cara taunya: ID pemohon manual itu 'pemohon_1' s/d 'pemohon_4'
    // Jadi kalau ID mengandung 'dummy_', kita proses.
    if (strpos($pemohon['id'], 'dummy_') === false) {
        continue;
    }

    // Ambil data umum dari pemohon (Parent)
    $sekolah = $pemohon['asal_instansi'];
    $dinasTujuan = $pemohon['dinas_tujuan'];
    $tglMulai = $pemohon['tgl_mulai'];
    $tglSelesai = $pemohon['tgl_selesai'];
    
    // Loop Anggotanya untuk dijadikan Peserta
    foreach ($pemohon['anggota'] as $anggota) {
        $generatedData[] = [
            'id' => 'peserta_gen_' . $counter++,
            'nama' => $anggota['nama'],
            'no_telp' => '08' . rand(1000000000, 9999999999),
            'email' => strtolower(str_replace(' ', '', $anggota['nama'])) . rand(1,99) . '@student.com',
            'instansi_slug' => $dinasTujuan,
            'password' => 'password123',
            'jurusan' => 'Teknik Informatika', // Default random
            'bidang' => $anggota['bidang'],
            'tgl_mulai' => $tglMulai,
            'tgl_selesai' => $tglSelesai,
            'status_keaktifan' => ($pemohon['status'] == 'diterima') ? 'Aktif' : 'Nonaktif',
            'asal_instansi' => $sekolah // <--- INI YANG PENTING
        ];
    }
}

// 4. GABUNGKAN
return array_merge($manualData, $generatedData);