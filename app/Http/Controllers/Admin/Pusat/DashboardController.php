<?php

namespace App\Http\Controllers\Admin\Pusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. LOAD SEMUA DATA DUMMY
        // ==========================================
        $dataInstansi = include resource_path('data/instansi.php');
        $dataPeserta  = include resource_path('data/peserta.php'); // Data Peserta Aktif
        $dataPemohon  = include resource_path('data/pemohon.php'); // Data Pemohon (Baru)
        $dataPendaftar = include resource_path('data/pendaftar.php'); // Data Pendaftar (Akun User)

        // ==========================================
        // 2. HITUNG WIDGET (STATS KOTAK ATAS)
        // ==========================================
        
        // A. Jumlah OPD
        $totalOpd = count($dataInstansi);

        // B. Jumlah Pendaftar (User Akun)
        $totalPendaftar = count($dataPendaftar); 
        
        // C. Jumlah Peserta Aktif
        $totalPeserta = count($dataPeserta); 

        // D. Jumlah Pemohon (Total Proposal)
        $totalPemohon = count($dataPemohon); 


        // ==========================================================
        // 3. LOGIC GRAFIK VERTIKAL (PEMOHON PER DINAS)
        // ==========================================================
        $data_pendaftar = []; 
        $highestPemohon = 0;

        foreach ($dataInstansi as $slug => $opd) {
            // Hitung pemohon per dinas
            $jumPemohon = count(array_filter($dataPemohon, function ($p) use ($slug) {
                return isset($p['dinas_tujuan']) && $p['dinas_tujuan'] === $slug;
            }));
            
            $data_pendaftar[] = [
                'singkatan' => $opd['singkatan'] ?? $opd['name'], 
                'jumlah' => $jumPemohon
            ];

            if ($jumPemohon > $highestPemohon) {
                $highestPemohon = $jumPemohon;
            }
        }

        // Logic Skala & Grid Dinamis (Sesuai request)
        $max_scale = 100;
        $step_size = 10;

        if ($highestPemohon <= 10) {
            $max_scale = 10;
            $step_size = 2; 
        } elseif ($highestPemohon <= 25) {
            $max_scale = 25;
            $step_size = 5; 
        } elseif ($highestPemohon <= 50) {
            $max_scale = 50;
            $step_size = 10; 
        }

        
        // ==========================================================
        // 4. LOGIC GRAFIK HORIZONTAL (PESERTA AKTIF PER DINAS)
        // ==========================================================
        $chartData = [];
        $highestPeserta = 0;

        foreach ($dataInstansi as $slug => $opd) {
            // Hitung peserta aktif per dinas
            $jumPeserta = count(array_filter($dataPeserta, function ($p) use ($slug) {
                return isset($p['instansi_slug']) && $p['instansi_slug'] === $slug;
            }));

            $chartData[] = [
                'name' => $opd['name'],
                'slug' => $slug,
                'count' => $jumPeserta 
            ];

            if ($jumPeserta > $highestPeserta) {
                $highestPeserta = $jumPeserta;
            }
        }
        
        // Skala grafik horizontal (Bisa dibuat dinamis juga kalau mau)
        // Untuk sekarang kita set fix 50 atau mengikuti tertinggi
        $maxScale = 100;


        // ==========================================
        // 5. KIRIM SEMUA KE VIEW
        // ==========================================
        return view('admin.pusat.dashboard.index', compact(
            // Data Stats
            'totalOpd', 
            'totalPendaftar', 
            'totalPeserta', 
            'totalPemohon', 
            
            // Data Grafik Vertikal (Pemohon)
            'data_pendaftar', 'max_scale', 'step_size', // <--- Koma (,) di sini PENTING

            // Data Grafik Horizontal (Peserta)
            'chartData', 'maxScale'
        ));
    }
}