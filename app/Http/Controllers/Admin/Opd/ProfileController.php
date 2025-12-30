<?php

namespace App\Http\Controllers\Admin\Opd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // 1. Simulasi Login diletakkan di luar agar bisa diakses semua method
    private $id_admin_login = 3; 

    public function index()
    {
        // 2. Load Data Dummy
        $dataProfile    = $this->loadData('instansi.php');
        $dataPeserta    = $this->loadData('peserta.php');
        $dataPembimbing = $this->loadData('pembimbing.php');

        // MENCARI DATA: Cari di dalam array yang 'id'-nya sama dengan $this->id_admin_login
        $instansi = collect($dataProfile)->firstWhere('id', $this->id_admin_login);

        // 3. Fallback jika ID tidak ditemukan (agar tidak error)
        if (!$instansi) {
            $instansi = [
                'nama'            => 'Instansi Baru',
                'deskripsi'       => 'Deskripsi belum diisi.',
                'lokasi'          => '-',
                'telepon'         => '-',
                'jam'             => '-',
                'pendidikan'      => '-',
                'persyaratan'     => '-',
                'pembimbing'      => 0,
                'peserta'         => 0,
                'dokumentasi'     => [],
                'bidang'          => []
            ];
        }

        // ==========================================================
        // FITUR OTOMATIS: HITUNG JUMLAH PESERTA & PEMBIMBING
        // ==========================================================
        
        // Hitung peserta (Menggunakan 'id_dinas' sesuai file peserta.php)
        $jumlahPeserta = collect($dataPeserta)
                            ->where('id_dinas', $this->id_admin_login)
                            ->count();

        // Hitung pembimbing (PENTING: Menggunakan 'dinas_id' sesuai file pembimbing.php Anda)
        $jumlahPembimbing = collect($dataPembimbing)
                            ->where('id_dinas', $this->id_admin_login)
                            ->count();

        // Update data profile dengan hitungan terbaru
        $instansi['peserta'] = $jumlahPeserta;
        $instansi['pembimbing'] = $jumlahPembimbing;

        // ==========================================================

        // 4. Return ke jalur view yang baru
        return view('admin.opd.profile.index', [
            'instansi'    => $instansi,
            'gallery' => $instansi['gallery'] ?? [],
            'bidangs'     => $instansi['bidang'] ?? []
        ]);
    }

    // Helper Load Data
    private function loadData($filename)
    {
        // Tetap menggunakan 'data' huruf kecil agar aman di Linux/Server
        $path = resource_path("data/{$filename}");
        return file_exists($path) ? include $path : [];
    }
}