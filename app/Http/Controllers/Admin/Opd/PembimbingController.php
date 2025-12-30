<?php

namespace App\Http\Controllers\Admin\Opd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PembimbingController extends Controller
{
    private $id_admin_login = 3; 

// Aktifkan jika ingin reset data

    public function index()
    {
        //Session::forget('simulated_pembimbing'); 
        // 1. Load data ke Session jika belum ada
        if (!Session::has('simulated_pembimbing')) {
            // Pastikan path 'data' (huruf kecil) agar konsisten
            $path = resource_path('data/pembimbing.php');
            $initialData = file_exists($path) ? include $path : [];
            Session::put('simulated_pembimbing', $initialData);
        }

        $allPembimbing = Session::get('simulated_pembimbing');

        // 2. Filter menggunakan 'dinas_id' (sesuai isi file pembimbing.php Anda)
        $pembimbings = collect($allPembimbing)
                        ->where('id_dinas', $this->id_admin_login)
                        ->values();

        return view('admin.opd.pembimbing.index', compact('pembimbings'));
    }

    public function create()
    {
        return view('admin.opd.pembimbing.create');
    }

    public function store(Request $request)
    {
        $data = Session::get('simulated_pembimbing', []);

        // 3. Cari ID tertinggi untuk auto-increment manual
        $newId = count($data) > 0 ? max(array_column($data, 'id')) + 1 : 1;

        // 4. Masukkan data sesuai atribut di pembimbing.php Anda
        $data[] = [
            'id'        => $newId,
            'id_dinas'  => $this->id_admin_login, // Gunakan dinas_id agar sinkron
            'nama'      => $request->nama,
            'bidang'    => $request->bidang,
            'email'     => $request->email,
            'password'  => $request->password ?? 'password123', // Default jika tidak diisi
        ];

        Session::put('simulated_pembimbing', $data);

        return redirect()->route('opd.pembimbing.index')->with('success', 'Pembimbing berhasil ditambahkan!');
    }
}