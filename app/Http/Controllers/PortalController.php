<?php

namespace App\Http\Controllers;

class PortalController extends Controller
{
    public function home($slug)
    {
        $instansiList = include resource_path('data/instansi.php');
        $instansi = $instansiList[$slug] ?? abort(404);

        // simpan konteks akun utama
        session([
            'portal_instansi' => $slug,
            'mode' => 'portal', // opsional tapi rapi
        ]);

        return view('user.akun_utama.home_portal', compact('instansi'));
    }
}