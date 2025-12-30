<?php

namespace App\Http\Controllers\Admin\Pusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $allPendaftar = include resource_path('data/pendaftar.php');

        if ($request->filled('search')) {
            $keyword = strtolower($request->search);
            $allPendaftar = array_filter($allPendaftar, function($item) use ($keyword) {
                return str_contains(strtolower($item['nama']), $keyword) || 
                       str_contains(strtolower($item['email']), $keyword);
            });
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $pendaftar = new LengthAwarePaginator(
            array_slice($allPendaftar, ($currentPage - 1) * $perPage, $perPage),
            count($allPendaftar), $perPage, $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.pusat.pendaftar.index', compact('pendaftar'));
    }
}