<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login admin.
     * URL: /admin/login (GET)
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Memproses login admin.
     * URL: /admin/login (POST)
     */
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Cek Role User
            $role = Auth::user()->role;
            
            // --- LOGIKA REDIRECT ---

            // A. Role: PUSAT (Superadmin)
            if ($role === 'pusat') {
                // Pastikan route 'pusat.dashboard' nanti dibuat
                return redirect()->to('/admin/pusat/dashboard'); 
            }
            
            // B. Role: OPD (Dinas)
            elseif ($role === 'opd') {
                // Pastikan route 'opd.dashboard' nanti dibuat
                return redirect()->to('/admin/opd/dashboard'); 
            }

            // C. Role: PEMBIMBING (Mentor)
            elseif ($role === 'pembimbing') {
                return redirect()->intended(route('pembimbing.dashboard'));
            }

            // D. Role Nyasar (Peserta/Instansi mencoba login di halaman Admin)
            Auth::logout();
            return back()->with('error', 'Akun Anda tidak memiliki akses ke halaman Admin.');
        }

        // 4. Jika Gagal Login (Password Salah)
        return back()->with('error', 'Email atau password salah.');
    }

    /**
     * Proses Logout.
     * URL: /admin/logout (POST)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}