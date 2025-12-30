<?php

namespace App\Http\Controllers\Admin\Pusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ManajemenOpdController extends Controller
{
    public function index(Request $request)
    {
        $dataInstansi = include resource_path('data/instansi.php');
        $dataPeserta = include resource_path('data/peserta.php'); // Gunakan data peserta asli

        $formattedData = [];
        foreach ($dataInstansi as $slug => $opd) {
            // Hitung jumlah orang yang instansi_slug-nya cocok
            $jumlahPeserta = count(array_filter($dataPeserta, function ($p) use ($slug) {
                return isset($p['instansi_slug']) && $p['instansi_slug'] == $slug;
            }));

            $formattedData[] = [
                'slug' => $slug,
                'name' => $opd['name'],
                'singkatan' => $opd['singkatan'] ?? 'OPD',
                'jumlah_pembimbing' => count($opd['bidang'] ?? []),
                'jumlah_peserta' => $jumlahPeserta,
                'logo' => $opd['logo'] ?? null 
            ];
        }

        // Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 9;
        $opd_list = new LengthAwarePaginator(
            array_slice($formattedData, ($currentPage - 1) * $perPage, $perPage),
            count($formattedData), $perPage, $currentPage, ['path' => $request->url()]
        );

        return view('admin.pusat.manajemen-opd.index', compact('opd_list'));
    }

    public function detail($slug)
   {
    $allInstansi = include resource_path('data/instansi.php');
    $allPeserta  = include resource_path('data/peserta.php');

    if (!isset($allInstansi[$slug])) abort(404);

    $opd = $allInstansi[$slug];
    
    // HITUNG ULANG DISINI AGAR BISA TAMPIL DI DETAIL
    $jumlahPeserta = count(array_filter($allPeserta, fn($p) => ($p['instansi_slug'] ?? '') == $slug));
    $jumlahPembimbing = count($opd['bidang'] ?? []); // <--- Tambahkan Baris Ini

    return view('admin.pusat.manajemen-opd.detail', compact('opd', 'jumlahPeserta', 'jumlahPembimbing')); // <--- Kirim variabelnya
   }
}