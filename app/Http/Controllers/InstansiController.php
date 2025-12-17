<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function homeinstansi(string $slug)
    {
        $instansiData = include resource_path('data/instansi.php');

        abort_unless(isset($instansiData[$slug]), 404);

        return view('user.pemohon.instansi.homeinstansi', [
            'instansi' => $instansiData[$slug]
        ]);
    }
}