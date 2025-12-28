<?php

namespace App\Http\Controllers\Admin\Opd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // =================================================================
        // 0. SIMULASI LOGIN (KUNCI UTAMA)
        // =================================================================
        // Ubah angka ini jadi 1 (Kominfo) atau 2 (Dinkes)
        $id_admin_login = 3; 

        // =================================================================
        // 1. LOAD & FILTER DATA (HANYA MILIK DINAS YANG LOGIN)
        // =================================================================
        
        // A. Filter Data List (Pendaftar, Peserta, Surat, Pembimbing, Berita)
        // Kita gunakan helper function 'loadAndFilter' di bawah agar kodingan rapi
        $dataPendaftar  = $this->loadAndFilter('pemohon.php', $id_admin_login);
        $dataPeserta    = $this->loadAndFilter('peserta.php', $id_admin_login);
        $dataSurat      = $this->loadAndFilter('surat_magang.php', $id_admin_login);
        $dataPembimbing = $this->loadAndFilter('pembimbing.php', $id_admin_login);
        
        // Asumsi: Berita juga punya kolom 'id_dinas'. Jika belum ada, dia akan kosong.
        // Jika berita bersifat global (semua dinas lihat sama), pakai loadData biasa.
        $dataBerita     = $this->loadAndFilter('berita.php', $id_admin_login);

        // B. Filter Data Profile (Struktur Beda: Array Key)
        $rawProfile = $this->loadData('instansi.php');
        $dataProfile = $rawProfile[$id_admin_login] ?? []; 

        // =================================================================
        // 2. HITUNG STATISTIK (DARI DATA YANG SUDAH DI-FILTER)
        // =================================================================
        
        // A. Jumlah Peserta Aktif
        $jumlahPeserta = $dataPeserta->count();

        // B. Jumlah Pembimbing
        $jumlahPembimbing = $dataPembimbing->count();

        // C. Permohonan Magang (Verifikasi)
        $permohonan = [
            'menunggu' => $dataPendaftar->where('status', 'Menunggu Verifikasi')->count(),
            'diterima' => $dataPendaftar->where('status', 'Diterima')->count(),
            'ditolak'  => $dataPendaftar->where('status', 'Ditolak')->count(),
        ];

        // D. Permintaan Surat Magang
        // Ambil semua item 'dokumen' dari List Surat yang SUDAH di-filter dinasnya
        $allDokumen = $dataSurat->pluck('dokumen')->flatten(1);
        
        $surat = [
            // Hitung: TITLE 'diterima' + STATUS 'empty'
            'diterima' => $allDokumen->filter(function ($doc) {
                return str_contains(strtolower($doc['title']), 'diterima') && $doc['status'] == 'empty';
            })->count(),

            // Hitung: TITLE 'selesai' + STATUS 'empty'
            'selesai' => $allDokumen->filter(function ($doc) {
                return str_contains(strtolower($doc['title']), 'selesai') && $doc['status'] == 'empty';
            })->count(),
        ];

        // Gabungkan semua stats
        $stats = [
            'jumlah_peserta'    => $jumlahPeserta,
            'jumlah_pembimbing' => $jumlahPembimbing,
            'permohonan'        => $permohonan,
            'surat'             => $surat
        ];

        // =================================================================
        // 3. BERITA TERBARU (Milik Dinas Ini Saja)
        // =================================================================
        $allBerita = $dataBerita;

        // 4. AKTIVITAS TERBARU (Reset Setiap Hari)
        // =================================================================
        $activities = [];
        // Asumsi format tanggal di data Anda adalah "d F Y" (contoh: "28 December 2025")
        // Jika data menggunakan bahasa Indonesia (Desember), pastikan locale Carbon sudah sesuai
        $today = now()->translatedFormat('d F Y'); 

        // --- A. Ambil dari Data Verifikasi (Pendaftar Baru) ---
        $recentVerifikasi = $dataPendaftar->where('status', 'Menunggu Verifikasi')
                                        ->where('tanggal', $today);

        foreach($recentVerifikasi as $v) {
            $activities[] = [
                'user'   => $v['nama'],
                'action' => 'sedang menunggu verifikasi pendaftaran',
                'time'   => $v['tanggal'], 
                'icon'   => 'Verifikasi.svg', // Pastikan icon tersedia
                'theme'  => 'blue'
            ];
        }

        // --- B. Ambil dari Permintaan Surat Magang ---
        foreach($dataSurat as $s) {
            // Filter hanya surat yang tanggalnya hari ini
            if ($s['tanggal'] === $today) {
                foreach($s['dokumen'] as $doc) {
                    // Jika status 'empty', berarti ini adalah permintaan baru yang butuh direspon/upload
                    if ($doc['status'] === 'empty') {
                        $activities[] = [
                            'user'   => $s['nama'],
                            'action' => 'mengajukan permintaan ' . strtolower($doc['title']),
                            'time'   => $s['tanggal'],
                            'icon'   => 'PermintaanSurat.svg',
                            'theme'  => 'green'
                        ];
                    }
                }
            }
        }

        // --- C. Sorting & Fallback ---
        // Urutkan agar aktivitas terbaru muncul paling atas (opsional)
        $activities = collect($activities)->reverse()->values()->all();

        // Jika hari ini belum ada aktivitas sama sekali
        if (empty($activities)) {
            $activities[] = [
                'user'   => 'Sistem', 
                'action' => 'Belum ada aktivitas baru untuk hari ini.', 
                'time'   => $today, 
                'icon'   => 'Aktivitas1.svg', 
                'theme'  => 'yellow'
            ];
        }

        return view('admin.opd.dashboard.index', compact('stats', 'allBerita', 'activities'));
    }

    // =================================================================
    // HELPER FUNCTIONS
    // =================================================================

    // 1. Load Data Mentah dari File
    private function loadData($filename) {
        $path = resource_path("data/{$filename}"); 
        return file_exists($path) ? include $path : [];
    }

    // 2. Load Data DAN Langsung Filter by ID Dinas
    private function loadAndFilter($filename, $dinasId) {
        $rawData = $this->loadData($filename);
        
        // Pastikan hasilnya Collection agar enak diolah (count, where, dll)
        return collect($rawData)->where('id_dinas', $dinasId)->values();
    }
}