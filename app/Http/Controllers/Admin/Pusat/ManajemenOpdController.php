<?php

namespace App\Http\Controllers\Admin\Pusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ManajemenOpdController extends Controller
{
    // ==========================================================
    // 1. METHOD INDEX (HALAMAN DAFTAR KARTU OPD)
    // ==========================================================
    public function index(Request $request)
    {
        // 1. Ambil Data Dummy
        $dataInstansi = include resource_path('data/instansi.php');
        $dataPeserta = include resource_path('data/peserta.php'); // Ambil data peserta

        // 2. Format Data Agar Lebih Mudah Dipakai di View
        $formattedData = [];

        foreach ($dataInstansi as $slug => $opd) {
            
            // A. Hitung Pembimbing (Berdasarkan jumlah bidang)
            $jumlahPembimbing = 0;
            if (isset($opd['bidang']) && is_array($opd['bidang'])) {
                $jumlahPembimbing = count($opd['bidang']);
            }

            // B. Hitung Peserta (Filter dari file peserta.php)
            $jumlahPeserta = count(array_filter($dataPeserta, function ($peserta) use ($slug) {
                return isset($peserta['instansi_slug']) && $peserta['instansi_slug'] == $slug;
            }));

            // Masukkan ke array baru
            $formattedData[] = [
                'slug' => $slug,
                'name' => $opd['name'],
                'singkatan' => $opd['singkatan'] ?? 'OPD',
                'jumlah_pembimbing' => $jumlahPembimbing,
                'jumlah_peserta' => $jumlahPeserta,
                'logo' => $opd['logo'] ?? null 
            ];
        }

        // 3. Fitur Search
        if ($request->has('search') && $request->search != null) {
            $keyword = strtolower($request->search);
            $formattedData = array_filter($formattedData, function ($item) use ($keyword) {
                return str_contains(strtolower($item['name']), $keyword) || 
                       str_contains(strtolower($item['singkatan']), $keyword);
            });
        }

        // 4. Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 9; 
        $currentItems = array_slice($formattedData, ($currentPage - 1) * $perPage, $perPage);
        
        $opd_list = new LengthAwarePaginator(
            $currentItems, 
            count($formattedData), 
            $perPage, 
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.pusat.manajemen-opd.index', compact('opd_list'));
    }

    // ==========================================================
    // 2. METHOD DETAIL (HALAMAN DETAIL OPD) - BARU DITAMBAHKAN
    // ==========================================================
    public function detail($slug)
    {
        // 1. Load Data Dummy
        $allInstansi = include resource_path('data/instansi.php');
        $allPeserta  = include resource_path('data/peserta.php');

        // 2. Cek apakah Slug (misal: 'kominfo') ada di file instansi.php
        if (!isset($allInstansi[$slug])) {
            abort(404, 'Data OPD tidak ditemukan');
        }

        // Ambil data spesifik dinas tersebut
        $opd = $allInstansi[$slug];

        // 3. Hitung Pembimbing (Jumlah Bidang)
        $jumlahPembimbing = 0;
        if (isset($opd['bidang']) && is_array($opd['bidang'])) {
            $jumlahPembimbing = count($opd['bidang']);
        }

        // 4. Hitung Peserta (Filter dari file peserta.php yang instansi_slug-nya cocok)
        $jumlahPeserta = count(array_filter($allPeserta, function ($p) use ($slug) {
            return isset($p['instansi_slug']) && $p['instansi_slug'] === $slug;
        }));

        // 5. Kirim data ke View Detail
        // Pastikan Anda sudah membuat file: resources/views/admin/pusat/manajemen-opd/detail.blade.php
        return view('admin.pusat.manajemen-opd.detail', compact('opd', 'jumlahPembimbing', 'jumlahPeserta'));
    }

    // ==========================================================
    // 3. METHOD CREATE (MENAMPILKAN FORM TAMBAH)
    // ==========================================================
    public function create()
    {
        return view('admin.pusat.manajemen-opd.create');
    }

    // ==========================================================
    // 4. METHOD STORE (MENYIMPAN DATA DUMMY)
    // ==========================================================
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 2. Simulasi Simpan Data (Karena pakai Dummy File, kita tidak bisa 'write' permanen ke file php)
        // Jadi kita hanya akan redirect kembali ke halaman index dengan pesan sukses.
        
        // Nanti jika sudah pakai DB:
        // User::create([...]);
        // Instansi::create([...]);

        // 3. Redirect dengan Pesan Sukses (Flash Message)
        return redirect()->route('pusat.manajemen-opd.index')
            ->with('success', 'OPD Baru telah berhasil ditambahkan');
    }
}