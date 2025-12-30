<?php

namespace App\Http\Controllers\Admin\Pembimbing; // 1. Namespace Baru

use App\Http\Controllers\Controller; // 2. Import Controller Induk
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class PresensiController extends Controller // 3. Nama Class Baru
{
    // ==================================================================
    // 1. FUNGSI INDEX (DAFTAR PRESENSI)
    // ==================================================================
    public function index(Request $request)
    {
        $slugInstansiSaya = $request->input('dinas', 'kominfo');
        $bidangSaya = $request->input('bidang', 'Aplikasi');
        $searchQuery = $request->input('search'); 

        // Pastikan path file dummy benar
        $allPeserta = include resource_path('data/peserta.php');
        $allPresensi = include resource_path('data/presensi.php');

        // Filter Peserta Milik Pembimbing
        $pesertaSaya = array_filter($allPeserta, function($p) use ($slugInstansiSaya, $bidangSaya) {
            $cekDinas = isset($p['instansi_slug']) && $p['instansi_slug'] === $slugInstansiSaya;
            
            $cekBidang = true;
            if ($bidangSaya !== 'semua') {
                $cekBidang = isset($p['bidang']) && $p['bidang'] === $bidangSaya;
            }
            return $cekDinas && $cekBidang;
        });

        // Setup Tanggal
        $defaultDate = Carbon::now()->format('Y-m-d');
        $tanggalDipilih = $request->input('date_filter', $defaultDate);
        
        Carbon::setLocale('id');
        $tanggalJudul = Carbon::parse($tanggalDipilih)->translatedFormat('d F Y');

        $presensiHarian = [];

        foreach ($pesertaSaya as $p) {
            
            // Logika Search
            if ($searchQuery && stripos($p['nama'], $searchQuery) === false) {
                continue; 
            }

            // Cari data presensi
            $dataAbsen = null;
            foreach ($allPresensi as $absen) {
                // Gunakan ID atau Nama sebagai kunci pencocokan (sesuaikan dengan struktur dummy)
                // Disini pakai nama_peserta sesuai dummy lama
                if ($absen['nama_peserta'] === $p['nama'] && ($absen['tanggal'] ?? '') === $tanggalDipilih) {
                    $dataAbsen = $absen;
                    break;
                }
            }

            if ($dataAbsen) {
                $dataAbsen['peserta_id'] = $p['id']; // Inject ID agar link detail bisa jalan
                $presensiHarian[] = $dataAbsen;
            } else {
                $presensiHarian[] = [
                    'id' => 'alpha_' . $p['id'],
                    'peserta_id' => $p['id'], // Inject ID
                    'nama_peserta' => $p['nama'],
                    'jam_masuk' => '-',
                    'status' => 'Tidak Hadir', // Atau 'alpha'
                    'bukti_foto' => null,
                    'keterangan' => 'Belum/tidak melakukan presensi'
                ];
            }
        }

        // Pagination Manual
        $perPage = 10;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $dataReset = array_values($presensiHarian);
        $dataSliced = array_slice($dataReset, $offset, $perPage);

        $presensiPaginated = new LengthAwarePaginator(
            $dataSliced,
            count($presensiHarian),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // View diarahkan ke folder: admin/pembimbing/presensi/index.blade.php
        return view('admin.pembimbing.presensi.index', compact(
            'presensiPaginated',
            'tanggalJudul',
            'tanggalDipilih'
        ));
    }


    // ==================================================================
    // 2. FUNGSI DETAIL
    // ==================================================================
    public function detail(Request $request)
    {
        Carbon::setLocale('id');

        // 1. TANGKAP ID
        $idPeserta = $request->input('id');

        if (!$idPeserta) {
            return redirect()->route('pembimbing.presensi.index')->with('error', 'ID peserta diperlukan.');
        }

        // 2. LOAD DATA
        $allPeserta  = include resource_path('data/peserta.php');
        $allPresensi = include resource_path('data/presensi.php');
        $allInstansi = include resource_path('data/instansi.php');

        // 3. CARI DATA PESERTA
        $peserta = collect($allPeserta)->firstWhere('id', $idPeserta);

        if (!$peserta) {
            abort(404, 'Peserta tidak ditemukan.');
        }

        // 4. CARI NAMA DINAS
        $slugDinas = $peserta['instansi_slug'];
        $namaDinas = $allInstansi[$slugDinas]['name'] ?? ucfirst(str_replace('-', ' ', $slugDinas));

        // 5. AMBIL SEMUA DATA HISTORY
        $namaPeserta = $peserta['nama']; 
        $historyCollection = collect($allPresensi)
                            ->where('nama_peserta', $namaPeserta)
                            ->sortByDesc('tanggal'); 

        // 6. HITUNG STATISTIK
        $totalHadir = $historyCollection->filter(function ($item) {
            return in_array($item['status'], ['tepat_waktu', 'terlambat', 'Hadir']);
        })->count();

        $totalTelat = $historyCollection->whereIn('status', ['terlambat', 'Terlambat'])->count();

        // 7. PAGINATION MANUAL
        $perPage = 5; 
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $dataAll = array_values($historyCollection->toArray());
        $dataSliced = array_slice($dataAll, $offset, $perPage);

        $history = new LengthAwarePaginator(
            $dataSliced,
            count($dataAll),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // View diarahkan ke folder: admin/pembimbing/presensi/detail.blade.php
        return view('admin.pembimbing.presensi.detail', compact(
            'peserta', 
            'history', 
            'totalHadir', 
            'totalTelat',
            'namaDinas'
        ));
    }
}