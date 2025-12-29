<?php

// resources/data/surat.php

// 1. DATA MANUAL (Fixed Syntax)
$manualData = [
    [
        'id' => 'surat1',
        'nama' => 'Nashwan Bima Andika',
        'jenis' => 's-terima', // Slug: s-terima / s-selesai
        'instansi_slug' => 'kominfo', // Typo fixed: isntansi -> instansi
        'bidang' => 'Website',        // Key disamakan dengan controller ('bidang')
        'tgl_request' => '2025-09-01', // Sebaiknya pakai underscore tgl_request
        'status' => 'disetujui' // Tidak dihitung (karena bukan pending)
    ],
    [
        'id' => 'surat2',
        'nama' => 'Vanezza Brilliance',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Media Sosial',
        'jenis' => 's-terima',
        'tgl_request' => '2025-09-12',
        'status' => 'disetujui'
    ],
    [
        'id' => 'surat3',
        'nama' => 'Hildan Abiansyah',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Aplikasi',
        'jenis' => 's-terima',
        'tgl_request' => '2025-09-12',
        'status' => 'disetujui'
    ],
    // Contoh Pending Manual (Biar muncul angka 1 di dashboard Aplikasi)
    [
        'id' => 'surat4_manual',
        'nama' => 'Hildan Abiansyah',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Aplikasi',
        'jenis' => 's-selesai',
        'tgl_request' => '2025-12-20',
        'status' => 'pending' 
    ],
    [
        'id' => 'surat5',
        'nama' => 'Wildan Galih Ramadhan',
        'instansi_slug' => 'dinas-perhubungan',
        'bidang' => 'Jaringan',
        'jenis' => 's-terima',
        'tgl_request' => '2025-09-12',
        'status' => 'disetujui'
    ],
];

// 2. GENERATOR OTOMATIS
$generatedData = [];
$jumlah_dummy = 50; // Jumlah surat dummy tambahan

// Bank Data
$firstNames = ['Aditya', 'Bayu', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gita', 'Hana', 'Indra', 'Joko', 'Kiki', 'Lina'];
$lastNames = ['Saputra', 'Wijaya', 'Nugroho', 'Pratama', 'Santoso', 'Hidayat', 'Ramadhan', 'Kusuma'];

$slugList = [
    'kominfo', 'dinas-pendidikan', 'dinas-kesehatan', 'dinas-perhubungan',
    'dinas-sosial', 'dinas-kependudukan'
];

$bidangList = ['Website', 'Jaringan', 'Aplikasi', 'Sosial Media', 'Desain', 'Administrasi', 'Data Sains', 'BLC'];

$jenisList = ['s-terima', 's-selesai'];
$statusList = ['pending', 'pending', 'disetujui', 'disetujui', 'ditolak']; // Pending diperbanyak agar sering muncul

for ($i = 1; $i <= $jumlah_dummy; $i++) {
    
    // Generate Data Random
    $randName = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
    $randSlug = $slugList[array_rand($slugList)];
    $randBidang = $bidangList[array_rand($bidangList)];
    $randJenis = $jenisList[array_rand($jenisList)];
    $randStatus = $statusList[array_rand($statusList)];
    
    // Generate Tanggal Acak (3 bulan terakhir)
    $randTime = strtotime("-" . rand(1, 90) . " days");
    $randDate = date('Y-m-d', $randTime);

    $generatedData[] = [
        'id' => 'dummy_surat_' . $i,
        'nama' => $randName,
        'jenis' => $randJenis,
        'instansi_slug' => $randSlug,
        'bidang' => $randBidang, // Konsisten pakai 'bidang'
        'tgl_request' => $randDate,
        'status' => $randStatus
    ];
}

// 3. Gabungkan Data
return array_merge($manualData, $generatedData);