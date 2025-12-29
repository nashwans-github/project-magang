<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    // ========================================
    // STEP 1 : FORM PEMOHON
    // ========================================
    public function pemohon($slug)
    {
        $instansiList = include resource_path('data/instansi.php');
        $instansi = $instansiList[$slug] ?? abort(404);

        $oldData = session('pendaftaran.step1', []);

        return view('user.pemohon.pendaftaran.step1', compact('instansi', 'oldData'));
    }

    public function step1Store(Request $request, $slug)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'instansi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'dinas' => 'required|string',
        ]);

        session(['pendaftaran.step1' => $validated]);

        return redirect()->route('pendaftaran.peserta', $slug);
    }

    // ========================================
    // STEP 2 : FORM PESERTA
    // ========================================
    public function peserta($slug)
    {
        if (!session()->has('pendaftaran.step1')) {
            return redirect()->route('pendaftaran.pemohon', $slug);
        }

        $instansiList = include resource_path('data/instansi.php');
        $instansi = $instansiList[$slug] ?? abort(404);

        $bidangOptions = collect($instansi['bidang'])->pluck('name')->toArray();

        $savedPeserta = session('pendaftaran.step2', [
            [
                'nama' => '',
                'nomor' => '',
                'email' => '',
                'jurusan' => '',
                'bidang_tujuan' => '',
                'password' => ''
            ]
        ]);

        return view('user.pemohon.pendaftaran.step2', compact(
            'instansi',
            'bidangOptions',
            'savedPeserta'
        ));
    }

    public function step2Store(Request $request, $slug)
    {
        $instansiList = include resource_path('data/instansi.php');
        $instansi = $instansiList[$slug] ?? abort(404);

        $bidangValid = collect($instansi['bidang'])->pluck('name')->toArray();

        $validated = $request->validate([
            'peserta' => 'required|array|min:1',
            'peserta.*.nama' => 'required|string',
            'peserta.*.nomor' => 'required|string',
            'peserta.*.email' => 'required|email',
            'peserta.*.password' => 'required|string',
            'peserta.*.jurusan' => 'required|string',
            'peserta.*.bidang_tujuan' => ['required', 'string', function ($attr, $value) use ($bidangValid) {
                if (!in_array($value, $bidangValid)) {
                    abort(422, 'Bidang tidak valid');
                }
            }],
        ]);

        session(['pendaftaran.step2' => $validated['peserta']]);

        return redirect()->route('pendaftaran.berkas', $slug);
    }

    // ========================================
    // STEP 3 : UPLOAD BERKAS
    // ========================================
    public function berkas($slug)
    {
        if (!session()->has('pendaftaran.step2')) {
            return redirect()->route('pendaftaran.peserta', $slug);
        }

        $data = include resource_path('data/instansi.php');
        $instansi = $data[$slug] ?? abort(404);

        $uploadedFiles = session('pendaftaran.step3', []);

        return view('user.pemohon.pendaftaran.step3', compact(
            'slug',
            'instansi',
            'uploadedFiles'
        ));
    }

    public function step3Store(Request $request, $slug)
    {
        $data = include resource_path('data/instansi.php');
        $instansi = $data[$slug] ?? abort(404);

        $existingFiles = session('pendaftaran.step3', []);
        $rules = [];

        foreach ($instansi['persyaratan'] as $file) {
            $field = Str::slug($file, '-');
            $rules[$field] = isset($existingFiles[$field])
                ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
                : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }

        $validated = $request->validate($rules);

        foreach ($validated as $field => $file) {
            if ($file) {
                $existingFiles[$field] = $file->getClientOriginalName();
            }
        }

        session(['pendaftaran.step3' => $existingFiles]);

        return redirect()->route('pendaftaran.review', $slug);
    }

    // ========================================
    // STEP 4 : REVIEW
    // ========================================
    public function review($slug)
    {
        if (
            !session()->has('pendaftaran.step1') ||
            !session()->has('pendaftaran.step2') ||
            !session()->has('pendaftaran.step3')
        ) {
            return redirect()->route('pendaftaran.pemohon', $slug);
        }

        $instansiList = include resource_path('data/instansi.php');
        $instansi = $instansiList[$slug];

        $labelMapping = [];
        foreach ($instansi['persyaratan'] as $p) {
            $labelMapping[Str::slug($p, '-')] = $p;
        }

        $berkas = session('pendaftaran.step3');
        $berkasWithLabel = [];

        foreach ($berkas as $key => $file) {
            $berkasWithLabel[$key] = [
                'label' => $labelMapping[$key],
                'file' => $file
            ];
        }

        $data = [
            'pemohon' => session('pendaftaran.step1'),
            'peserta' => session('pendaftaran.step2'),
            'berkas' => $berkasWithLabel,
        ];

        return view('user.pemohon.pendaftaran.step4', compact('data', 'slug'));
    }

    // ========================================
    // FINAL SUBMIT
    // ========================================
    public function finalSubmit($slug)
    {
        session()->forget('pendaftaran');

        return redirect()->route('homepage')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }
}