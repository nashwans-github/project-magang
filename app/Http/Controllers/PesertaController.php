<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required',
            'password'   => 'required',
        ]);

        // sementara (belum DB)
        session([
            'mode' => 'peserta',
            'peserta_aktif' => [
                'id'    => $request->peserta_id,
                'nama'  => 'Dummy Peserta',
                'email' => 'dummy@email.com',
            ],
        ]);

        return redirect()->route('peserta.profile');
    }

    public function profile()
    {
        if (session('mode') !== 'peserta') {
            return redirect('/');
        }

        return view('user.peserta.profile', [
            'peserta' => session('peserta_aktif'),
        ]);
    }

    /* ===================== */
    /*      PRESENSI        */
    /* ===================== */

    public function presensi()
    {
        if (session('mode') !== 'peserta') {
            return redirect('/');
        }

        $today = now()->toDateString();

        // sementara: cek dari session
        $sudahPresensi = session('presensi_harian') === $today;

        return view('user.peserta.presensi', [
            'today' => $today,
            'sudahPresensi' => $sudahPresensi,
        ]);
    }

    public function storePresensi(Request $request)
    {
        if (session('mode') !== 'peserta') {
            return redirect('/');
        }

        $today = now()->toDateString();

        // cegah presensi ganda
        if (session('presensi_harian') === $today) {
            return redirect()
                ->route('peserta.presensi')
                ->with('warning', 'Anda sudah presensi hari ini');
        }

        // simpan sementara
        session(['presensi_harian' => $today]);

        return redirect()
            ->route('peserta.presensi')
            ->with('success', 'Presensi hari ini berhasil');
    }

    /* ===================== */
    /*        PROGRES        */
    /* ===================== */
    public function progres()
    {
        if (session('mode') !== 'peserta') {
            return redirect('/');
        }

        // sementara: dummy progres
        $progresList = [
            [
                'judul' => 'Pengenalan Lingkungan Kerja',
                'status' => 'selesai',
            ],
            [
                'judul' => 'Belajar Alur Sistem Internal',
                'status' => 'proses',
            ],
            [
                'judul' => 'Membuat Modul Presensi',
                'status' => 'belum',
            ],
        ];

        $jumlahSelesai = collect($progresList)
            ->where('status', 'selesai')
            ->count();

        return view('user.peserta.progres', [
            'progresList' => $progresList,
            'jumlahSelesai' => $jumlahSelesai,
        ]);
    }

    /* ===================== */
    /*       PENILAIAN       */
    /* ===================== */
    public function penilaian()
    {
        if (session('mode') !== 'peserta') {
            return redirect('/');
        }

        // dummy penilaian (sementara)
        $penilaian = [
            [
                'aspek' => 'Kedisiplinan',
                'nilai' => 3.5,
            ],
            [
                'aspek' => 'Tanggung Jawab',
                'nilai' => 3.2,
            ],
            [
                'aspek' => 'Kemampuan Teknis',
                'nilai' => 3.0,
            ],
            [
                'aspek' => 'Kerja Sama',
                'nilai' => 3.1,
            ],
        ];

        $rataRata = collect($penilaian)
            ->avg('nilai');

        return view('user.peserta.penilaian', [
            'penilaian' => $penilaian,
            'rataRata' => round($rataRata, 2),
        ]);
    }

    /* ===================== */
    /*         SURAT         */
    /* ===================== */
    public function surat()
    {
        if (session('mode') !== 'peserta') {
            return redirect('/');
        }

        // dummy daftar surat
        $suratList = [
            [
                'judul' => 'Surat Keterangan Aktif Magang',
                'jenis' => 'aktif',
                'tersedia' => true,
            ],
            [
                'judul' => 'Surat Penilaian Magang',
                'jenis' => 'penilaian',
                'tersedia' => true,
            ],
            [
                'judul' => 'Surat Keterangan Selesai Magang',
                'jenis' => 'selesai',
                'tersedia' => false,
            ],
        ];

        return view('user.peserta.surat', [
            'suratList' => $suratList,
        ]);
    }
}