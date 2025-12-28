<?php

namespace App\Http\Controllers\Admin\Opd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    // 1. Properti Simulasi Login
    private $id_admin_login = 3; 

    // 2. Helper getData (Diselaraskan ke file pemohon.php)
    private function getData()
    {
        // Menggunakan 'data' (kecil) dan 'pemohon.php' agar sinkron dengan Dashboard
        $path = resource_path('data/pemohon.php');
        return file_exists($path) ? include $path : [];
    }

    public function index()
    {
        $allData = $this->getData();

        // 3. Filter Data Sesuai Dinas
        $applicants = collect($allData)
                        ->where('id_dinas', $this->id_admin_login);

        // 4. Hitung Statistik untuk Badge/Tab
        $stats = [
            'menunggu' => $applicants->where('status', 'Menunggu Verifikasi')->count(),
            'diterima' => $applicants->where('status', 'Diterima')->count(),
            'ditolak'  => $applicants->where('status', 'Ditolak')->count(),
        ];

        // 5. SORTING DATA (Menunggu -> Diterima -> Ditolak)
        $priority = [
            'Menunggu Verifikasi' => 1,
            'Diterima' => 2,
            'Ditolak'  => 3,
        ];

        $sortedApplicants = $applicants->sortBy(function ($item) use ($priority) {
            return $priority[$item['status']] ?? 999;
        })->values();

        // 6. Return ke path view yang baru
        return view('admin.opd.verifikasi.index', [
            'applicants' => $sortedApplicants,
            'stats' => $stats
        ]);
    }

    public function show($id)
    {
        $allData = $this->getData();

        // Cari detail dengan proteksi id_dinas
        $applicant = collect($allData)
                        ->where('id', $id)
                        ->where('id_dinas', $this->id_admin_login)
                        ->first();

        if (!$applicant) {
            abort(404, 'Data pemohon tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Return ke path view yang baru
        return view('admin.opd.verifikasi.detail', compact('applicant'));
    }
}