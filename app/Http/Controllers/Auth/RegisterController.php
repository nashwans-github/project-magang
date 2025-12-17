<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user.tamu.auth.register');
    }

    public function store(Request $request)
    {
        // validasi
        // create user
    }
}