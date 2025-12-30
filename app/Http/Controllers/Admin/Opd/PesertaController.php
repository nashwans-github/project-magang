<?php

namespace App\Http\Controllers\Admin\Opd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // 1. Simulasi ID Dinas login (Kunci utama filter)
    private $id_admin_login = 3; 

    private function getData()
    {
        // Pastikan folder 'data' huruf kecil, konsisten dengan controller lain
        $path = resource_path('data/peserta.php');
        return file_exists($path) ? include $path : [];
    }

    public function index()
    {
        $allPeserta = $this->getData();

        // 2. Filter menggunakan 'id_dinas' (sudah sesuai dengan data murni kita)
        $peserta = collect($allPeserta)
                    ->where('id_dinas', $this->id_admin_login)
                    ->values();

        // 3. View path sudah benar (admin.opd.peserta.index)
        return view('admin.opd.peserta.index', compact('peserta'));
    }

    public function show($id)
    {
        $allPeserta = $this->getData();
        
        // Mencari detail peserta berdasarkan ID
        $peserta = collect($allPeserta)->firstWhere('id', $id);

        if (!$peserta) {
            abort(404, 'Data peserta tidak ditemukan');
        }

        // View path sudah benar (admin.opd.peserta.detail)
        return view('admin.opd.peserta.detail', compact('peserta'));
    }
}