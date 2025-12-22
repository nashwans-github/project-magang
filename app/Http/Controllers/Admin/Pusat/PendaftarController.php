<?php

namespace App\Http\Controllers\Admin\Pusat; // 1. Namespace disesuaikan

use App\Http\Controllers\Controller; // 2. Import Controller Utama
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PendaftarController extends Controller // 3. Nama Class disesuaikan
{
    public function index(Request $request)
    {
        // ==========================================================
        // 1. AMBIL DATA DUMMY
        // ==========================================================
        // Pastikan file 'resources/data/pendaftar.php' sudah ada ya!
        // Jika belum ada, kode ini akan error.
        $allData = include resource_path('data/pendaftar.php');
        
        // ==========================================================
        // 2. LOGIKA SORTING (URUTKAN DARI YANG TERBARU)
        // ==========================================================
        usort($allData, function ($a, $b) {
            // Gabungkan tanggal dan waktu agar akurat (misal: "2025-09-14 08:00")
            $waktuA = $a['tanggal'] . ' ' . $a['waktu'];
            $waktuB = $b['tanggal'] . ' ' . $b['waktu'];

            // Bandingkan (B - A artinya Descending / Terbaru di atas)
            return strtotime($waktuB) - strtotime($waktuA);
        });

        // ==========================================================
        // 3. LOGIKA FILTER (Pencarian & Tanggal)
        // ==========================================================
        $filteredData = array_filter($allData, function ($item) use ($request) {
            $matchSearch = true;
            $matchDate = true;

            // A. Filter Search
            if ($request->has('search') && $request->search != null) {
                $keyword = strtolower($request->search);
                
                $nama = $item['nama'] ?? '';
                $email = $item['email'] ?? '';
                
                // Cari berdasarkan Nama atau Email
                $matchSearch = str_contains(strtolower($nama), $keyword) || 
                               str_contains(strtolower($email), $keyword);
            }

            // B. Filter Tanggal
            if ($request->has('date_filter') && $request->date_filter != null) {
                // Pastikan format tanggal di dummy sama dengan input date HTML (Y-m-d)
                $matchDate = $item['tanggal'] == $request->date_filter;
            }

            return $matchSearch && $matchDate;
        });

        // ==========================================================
        // 4. LOGIKA PAGINATION MANUAL
        // ==========================================================
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Menampilkan 10 data per halaman
        
        // Reset array keys agar pagination memotong data dengan benar
        $filteredData = array_values($filteredData);

        // Ambil data sesuai halaman saat ini
        $currentItems = array_slice($filteredData, ($currentPage - 1) * $perPage, $perPage);
        
        // Buat object Paginator
        $pendaftar = new LengthAwarePaginator(
            $currentItems, 
            count($filteredData), 
            $perPage, 
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // ==========================================================
        // 5. KIRIM KE VIEW
        // ==========================================================
        // Mengarah ke: resources/views/admin/pusat/pendaftar/index.blade.php
        return view('admin.pusat.pendaftar.index', compact('pendaftar'));
    }
}