<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index()
    {
        return view('user.tamu.homepage');
    }
}
