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
        // validasi
        // attempt login
    }
}