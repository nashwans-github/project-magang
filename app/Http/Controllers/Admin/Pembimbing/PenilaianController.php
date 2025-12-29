<?php

namespace App\Http\Controllers\Admin\Pembimbing; // 1. Namespace Baru

use App\Http\Controllers\Controller; // 2. Import Controller Induk
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PenilaianController extends Controller // 3. Nama Class Baru
{
    // ==================================================================
    // 1. INDEX (WRAPPER UTAMA & TABEL)
    // ==================================================================
    public function index(Request $request)
    {
        $slugInstansiSaya = $request->input('dinas', 'kominfo');
        $bidangSaya = $request->input('bidang', 'Aplikasi');
        $searchQuery = $request->input('search');

        // Load Data Dummy
        // Pastikan file-file ini ada di folder resources/data/
        $allPeserta = include resource_path('data/peserta.php');
        $allPenilaian = include resource_path('data/penilaian.php');

        // 1. Filter Peserta (Instansi & Bidang)
        $pesertaSaya = array_filter($allPeserta, function($p) use ($slugInstansiSaya, $bidangSaya) {
            $cekDinas = isset($p['instansi_slug']) && $p['instansi_slug'] === $slugInstansiSaya;
            
            $cekBidang = true;
            if ($bidangSaya !== 'semua') {
                $cekBidang = isset($p['bidang']) && $p['bidang'] === $bidangSaya;
            }
            
            // Hanya peserta AKTIF yang dinilai (Opsional)
            $cekAktif = isset($p['status_keaktifan']) && $p['status_keaktifan'] === 'Aktif';
            
            return $cekDinas && $cekBidang && $cekAktif;
        });

        // 2. Olah Data untuk Tabel (Hitung Rata-Rata)
        $dataTabel = [];
        foreach ($pesertaSaya as $p) {
            // Filter Pencarian Nama
            if ($searchQuery && stripos($p['nama'], $searchQuery) === false) continue;

            // Cari Nilai Peserta Ini
            $nilai = collect($allPenilaian)->firstWhere('nama_peserta', $p['nama']);
            
            $rataPresensi = 0; $rataProgres = 0; $nilaiAkhir = 0;

            if ($nilai) {
                // Hitung Rata-Rata Presensi (2 Aspek)
                $np = $nilai['nilai_presensi'];
                $rataPresensi = ($np['kehadiran'] + $np['ketepatan_waktu']) / 2;

                // Hitung Rata-Rata Progres (3 Aspek)
                $npr = $nilai['nilai_progres'];
                $rataProgres = ($npr['tugas_selesai'] + $npr['ketepatan_deadline'] + $npr['kemandirian']) / 3;

                // Nilai Akhir (Gabungan)
                $nilaiAkhir = ($rataPresensi + $rataProgres) / 2;
            }

            // Masukkan ke Array Data Tabel
            $dataTabel[] = [
                'id' => $p['id'],
                'nama' => $p['nama'],
                'rata_presensi' => number_format($rataPresensi, 2), // Pakai 2 desimal biar rapi
                'rata_progres' => number_format($rataProgres, 2),
                'nilai_akhir' => number_format($nilaiAkhir, 2),
            ];
        }

        // 3. Pagination Manual
        $perPage = 10;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $dataReset = array_values($dataTabel); // Reset index array
        $dataSliced = array_slice($dataReset, $offset, $perPage);

        $penilaianPaginated = new LengthAwarePaginator(
            $dataSliced, count($dataTabel), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // RETURN KE VIEW (Sesuaikan path view baru)
        return view('admin.pembimbing.penilaian.index', compact('penilaianPaginated'));
    }

    // ==================================================================
    // 2. DETAIL (Show Detail Nilai)
    // ==================================================================
    public function detail(Request $request) 
    {
        // 1. Ambil ID dari URL
        $id = $request->input('id');
        if (!$id) return redirect()->route('pembimbing.penilaian.index');

        // 2. Load Data Dummy
        $allPeserta = include resource_path('data/peserta.php');
        $allPenilaian = include resource_path('data/penilaian.php');
        $allInstansi = include resource_path('data/instansi.php');

        // 3. Cari Peserta
        $peserta = collect($allPeserta)->firstWhere('id', $id);
        if (!$peserta) abort(404, 'Peserta tidak ditemukan');

        // 4. Cari Nilai Peserta Tersebut
        $nilai = collect($allPenilaian)->firstWhere('nama_peserta', $peserta['nama']);
        
        // 5. Siapkan Nilai (Default 0 jika belum ada)
        $k1 = $nilai['nilai_presensi']['kehadiran'] ?? 0;
        $k2 = $nilai['nilai_presensi']['ketepatan_waktu'] ?? 0;
        $p1 = $nilai['nilai_progres']['tugas_selesai'] ?? 0;
        $p2 = $nilai['nilai_progres']['ketepatan_deadline'] ?? 0;
        $p3 = $nilai['nilai_progres']['kemandirian'] ?? 0;

        $dataNilai = [
            'kehadiran' => $k1, 
            'ketepatan_waktu' => $k2,
            'tugas_selesai' => $p1, 
            'ketepatan_deadline' => $p2, 
            'kemandirian' => $p3,
            'total_presensi' => $k1 + $k2,
            'rata_presensi' => number_format(($k1 + $k2)/2, 2),
            'total_progres' => $p1 + $p2 + $p3,
            'rata_progres' => number_format(($p1 + $p2 + $p3)/3, 2),
            // Tambahan Nilai Akhir
            'nilai_akhir' => number_format( (($k1+$k2)/2 + ($p1+$p2+$p3)/3) / 2, 2)
        ];

        // 6. Nama Dinas
        $slugDinas = $peserta['instansi_slug'];
        $namaDinas = $allInstansi[$slugDinas]['name'] ?? ucfirst(str_replace('-', ' ', $slugDinas));

        // 7. Lempar ke View Detail (Path Baru)
        return view('admin.pembimbing.penilaian.detail', compact('peserta', 'dataNilai', 'namaDinas'));
    }

    // ==================================================================
    // 3. EDIT (Show Form Edit)
    // ==================================================================
    public function edit(Request $request)   
    { 
        // 1. Ambil ID dari URL
        $id = $request->input('id');
        if (!$id) return redirect()->route('pembimbing.penilaian.index');

        // 2. Load Data Dummy
        $allPeserta = include resource_path('data/peserta.php');
        $allPenilaian = include resource_path('data/penilaian.php');
        $allInstansi = include resource_path('data/instansi.php');

        // 3. Cari Peserta
        $peserta = collect($allPeserta)->firstWhere('id', $id);
        if (!$peserta) abort(404, 'Peserta tidak ditemukan');

        // 4. Cari Nilai Peserta Tersebut (Untuk mengisi form awal)
        $nilai = collect($allPenilaian)->firstWhere('nama_peserta', $peserta['nama']);
        
        // 5. Siapkan Data untuk Form
        $dataNilai = [
            'kehadiran' => $nilai['nilai_presensi']['kehadiran'] ?? 0, 
            'ketepatan_waktu' => $nilai['nilai_presensi']['ketepatan_waktu'] ?? 0,
            'tugas_selesai' => $nilai['nilai_progres']['tugas_selesai'] ?? 0, 
            'ketepatan_deadline' => $nilai['nilai_progres']['ketepatan_deadline'] ?? 0, 
            'kemandirian' => $nilai['nilai_progres']['kemandirian'] ?? 0,
        ];

        // 6. Nama Dinas
        $slugDinas = $peserta['instansi_slug'];
        $namaDinas = $allInstansi[$slugDinas]['name'] ?? ucfirst(str_replace('-', ' ', $slugDinas));

        // 7. Lempar ke View Edit (Path Baru)
        return view('admin.pembimbing.penilaian.edit', compact('peserta', 'dataNilai', 'namaDinas'));
    }

    // ==================================================================
    // 4. UPDATE (Simulasi Simpan)
    // ==================================================================
    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'kehadiran' => 'required|numeric|min:0|max:4',
            'ketepatan_waktu' => 'required|numeric|min:0|max:4',
            'tugas_selesai' => 'required|numeric|min:0|max:4',
            'ketepatan_deadline' => 'required|numeric|min:0|max:4',
            'kemandirian' => 'required|numeric|min:0|max:4',
        ]);

        // 2. Redirect dengan Pesan Sukses
        // Kita redirect ke halaman Detail agar user bisa melihat hasilnya (meski simulasi)
        return redirect()->route('pembimbing.penilaian.detail', ['id' => $id])
                         ->with('success', 'Berhasil update nilai! (Mode Simulasi)');
    }
}