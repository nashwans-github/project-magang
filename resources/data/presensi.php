<?php

// resources/data/presensi.php

$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime("-1 days"));
$twoDaysAgo = date('Y-m-d', strtotime("-2 days"));

$manualData = [
    // ----------------------------------------------------------------------
    // 1. DATA HARI INI
    // ----------------------------------------------------------------------
    [
        'id' => 'presensi_1',
        'peserta_id' => 'peserta1', // FIX: ID String sesuai peserta.php
        'nama_peserta' => 'Nashwan Bima Andika',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Website',
        'tanggal' => $today, 
        'jam_masuk' => '08:42', 
        'status' => 'terlambat', 
        'bukti_foto' => 'selfie_nashwan_today.jpg', 
        'keterangan' => '-'
    ],
    [
        'id' => 'presensi_2',
        'peserta_id' => 'peserta2', // FIX: ID String
        'nama_peserta' => 'Vanezza Brilliance',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Website',
        'tanggal' => $today,
        'jam_masuk' => null, 
        'status' => 'izin', 
        'bukti_foto' => 'surat_dokter.pdf', 
        'keterangan' => 'Urusan Keluarga'
    ],
    [
        'id' => 'presensi_3',
        'peserta_id' => 'peserta3', // FIX: ID String
        'nama_peserta' => 'Hildan Abiansyah', // Perbaikan Nama Peserta (Hildan itu peserta3)
        'instansi_slug' => 'kominfo',
        'bidang' => 'Aplikasi',
        'tanggal' => $today,
        'jam_masuk' => '09:01', 
        'status' => 'terlambat', 
        'bukti_foto' => 'selfie_macet.png', 
        'keterangan' => 'Terjebak macet'
    ],

    // ----------------------------------------------------------------------
    // 2. DATA HISTORY (Masa Lalu)
    // ----------------------------------------------------------------------
    [
        'id' => 'hist_nashwan_1',
        'peserta_id' => 'peserta1', // <--- SEBELUMNYA '1', SEKARANG JADI 'peserta1'
        'nama_peserta' => 'Nashwan Bima Andika',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Website',
        'tanggal' => $yesterday,
        'jam_masuk' => '08:45', 
        'status' => 'terlambat',
        'bukti_foto' => 'surat_izin_old.pdf', 
        'keterangan' => 'Ban bocor'
    ],
    [
        'id' => 'hist_nashwan_2',
        'peserta_id' => 'peserta1', // <--- SEBELUMNYA '1', SEKARANG JADI 'peserta1'
        'nama_peserta' => 'Nashwan Bima Andika',
        'instansi_slug' => 'kominfo',
        'bidang' => 'Website',
        'tanggal' => $twoDaysAgo,
        'jam_masuk' => '08:05', 
        'status' => 'tepat_waktu',
        'bukti_foto' => 'bukti_old2.jpg',
        'keterangan' => '-'
    ],
];

// 3. GENERATOR OTOMATIS
$generatedData = [];
$jumlah_dummy = 50; 
$names = ['Aditya', 'Bayu', 'Citra', 'Dewi', 'Eko'];
$slugList = ['kominfo', 'dinas-pendidikan'];
$bidangList = ['Website', 'Jaringan'];
$extList = ['.jpg', '.jpeg', '.png', '.pdf']; 

for ($i = 1; $i <= $jumlah_dummy; $i++) {
    $randName = $names[array_rand($names)] . ' Dummy';
    $randSlug = $slugList[array_rand($slugList)];
    $randBidang = $bidangList[array_rand($bidangList)];
    $randExt = $extList[array_rand($extList)]; 
    
    $isToday = rand(0, 1); 
    $tanggal = $isToday ? $today : date('Y-m-d', strtotime("-" . rand(1, 30) . " days"));
    
    $scenario = rand(1, 10);
    if ($scenario <= 6) { 
        $jamMasuk = "08:15:00"; $status = 'tepat_waktu'; $ket = '-';
    } elseif ($scenario <= 8) {
        $jamMasuk = "08:45:00"; $status = 'terlambat'; $ket = 'Telat';
    } else {
        $jamMasuk = null; $status = 'izin'; $ket = 'Sakit';
    }

    $generatedData[] = [
        'id' => 'dummy_presensi_' . $i,
        'peserta_id' => 'peserta_dummy_' . rand(10, 99), // ID Dummy juga string
        'nama_peserta' => $randName,
        'instansi_slug' => $randSlug,
        'bidang' => $randBidang,
        'tanggal' => $tanggal,
        'jam_masuk' => $jamMasuk,
        'status' => $status,
        'bukti_foto' => 'dummy_file_' . rand(100, 999) . $randExt,
        'keterangan' => $ket
    ];
}

return array_merge($manualData, $generatedData);