<?php

namespace App\Http\Controllers\Admin\Pembimbing; // 1. Namespace Disesuaikan

use App\Http\Controllers\Controller; // 2. Import Controller Utama
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator; 
use Carbon\Carbon;

class DaftarPesertaController extends Controller // 3. Nama Class Disesuaikan
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        // ==========================================
        // 1. SETUP FILTERING
        // ==========================================
        $slugInstansiSaya = $request->input('dinas', 'kominfo');
        $bidangSaya = $request->input('bidang', 'Aplikasi');

        // Pastikan file dummy ada di resources/data/
        $allPeserta = include resource_path('data/peserta.php');
        $allInstansi = include resource_path('data/instansi.php');
        
        $namaInstansi = $allInstansi[$slugInstansiSaya]['name'] ?? 'Instansi Tidak Dikenal';

        // ==========================================
        // 2. FILTER DATA (Masih berupa Array Biasa)
        // ==========================================
        $pesertaFiltered = array_filter($allPeserta, function($p) use ($slugInstansiSaya, $bidangSaya) {
            $cekDinas = isset($p['instansi_slug']) && $p['instansi_slug'] === $slugInstansiSaya;
            
            $cekBidang = true;
            if ($bidangSaya !== 'semua') {
                $cekBidang = isset($p['bidang']) && $p['bidang'] === $bidangSaya;
            }

            return $cekDinas && $cekBidang;
        });

        // ==========================================
        // 3. UBAH ARRAY JADI PAGINATOR (Solusi Error)
        // ==========================================
        
        // A. Konfigurasi
        $perPage = 10; // Jumlah data per halaman
        $currentPage = $request->input('page', 1); // Halaman aktif
        
        // B. Reset Index Array (Penting agar slicing rapi)
        $dataPeserta = array_values($pesertaFiltered); 

        // C. Potong Data (Slice) sesuai halaman
        $currentItems = array_slice($dataPeserta, ($currentPage - 1) * $perPage, $perPage);

        // D. Buat Objek Paginator (Inilah yang punya fungsi firstItem, links, dll)
        $pesertaSaya = new LengthAwarePaginator(
            $currentItems, // Data potongannya
            count($dataPeserta), // Total semua data
            $perPage, // Limit per halaman
            $currentPage, // Halaman sekarang
            [
                'path' => $request->url(), // URL dasar
                'query' => $request->query(), // Agar parameter ?dinas=.. terbawa
            ]
        );

        // ==========================================
        // 4. KIRIM KE VIEW
        // ==========================================
        // Mengarah ke folder: resources/views/admin/pembimbing/daftar-peserta/index.blade.php
        return view('admin.pembimbing.daftar-peserta.index', compact(
            'pesertaSaya', // Sekarang ini adalah OBJECT PAGINATOR, bukan Array lagi
            'namaInstansi',
            'slugInstansiSaya',
            'bidangSaya'
        ));
    }

    public function detail(Request $request)
    {
        Carbon::setLocale('id');
        // 1. TANGKAP ID DARI URL
        $idPeserta = $request->input('id');

        // 2. LOAD SEMUA DATA DUMMY
        $allPeserta  = include resource_path('data/peserta.php');
        $allInstansi = include resource_path('data/instansi.php');
        $allPresensi = include resource_path('data/presensi.php');
        $allProgres  = include resource_path('data/progres.php');
        $allNilai    = include resource_path('data/penilaian.php');

        // 3. CARI PESERTA BERDASARKAN ID
        // array_filter menghasilkan array, jadi kita ambil elemen pertamanya pakai reset()
        $hasilPencarian = array_filter($allPeserta, function($p) use ($idPeserta) {
            return $p['id'] == $idPeserta;
        });

        $peserta = reset($hasilPencarian);

        // Validasi: Kalau ID ngawur/tidak ketemu, lempar error 404
        if (!$peserta) {
            abort(404, 'Peserta tidak ditemukan');
        }

        // 4. SIAPKAN DATA TAMBAHAN (DINAS, STATISTIK, DLL)
        
        // A. Nama Dinas Lengkap
        $slugDinas = $peserta['instansi_slug'];
        $namaDinas = $allInstansi[$slugDinas]['name'] ?? 'Instansi Tidak Dikenal';

        // B. Hitung Kehadiran (Persentase)
        // Hitung total hari kerja (asumsi selisih hari dari Mulai sampai Selesai)
        // Tapi untuk dummy, kita hitung jumlah data presensi saja
        $dataPresensiPeserta = array_filter($allPresensi, function($absen) use ($peserta) {
            // Jika dummy presensi menggunakan 'peserta_id', gunakan itu. Jika 'nama_peserta', gunakan nama.
            // Disini diasumsikan menggunakan logic yang sama dengan kode asli Anda
            return isset($absen['nama_peserta']) && $absen['nama_peserta'] === $peserta['nama'];
             // Atau jika pakai ID: return $absen['peserta_id'] == $peserta['id'];
        });
        
        $totalHadir = count(array_filter($dataPresensiPeserta, function($absen) {
            return $absen['status'] === 'tepat_waktu' || $absen['status'] === 'terlambat';
        }));
        
        // -----------------------------------------------------------
        // PERBAIKAN LOGIKA PERSENTASE (Berdasarkan Data yang Ada)
        // -----------------------------------------------------------
        $totalDataAbsen = count($dataPresensiPeserta); // Jumlah total record absen dia (misal: 3)

        if ($totalDataAbsen > 0) {
            $persentaseKehadiran = round(($totalHadir / $totalDataAbsen) * 100, 1);
        } else {
            $persentaseKehadiran = 0;
        }

        // C. Hitung Progres Selesai
        $progresSelesai = count(array_filter($allProgres, function($prog) use ($peserta) {
            // Sesuaikan logic dengan struktur data dummy Anda
            return isset($prog['nama_peserta']) && $prog['nama_peserta'] === $peserta['nama'] && $prog['status'] === 'approved';
        }));

        // D. Nilai Rata-Rata
        $nilaiRataRata = 0;
        
        // Cari nilai berdasarkan nama peserta
        $dataNilai = null;
        foreach ($allNilai as $n) {
            if (isset($n['nama_peserta']) && $n['nama_peserta'] === $peserta['nama']) {
                $dataNilai = $n;
                break;
            }
        }

        if ($dataNilai) {
            $p = $dataNilai['nilai_presensi'];
            $k = $dataNilai['nilai_progres'];

            // Jumlahkan 5 Indikator
            $totalSkor = $p['kehadiran'] + $p['ketepatan_waktu'] + 
                         $k['tugas_selesai'] + $k['ketepatan_deadline'] + $k['kemandirian'];
            
            // Bagi 5
            $nilaiRataRata = round($totalSkor / 5, 1);
        }

        // 5. KIRIM SEMUA KE VIEW
        // Mengarah ke folder: resources/views/admin/pembimbing/daftar-peserta/detail.blade.php
        return view('admin.pembimbing.daftar-peserta.detail', compact(
            'peserta',
            'namaDinas',
            'persentaseKehadiran',
            'progresSelesai',
            'nilaiRataRata'
        ));
    }
}