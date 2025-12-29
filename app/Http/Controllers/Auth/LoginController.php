<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.tamu.auth.login');
    }

    public function authenticate(Request $request)
{
    $request->validate([
        'email'    => ['required'],
        'password' => ['required'],
    ]);

    // ==========================
    // FAKE LOGIN (SEMENTARA)
    // ==========================
    session([
        'portal_logged_in' => true,
        'portal_user' => [
            'email' => $request->email,
        ],
    ]);

    // Redirect prioritas
    if ($request->filled('intended_instansi')) {
        return redirect($request->intended_instansi);
    }

    return redirect('/portal/instansi/komunikasi-informatika');
}

}
