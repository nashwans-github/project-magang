<?php

// resources/data/pemohon.php

// 1. DATA MANUAL
$manualData = [
    [
        'id' => 'pemohon_1',
        'akun_utama' => 'Nashwan Bima Andika',
        'no_telp' => '08155142348',
        'email' => 'peserta01@gmail.com',
        'asal_instansi' => 'Universitas Negeri Surabaya',
        'dinas_tujuan' => 'kominfo', 
        'tgl_registrasi' => '2025-08-12',
        'tgl_mulai' => '2025-08-18',
        'tgl_selesai' => '2025-12-20',
        'status' => 'diterima',
        'anggota' => [
            ['nama' => 'Nashwan Bima Andika', 'peran' => 'ketua', 'bidang' => 'Website'], // Ganti = jadi =>
            ['nama' => 'Vanezza Brilliance', 'peran' => 'anggota', 'bidang' => 'Media Sosial'] // Ganti = jadi =>
        ]
    ],
    [
        'id' => 'pemohon_2',
        'akun_utama' => 'Hildan Abiansyah',
        'no_telp' => '08585298871',
        'email' => 'hildan.abiansyah34@gmail.com',
        'asal_instansi' => 'Universitas Negeri Surabaya',
        'dinas_tujuan' => 'kominfo', 
        'tgl_registrasi' => '2025-06-16',
        'tgl_mulai' => '2026-01-14',
        'tgl_selesai' => '2026-12-14',
        'status' => 'pending',
        'anggota' => [
            ['nama' => 'Hildan Abiansyah', 'peran' => 'ketua', 'bidang' => 'Aplikasi']
        ]
    ],
    [
        'id' => 'pemohon_3',
        'akun_utama' => 'Wildan Galih Ramadhan',
        'no_telp' => '08134998871',
        'email' => 'wildan.galih21@gmail.com',
        'asal_instansi' => 'Universitas Gadjah Mada',
        'dinas_tujuan' => 'dinas-perhubungan', 
        'tgl_registrasi' => '2025-07-23',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2025-12-24',
        'status' => 'ditolak',
        'anggota' => [
            ['nama' => 'Wildan Galih Ramadhan', 'peran' => 'ketua', 'bidang' => 'Jaringan']
        ]
    ],
    [
        'id' => 'pemohon_4',
        'akun_utama' => 'Bagas Yudho Nugroho',
        'no_telp' => '081339220982',
        'email' => 'bagaszs@gmail.com',
        'asal_instansi' => 'Universitas Pembangunan Negeri Veteran Jakarta',
        'dinas_tujuan' => 'dinas-sosial', 
        'tgl_registrasi' => '2024-05-14',
        'tgl_mulai' => '2025-10-19',
        'tgl_selesai' => '2027-12-19',
        'status' => 'diterima',
        'anggota' => [
            ['nama' => 'Bagas Yudho Nugroho', 'peran' => 'ketua', 'bidang' => 'Website'],
            ['nama' => 'Satria Nugroho Putra', 'peran' => 'anggota', 'bidang' => 'BLC'],
            ['nama' => 'Rehan Ginsol', 'peran' => 'anggota', 'bidang' => 'Administrasi'],
            ['nama' => 'Ahmad Fajar', 'peran' => 'anggota', 'bidang' => 'BLC'],
            ['nama' => 'Monica Everett', 'peran' => 'anggota', 'bidang' => 'Sosial Media']
        ]
    ],
];

// 2. GENERATOR OTOMATIS
$generatedData = [];
$jumlah_dummy = 102; 

// DATA BANK
$slugList = [
    'kominfo', 'dinas-pendidikan', 'dinas-kesehatan', 'dinas-perhubungan',
    'dinas-sosial', 'dinas-kependudukan', 'dinas-pemadam_kebakaran',
    'sumber-daya-air', 'perumahan', 'dinas-koperasi', 'ketahanan-pangan',
    'dinas-lingkungan_hidup', 'dinas-p3a', 'dinas-kebudayaan',
    'dinas-perpustakaan', 'dinas-pmptsp', 'dinas-perindustrian'
];

$sekolahList = ['SMKN 1 SBY', 'SMKN 2 SBY', 'UNAIR', 'ITS', 'UPN', 'UNESA', 'POLINEMA', 'UB', 'UGM'];
$bidangList = ['Website', 'Jaringan', 'Aplikasi', 'Sosial Media', 'Desain', 'Administrasi', 'Data Sains', 'BLC'];

$firstNames = ['Aditya', 'Bayu', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gita', 'Hana', 'Indra', 'Joko', 'Kiki', 'Lina', 'Rizky', 'Putri'];
$lastNames = ['Saputra', 'Wijaya', 'Nugroho', 'Pratama', 'Santoso', 'Hidayat', 'Ramadhan', 'Kusuma', 'Utami', 'Lestari', 'Wibowo'];

for ($i = 1; $i <= $jumlah_dummy; $i++) {
    
    // Generate Data Utama
    $randSlug = $slugList[array_rand($slugList)];
    $randSekolah = $sekolahList[array_rand($sekolahList)];
    $randFirstName = $firstNames[array_rand($firstNames)];
    $randLastName = $lastNames[array_rand($lastNames)];
    $randName = $randFirstName . ' ' . $randLastName;
    
    // Generate Tanggal Acak
    $regTimestamp = strtotime("-" . rand(1, 180) . " days");
    $tglRegistrasi = date('Y-m-d', $regTimestamp);
    
    $mulaiTimestamp = strtotime("+ " . rand(7, 14) . " days", $regTimestamp);
    $tglMulai = date('Y-m-d', $mulaiTimestamp);
    
    $selesaiTimestamp = strtotime("+ " . rand(3, 6) . " months", $mulaiTimestamp);
    $tglSelesai = date('Y-m-d', $selesaiTimestamp);

    // Status Acak
    $statusOptions = ['pending', 'pending', 'diterima', 'diterima', 'ditolak']; 
    $randStatus = $statusOptions[array_rand($statusOptions)];

    // Generate Anggota (Ketua + 0-3 Anggota Tambahan)
    $anggota = [];
    
    // 1. Masukkan Ketua (Wajib)
    $anggota[] = [
        'nama' => $randName,
        'peran' => 'ketua',
        'bidang' => $bidangList[array_rand($bidangList)]
    ];

    // 2. Acak jumlah anggota tambahan (0 sampai 3 orang)
    $jumlahAnggotaTambahan = rand(0, 3);

    for ($k = 0; $k < $jumlahAnggotaTambahan; $k++) {
        $memberFirstName = $firstNames[array_rand($firstNames)];
        $memberLastName = $lastNames[array_rand($lastNames)];
        $anggota[] = [
            'nama' => $memberFirstName . ' ' . $memberLastName,
            'peran' => 'anggota',
            'bidang' => $bidangList[array_rand($bidangList)]
        ];
    }

    $generatedData[] = [
        'id' => 'dummy_pemohon_' . $i,
        'akun_utama' => $randName,
        'no_telp' => '08' . rand(1000000000, 9999999999),
        'email' => strtolower($randFirstName . '.' . $randLastName) . rand(1, 99) . '@student.com',
        'asal_instansi' => $randSekolah,
        'dinas_tujuan' => $randSlug,
        'tgl_registrasi' => $tglRegistrasi,
        'tgl_mulai' => $tglMulai,
        'tgl_selesai' => $tglSelesai,
        'status' => $randStatus,
        'anggota' => $anggota // Array anggota lengkap
    ];
}

return array_merge($manualData, $generatedData);