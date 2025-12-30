<?php

namespace App\Http\Controllers\Admin\Pembimbing; // 1. Namespace Baru

use App\Http\Controllers\Controller; // 2. Import Controller Induk
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class ProgresController extends Controller // 3. Nama Class Baru
{
    // ==================================================================
    // 1. FUNGSI INDEX (DAFTAR PROGRES HARIAN)
    // ==================================================================
    public function index(Request $request)
    {
        Carbon::setLocale('id'); // 🔥 Wajib agar Tanggal Indonesia

        $slugInstansiSaya = $request->input('dinas', 'kominfo');
        $bidangSaya = $request->input('bidang', 'Aplikasi');
        $searchQuery = $request->input('search'); 

        // Load Data Dummy
        $allPeserta = include resource_path('data/peserta.php');
        $allProgres = include resource_path('data/progres.php');

        // Filter Peserta di Instansi & Bidang Saya
        $pesertaSaya = array_filter($allPeserta, function($p) use ($slugInstansiSaya, $bidangSaya) {
            $cekDinas = isset($p['instansi_slug']) && $p['instansi_slug'] === $slugInstansiSaya;
            
            $cekBidang = true;
            if ($bidangSaya !== 'semua') {
                $cekBidang = isset($p['bidang']) && $p['bidang'] === $bidangSaya;
            }
            return $cekDinas && $cekBidang;
        });

        // Buat Mapping Nama -> ID (Untuk link detail)
        // Gunanya agar kita bisa inject ID ke data progres
        $namaPesertaSaya = array_column($pesertaSaya, 'nama');
        $mapPesertaId = array_column($pesertaSaya, 'id', 'nama');

        // Setup Tanggal Filter
        $defaultDate = Carbon::now()->format('Y-m-d');
        $tanggalDipilih = $request->input('date_filter', $defaultDate);
        
        $tanggalJudul = Carbon::parse($tanggalDipilih)->translatedFormat('d F Y');

        // Filter Data Progres
        $progresHarian = [];
        foreach ($allProgres as $prog) {
            // Cek apakah progres milik peserta saya
            if (!in_array($prog['nama_peserta'], $namaPesertaSaya)) continue;
            
            // Cek Tanggal (Jika filternya aktif)
            // Di dummy mungkin tanggalnya string biasa, jadi kita samakan formatnya
            if (($prog['tanggal'] ?? '') !== $tanggalDipilih) continue;
            
            // Cek Search
            if ($searchQuery && stripos($prog['nama_peserta'], $searchQuery) === false) continue;

            // Inject ID Peserta ke array progres agar link detail bisa diklik
            $prog['peserta_id'] = $mapPesertaId[$prog['nama_peserta']] ?? null;
            
            $progresHarian[] = $prog;
        }

        // Pagination Manual
        $perPage = 10;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $dataReset = array_values($progresHarian); // Reset index array
        $dataSliced = array_slice($dataReset, $offset, $perPage);

        $progresPaginated = new LengthAwarePaginator(
            $dataSliced,
            count($progresHarian),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // View diarahkan ke: admin/pembimbing/progres/index.blade.php
        return view('admin.pembimbing.progres.index', compact(
            'progresPaginated', 
            'tanggalJudul', 
            'tanggalDipilih'
        ));
    }

    // ==================================================================
    // 2. FUNGSI DETAIL (RIWAYAT PROGRES PER ORANG)
    // ==================================================================
    public function detail(Request $request)
    {
        Carbon::setLocale('id'); // 🔥 Wajib agar Tanggal Indonesia

        // Ambil ID dari URL (?id=peserta1)
        $idPeserta = $request->input('id');
        
        // Jika tidak ada ID, tendang balik ke index
        if (!$idPeserta) return redirect()->route('pembimbing.progres.index');

        // Load Data Lagi
        $allPeserta  = include resource_path('data/peserta.php');
        $allProgres  = include resource_path('data/progres.php');
        $allInstansi = include resource_path('data/instansi.php');

        // Cari Data Peserta berdasarkan ID
        $peserta = collect($allPeserta)->firstWhere('id', $idPeserta);
        if (!$peserta) abort(404, 'Peserta tidak ditemukan.');

        // Cari Nama Dinas (Untuk Profil Header)
        $slugDinas = $peserta['instansi_slug'];
        $namaDinas = $allInstansi[$slugDinas]['name'] ?? ucfirst(str_replace('-', ' ', $slugDinas));

        // Filter History Progres milik Peserta Tersebut
        $historyCollection = collect($allProgres)
                            ->where('nama_peserta', $peserta['nama'])
                            ->sortByDesc('tanggal'); 

        // Hitung Statistik Sederhana
        $totalSelesai = $historyCollection->whereIn('status', ['approved', 'disetujui'])->count();
        $totalRevisi  = $historyCollection->where('status', 'revisi')->count();

        // Pagination untuk History
        $perPage = 5;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $dataAll = array_values($historyCollection->toArray()); // Reset keys
        $dataSliced = array_slice($dataAll, $offset, $perPage);

        $history = new LengthAwarePaginator(
            $dataSliced,
            count($dataAll),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // View diarahkan ke: admin/pembimbing/progres/detail.blade.php
        return view('admin.pembimbing.progres.detail', compact(
            'peserta', 
            'history', 
            'totalSelesai', 
            'totalRevisi', 
            'namaDinas'
        ));
    }

    // ==================================================================
    // 3. FUNGSI UPDATE STATUS (SIMULASI AJAX)
    // ==================================================================
    // Nanti dipakai kalau sudah masuk bab Detail (Edit Status)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'catatan' => 'nullable|string'
        ]);

        return response()->json([
            'message' => 'Status berhasil diperbarui (Simulasi)',
            'data' => [
                'id' => $id,
                'status' => $request->status,
                'catatan' => $request->catatan
            ]
        ]);
    }
}