<?php

namespace App\Http\Controllers\Admin\Pembimbing; // 1. Namespace Disesuaikan

use App\Http\Controllers\Controller; // 2. Import Controller Utama
use Illuminate\Http\Request;

class DashboardController extends Controller // 3. Nama Class Disesuaikan
{
    public function index(Request $request) 
    {
        // ======================================================
        // 1. SIMULASI LOGIN (AMBIL DARI URL)
        // ======================================================
        // Default: Dinas Kominfo, Bidang Aplikasi
        $slugInstansiSaya = $request->input('dinas', 'kominfo'); 
        $bidangSaya = $request->input('bidang', 'Aplikasi'); 

        // ======================================================
        // 2. LOAD SEMUA DATA DUMMY
        // ======================================================
        // Pastikan file dummy ada di resources/data/
        $allInstansi = include resource_path('data/instansi.php');
        $allPeserta  = include resource_path('data/peserta.php');
        $allSurat    = include resource_path('data/surat.php');
        $allProgres  = include resource_path('data/progres.php');
        $allPresensi = include resource_path('data/presensi.php');
        
        // Ambil Nama Instansi untuk Judul
        $namaInstansi = $allInstansi[$slugInstansiSaya]['name'] ?? 'Instansi Tidak Dikenal';

        // ======================================================
        // 3. LOGIKA FILTERING (Scope Data)
        // ======================================================
        $filterPunyaSaya = function($item) use ($slugInstansiSaya, $bidangSaya) {
            // 1. Cek Dinas
            $cekDinas = isset($item['instansi_slug']) && $item['instansi_slug'] === $slugInstansiSaya;
            
            // 2. Cek Bidang (Jika bukan 'semua' / Developer)
            $cekBidang = true;
            if ($bidangSaya !== 'semua') {
                $cekBidang = isset($item['bidang']) && $item['bidang'] === $bidangSaya;
            }

            return $cekDinas && $cekBidang;
        };

        // ======================================================
        // 4. HITUNG STATISTIK (WIDGET DASHBOARD)
        // ======================================================
        
        // A. TOTAL PESERTA
        $pesertaSaya = array_filter($allPeserta, $filterPunyaSaya);
        $totalPeserta = count($pesertaSaya);

        // B. PERMINTAAN SURAT (Status Pending)
        $totalSurat = count(array_filter($allSurat, function($s) use ($filterPunyaSaya) {
            return $filterPunyaSaya($s) && $s['status'] === 'pending';
        }));

        // C. PROGRES BELUM DINILAI (Status Pending)
        $totalProgres = count(array_filter($allProgres, function($p) use ($filterPunyaSaya) {
            return $filterPunyaSaya($p) && $p['status'] === 'pending';
        }));

        // D. PESERTA HADIR HARI INI
        $today = date('Y-m-d'); // Gunakan tanggal hari ini
        // $today = '2025-12-16'; // Uncomment untuk testing dummy
        
        $totalHadir = count(array_filter($allPresensi, function($absen) use ($filterPunyaSaya, $today) {
            $isPunyaSaya = $filterPunyaSaya($absen);
            $isHariIni   = isset($absen['tanggal']) && $absen['tanggal'] === $today;
            $isHadir     = in_array($absen['status'], ['Hadir', 'Terlambat', 'tepat_waktu']);

            return $isPunyaSaya && $isHariIni && $isHadir;
        }));

        // ======================================================
        // 5. ACTIVITY LOG DINAMIS
        // ======================================================
        $myPesertaIds = array_column($pesertaSaya, 'id');
        $activityList = [];

        // A. ACTIVITY PRESENSI
        foreach ($allPresensi as $p) {
            if (!isset($p['peserta_id'])) continue;
            if (($p['tanggal'] ?? '') !== $today) continue; // Hanya Hari Ini

            if (in_array($p['peserta_id'], $myPesertaIds)) {
                $status = $p['status'] ?? '';
                $statusValid = ['hadir', 'Hadir', 'terlambat', 'Terlambat', 'tepat_waktu'];

                if (in_array($status, $statusValid)) {
                    $thisPeserta = collect($pesertaSaya)->firstWhere('id', $p['peserta_id']);
                    $nama = $thisPeserta['nama'] ?? 'Peserta';
                    $jam = $p['jam_masuk'] ?? '07:00';

                    $activityList[] = [
                        'type' => 'presensi',
                        'nama' => $nama,
                        'peserta_id' => $p['peserta_id'],
                        'desc' => 'melakukan presensi masuk.',
                        'status' => $status,
                        'timestamp' => strtotime($today . ' ' . $jam),
                        'display_time' => "Hari ini, " . date('H.i', strtotime($jam)),
                        'color_bg' => 'bg-[#FBBF24]',
                        'icon' => 'presensi',
                        'time_ago' => "Hari ini, " . date('H.i', strtotime($jam)) // Tambahan field agar aman
                    ];
                }
            }
        }

        // B. ACTIVITY PROGRES
        foreach ($allProgres as $pr) {
            if (!isset($pr['peserta_id'])) continue;
            if (($pr['tanggal'] ?? '') !== $today) continue; // Hanya Hari Ini

            if (in_array($pr['peserta_id'], $myPesertaIds)) {
                $thisPeserta = collect($pesertaSaya)->firstWhere('id', $pr['peserta_id']);
                $nama = $thisPeserta['nama'] ?? 'Peserta';
                $jamSorting = '09:00'; 
                $judul = $pr['judul'] ?? 'Progres Baru'; 

                $activityList[] = [
                    'type' => 'progres',
                    'nama' => $nama,
                    'peserta_id' => $pr['peserta_id'],
                    'desc' => "mengunggah laporan '{$judul}'", 
                    'status' => 'upload',
                    'timestamp' => strtotime($today . ' ' . $jamSorting),
                    'display_time' => 'Hari ini', 
                    'color_bg' => 'bg-[#F97316]',
                    'icon' => 'progres',
                    'time_ago' => 'Hari ini' // Tambahan field agar aman
                ];
            }
        }

        // C. SORTING & LIMIT
        usort($activityList, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        $recentActivities = array_slice($activityList, 0, 6);

        // ======================================================
        // 6. KIRIM KE VIEW
        // ======================================================
        // Mengarah ke folder: resources/views/admin/pembimbing/dashboard/index.blade.php
        return view('admin.pembimbing.dashboard.index', compact(
            'namaInstansi',
            'bidangSaya',
            'totalPeserta',
            'totalSurat', 
            'totalHadir', 
            'totalProgres', 
            'recentActivities' 
        ));
    }
}