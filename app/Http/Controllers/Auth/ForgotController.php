<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotController extends Controller
{
    public function index()
    {
        return view('user.tamu.auth.forgot');
    }

    public function sendLink(Request $request)
    {
        // validasi email
        // kirim reset link
    }
}