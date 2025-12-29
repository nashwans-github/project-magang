<?php

namespace App\Http\Controllers\Admin\Pusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. LOAD SEMUA DATA DUMMY
        $dataInstansi  = include resource_path('data/instansi.php');
        $dataPendaftar = include resource_path('data/pendaftar.php'); 
        $dataPemohon   = include resource_path('data/pemohon.php');   
        $dataPeserta   = include resource_path('data/peserta.php');   

        // 2. HITUNG WIDGET (STATS KOTAK ATAS)
        $totalOpd       = count($dataInstansi);
        $totalPendaftar = count($dataPendaftar); 
        $totalPemohon   = count($dataPemohon); 
        $totalPeserta   = count($dataPeserta); 

        // 3. LOGIC GRAFIK VERTIKAL (PEMOHON PER DINAS)
        $data_pendaftar = []; 
        $highestValue = 0; 

        foreach ($dataInstansi as $opd) {
            // Filter berdasarkan id_dinas (sesuai data dummy pemohon)
            $jumPemohon = count(array_filter($dataPemohon, function ($p) use ($opd) {
                return isset($p['id_dinas']) && $p['id_dinas'] === $opd['id'];
            }));
            
            $data_pendaftar[] = [
                'singkatan' => $opd['singkatan'] ?? ($opd['name'] ?? 'Tanpa Nama'), 
                'jumlah' => $jumPemohon
            ];

            if ($jumPemohon > $highestValue) {
                $highestValue = $jumPemohon;
            }
        }

       // 4. DATA GRAFIK HORIZONTAL (PESERTA PER DINAS)
    $chartData = [];
    foreach ($dataInstansi as $opd) {
        $jumPeserta = count(array_filter($dataPeserta, function ($p) use ($opd) {
            // PERBAIKAN: Cek id_dinas, jika tidak ada cek instansi_slug
            if (isset($p['id_dinas'])) {
                return $p['id_dinas'] === $opd['id'];
            }
            if (isset($p['instansi_slug'])) {
                return $p['instansi_slug'] === $opd['slug'];
            }
            return false;
        }));

    $chartData[] = [
        'name'  => $opd['name'],
        'slug'  => $opd['slug'] ?? '',
        'count' => $jumPeserta 
    ];

    // Update highest value untuk skala
    if ($jumPeserta > $highestValue) {
        $highestValue = $jumPeserta;
    }
}
        // 5. LOGIC SKALA DINAMIS
        if ($highestValue <= 10) {
            $maxScale = 10;
            $stepSize = 2; 
        } elseif ($highestValue <= 25) {
            $maxScale = 25;
            $stepSize = 5; 
        } elseif ($highestValue <= 50) {
            $maxScale = 50;
            $stepSize = 10; 
        } else {
            $maxScale = (ceil($highestValue / 20) * 20); // Skala dinamis kelipatan 20
            $stepSize = $maxScale / 5;
        }

        return view('admin.pusat.dashboard.index', compact(
            'totalOpd', 'totalPendaftar', 'totalPemohon', 'totalPeserta', 
            'data_pendaftar', 'maxScale', 'stepSize', 'chartData'
        ));
    }
}