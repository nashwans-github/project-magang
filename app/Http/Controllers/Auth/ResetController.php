<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function index()
    {
        return view('user.tamu.auth.reset');
    }

    public function update(Request $request)
    {
        // validasi token
        // update password
    }
}
