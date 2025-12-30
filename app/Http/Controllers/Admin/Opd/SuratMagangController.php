<?php

namespace App\Http\Controllers\Admin\Opd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuratMagangController extends Controller
{
    // 1. Simulasi Login (Pindahkan ke sini agar konsisten dan mudah diubah)
    private $id_admin_login = 3; 

    // Helper untuk load data agar tidak menulis ulang path berkali-kali
    private function getSuratData()
    {
        $path = resource_path('data/surat_magang.php');
        return file_exists($path) ? include $path : [];
    }

    public function index()
    {
        $all_surat = $this->getSuratData();

        // 2. Filter Data sesuai Dinas yang login
        $list_surat = collect($all_surat)
                        ->where('id_dinas', $this->id_admin_login)
                        ->values();

        // Path view sudah selaras: admin.opd.surat-magang.index
        return view('admin.opd.surat-magang.index', compact('list_surat'));
    }

    public function detail($id)
    {
        $all_surat = $this->getSuratData();

        // 3. Cari Data dengan DUA SYARAT (Keamanan Data)
        $detail_surat = collect($all_surat)
                            ->where('id', $id)
                            ->where('id_dinas', $this->id_admin_login)
                            ->first();

        // Jika tidak ketemu (atau mencoba akses ID milik dinas lain lewat URL)
        if (!$detail_surat) {
            abort(404, 'Data surat tidak ditemukan atau Anda tidak memiliki akses.'); 
        }

        // Path view sudah selaras: admin.opd.surat-magang.detail
        return view('admin.opd.surat-magang.detail', [
            'peserta' => $detail_surat
        ]);
    }
}