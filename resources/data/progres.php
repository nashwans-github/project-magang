<?php

// resources/data/progres.php

$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime("-1 days"));
$twoDaysAgo = date('Y-m-d', strtotime("-2 days"));

// --------------------------------------------------------------------------
// 1. DATA MANUAL (Statik)
// --------------------------------------------------------------------------
$manualData = [
    [
        'id' => 1,
        'peserta_id' => 'peserta1', // <--- UBAH JADI STRING
        'nama_peserta' => 'Nashwan Bima Andika',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Website',
        'judul' => 'Merancang ERD (Format PDF)',
        'file' => 'erd_v1.pdf',
        'tanggal' => $twoDaysAgo,
        'status' => 'approved', 
        'catatan' => 'Struktur database sudah benar.'
    ],
    [
        'id' => 2,
        'peserta_id' => 'peserta2', // <--- UBAH JADI STRING
        'nama_peserta' => 'Vanezza Brilliance',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Website',
        'judul' => 'Desain Mockup UI (Format Gambar)',
        'file' => 'mockup_home.png',
        'tanggal' => $today,
        'status' => 'revisi', 
        'catatan' => 'Warna header terlalu kontras, tolong perbaiki.'
    ],
    [
        'id' => 3,
        'peserta_id' => 'peserta3', // <--- UBAH JADI STRING
        'nama_peserta' => 'Hildan Abiansyah', // Hildan itu peserta3
        'instansi_slug' => 'kominfo',
        'bidang' => 'Aplikasi',
        'judul' => 'Query Database',
        'file' => 'query_db.sql',
        'tanggal' => $today,
        'status' => 'pending', 
        'catatan' => '-'
    ],
    [
        'id' => 4,
        'peserta_id' => 'peserta1', // <--- UBAH JADI STRING
        'nama_peserta' => 'Nashwan Bima Andika',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Website',
        'judul' => 'Screenshot Dashboard Admin',
        'file' => 'dash_admin.jpg',
        'tanggal' => $today,
        'status' => 'pending', 
        'catatan' => '-'
    ],
    [
        'id' => 5,
        'peserta_id' => 'peserta3', // <--- UBAH JADI STRING
        'nama_peserta' => 'Hildan Abiansyah',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Aplikasi',
        'judul' => 'Laporan Akhir Bab 1',
        'file' => 'laporan_bab1.docx',
        'tanggal' => $today,
        'status' => 'pending', 
        'catatan' => '-'
    ],
];

// --------------------------------------------------------------------------
// 2. GENERATOR OTOMATIS
// --------------------------------------------------------------------------
$generatedData = [];
$jumlah_dummy = 50; 
$names = ['Aditya', 'Bayu', 'Citra', 'Dewi', 'Eko'];
$slugList = ['kominfo', 'dinas-pendidikan'];
$bidangList = ['Website', 'Jaringan'];
$extList = ['.pdf', '.jpg', '.png']; 

for ($i = 1; $i <= $jumlah_dummy; $i++) {
    $randName = $names[array_rand($names)] . ' Dummy';
    $randSlug = $slugList[array_rand($slugList)];
    $randBidang = $bidangList[array_rand($bidangList)];
    
    $generatedData[] = [
        'id' => 'dummy_progres_' . $i,
        'peserta_id' => 'peserta_dummy_' . rand(10, 99), // ID String
        'nama_peserta' => $randName,
        'instansi_slug' => $randSlug,
        'bidang' => $randBidang,
        'judul' => 'Laporan Progres Harian',
        'file' => 'file_dummy.pdf',
        'tanggal' => date('Y-m-d', strtotime("-" . rand(0, 30) . " days")),
        'status' => 'pending',
        'catatan' => '-'
    ];
}

return array_merge($manualData, $generatedData);