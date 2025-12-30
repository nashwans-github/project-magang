<?php

// File: resources/Data/berita.php

return [
    [
        'id' => 1,
        'id_dinas' => 3,
        'judul' => 'Selamat Datang di Portal Magang Surabaya',
        'file_path' => 'pinturimba.png', // Pastikan file ini ada di public/images/berita/
        'tanggal' => '2025-12-02', // Format YYYY-MM-DD
    ],
    [
        'id' => 2,
        'id_dinas' => 3,
        'judul' => 'Jadwal Libur Idul Fitri 1445 H',
        'file_path' => 'camparea.png', // Simulasi tanpa gambar (akan muncul placeholder)
        'tanggal' => '2025-12-25', // Format YYYY-MM-DD
    ],
    [
        'id' => 3,
        'id_dinas' => 3,
        'judul' => 'Pengumuman Penting: Batas Akhir Laporan',
        'file_path' => 'puncak.png',
        'tanggal' => '2025-11-25', // Format YYYY-MM-DD
    ],

    [
        'id' => 4,
        'id_dinas' => 2, // Milik Dinas Kesehatan (Simulasi filter)
        'judul' => 'Penyuluhan Kesehatan Masyarakat',
        'file_path' => 'puncak.png',
        'tanggal' => '2025-11-25', 
    ],
];