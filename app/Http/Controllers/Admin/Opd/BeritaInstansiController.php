<?php

namespace App\Http\Controllers\Admin\Opd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

class BeritaInstansiController extends Controller
{
    // =========================================================================
    // SIMULASI LOGIN (Ganti angka ini untuk mengetes Dinas lain)
    // =========================================================================
    private $id_admin_login = 3; 

    public function index(Request $request)
    {
        Session::forget('simulated_berita'); // Aktifkan jika ingin reset data

        // 1. CEK SESSION (SIMULASI DATABASE GLOBAL)
        if (!Session::has('simulated_berita')) {
            $path = resource_path('data/berita.php'); // Pastikan path sesuai (huruf besar/kecil)
            $initialData = file_exists($path) ? include $path : [];
            Session::put('simulated_berita', $initialData);
        }

        // Ambil SEMUA data dari Session (Global Data)
        $allBerita = Session::get('simulated_berita');

        // 2. FILTER DATA (HANYA MILIK DINAS YANG LOGIN)
        // Kita filter dulu sebelum diproses lebih lanjut
        $myBerita = collect($allBerita)
                    ->where('id_dinas', $this->id_admin_login)
                    ->values(); // Reset key array

        // Ubah jadi Collection Object
        $collection = $myBerita->map(function($item) {
            return (object) $item;
        });

        // 3. TAMBAHKAN GHOST ITEM (SLOT KOSONG UNTUK UPLOAD)
        // Ghost item ini hanya ditambah ke tampilan user, tidak ke database session
        $collection->push((object)[
            'id' => null, 
            'judul' => '',
            'tanggal' => '',
            'file_path' => null,
        ]);

        // ==========================================================
        // LOGIKA JUMP TO SLIDE
        // ==========================================================
        $perPage = 1;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if ($request->has('edit')) {
            $editId = $request->get('edit');
            $targetIndex = $collection->search(function($item) use ($editId) {
                return $item->id == $editId;
            });

            if ($targetIndex !== false) {
                $currentPage = $targetIndex + 1;
                LengthAwarePaginator::resolveCurrentPage('page', $currentPage);
            }
        }

        // ==========================================================
        // PAGINATION (SLIDER)
        // ==========================================================
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
        $beritaList = new LengthAwarePaginator(
            $currentPageItems, 
            $collection->count(), 
            $perPage, 
            $currentPage, 
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $currentNews = $beritaList->first();
        $editBerita = ($currentNews && $currentNews->id) ? $currentNews : null;

        return view('admin.opd.berita-instansi.index', compact('beritaList', 'editBerita', 'currentNews'));
    }
    
    public function store(Request $request)
{
$data = Session::get('simulated_berita', []);
    $newId = count($data) > 0 ? max(array_column($data, 'id')) + 1 : 1;

    // Logika Simpan File Fisik
    $fileName = 'default.png'; 
    if ($request->hasFile('file_berita')) {
        $file = $request->file('file_berita');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);
    }

    $data[] = [
        'id' => $newId,
        'id_dinas' => $this->id_admin_login,
        'judul' => $request->judul,
        'tanggal' => $request->tanggal,
        'file_path' => $fileName, // Gunakan nama file asli
    ];

    Session::put('simulated_berita', $data);
    return redirect()->route('opd.beritainstansi.index')->with('success', 'Berita berhasil diterbitkan!');
}
    public function update(Request $request, $id)
    {
        $data = Session::get('simulated_berita');
        
        // Loop Database Global
        foreach ($data as $key => $item) {
            // Cek ID Berita DAN pastikan milik Dinas yang login (Security Check)
            if ($item['id_dinas'] == $id && $item['id_dinas'] == $this->id_admin_login) {
                $data[$key]['judul'] = $request->judul;
                $data[$key]['tanggal'] = $request->tanggal;
                break;
            }
        }

        Session::put('simulated_berita', $data);
        return redirect()->back()->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = Session::get('simulated_berita');

        // Filter data: Buang yang ID-nya cocok DAN milik dinas ini
        $newData = array_filter($data, function($item) use ($id) {
            // Jika ID sama, cek apakah milik user ini.
            if ($item['id'] == $id) {
                // Jika milik user ini, return false (dibuang/dihapus)
                // Jika bukan milik user ini (orang iseng hapus ID lain), return true (jangan dihapus)
                return $item['id_dinas'] != $this->id_admin_login;
            }
            return true; // Data lain tetap disimpan
        });

        Session::put('simulated_berita', array_values($newData));

        return redirect()->route('opd.beritainstansi.index')->with('success', 'Berita dihapus!');
    }
}