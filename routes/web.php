<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TamuController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\ResetController;

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\InstansiController;

use App\Http\Controllers\PortalController;
use App\Http\Controllers\PesertaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\Admin\Pusat\DashboardController as PusatDashboard;
use App\Http\Controllers\Admin\Pusat\ManajemenOpdController;
use App\Http\Controllers\Admin\Pusat\PendaftarController;

use App\Http\Controllers\Admin\Opd\DashboardController as OpdDashboard;
use App\Http\Controllers\Admin\Opd\ProfileController;
use App\Http\Controllers\Admin\Opd\PembimbingController;
use App\Http\Controllers\Admin\Opd\VerifikasiController;
use App\Http\Controllers\Admin\Opd\PesertaController;
use App\Http\Controllers\Admin\Opd\SuratMagangController;
use App\Http\Controllers\Admin\Opd\BeritaInstansiController;

use App\Http\Controllers\Admin\Pembimbing\DashboardController as PembimbingDashboard;
use App\Http\Controllers\Admin\Pembimbing\DaftarPesertaController;
use App\Http\Controllers\Admin\Pembimbing\PresensiController;
use App\Http\Controllers\Admin\Pembimbing\ProgresController;
use App\Http\Controllers\Admin\Pembimbing\PenilaianController;

use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

// Routes User
Route::get('/', [TamuController::class, 'index'])->name('homepage');

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate');

Route::get('/register', [RegisterController::class, 'index'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('/lupa-password', [ForgotController::class, 'index'])
    ->name('password.request');
Route::post('/lupa-password', [ForgotController::class, 'sendLink'])
    ->name('password.sendLink');

Route::get('/reset-password', [ResetController::class, 'index'])
    ->name('password.reset');
Route::post('/reset-password', [ResetController::class, 'update'])
    ->name('password.update');

Route::middleware('pemohon.or.dev')->group(function () {

    // =====================
    // INSTANSI
    // =====================
    Route::get('/instansi/{slug}', [InstansiController::class, 'homeinstansi'])
        ->name('user.pemohon.instansi.homeinstansi');

    // =====================
    // PENDAFTARAN
    // =====================
    Route::prefix('/pendaftaran/{slug}')->group(function () {

        Route::get('/step1', [PendaftaranController::class, 'pemohon'])
            ->name('pendaftaran.pemohon');

        Route::post('/step1', [PendaftaranController::class, 'step1Store'])
            ->name('pendaftaran.step1.store');

        Route::get('/step2', [PendaftaranController::class, 'peserta'])
            ->name('pendaftaran.peserta');

        Route::post('/step2', [PendaftaranController::class, 'step2Store'])
            ->name('pendaftaran.step2.store');

        Route::get('/step3', [PendaftaranController::class, 'berkas'])
            ->name('pendaftaran.berkas');

        Route::post('/step3', [PendaftaranController::class, 'step3Store'])
            ->name('pendaftaran.step3.store');

        Route::get('/step4', [PendaftaranController::class, 'review'])
            ->name('pendaftaran.review');

        Route::post('/step4', [PendaftaranController::class, 'finalSubmit'])
            ->name('pendaftaran.finalSubmit');
    });

});




Route::middleware('portal.acces')->prefix('portal')->group(function () {

    Route::get('/instansi/{slug}', [PortalController::class, 'home'])
        ->name('portal.instansi.home');
});

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');




Route::post('/peserta/login', [PesertaController::class, 'login'])
    ->name('peserta.login');

Route::prefix('peserta')->group(function () {
    Route::get('/profile', [PesertaController::class, 'profile'])
        ->name('peserta.profile');

    Route::get('/presensi', [PesertaController::class, 'presensi'])
        ->name('peserta.presensi');

    Route::post('/presensi', [PesertaController::class, 'storePresensi'])
        ->name('peserta.presensi.store');

    Route::get('/progres', [PesertaController::class, 'progres'])
        ->name('peserta.progres');

    Route::get('/penilaian', [PesertaController::class, 'penilaian'])
        ->name('peserta.penilaian');

    Route::get('/surat', [PesertaController::class, 'surat'])
        ->name('peserta.surat');
});

Route::post('/peserta/logout', function () {
    session()->forget(['mode', 'peserta_aktif']);

    $slug = session('portal_instansi', 'komunikasi-informatika');

    return redirect("/portal/instansi/{$slug}");
})->name('peserta.logout');




// Routes Admin - Pusat
Route::prefix('admin/pusat')->name('pusat.')->group(function (){
    // Route Dashboard
    Route::get('/dashboard', [PusatDashboard::class, 'index'])
        ->name('dashboard');
    // Route Pendaftar
    Route::get('/pendaftar', [PendaftarController::class, 'index'])
        ->name('pendaftar.index');
    // Route Manajemen OPD
    Route::get('/manajemen-opd', [ManajemenOpdController::class, 'index'])
        ->name('manajemen-opd.index');
    Route::get('/manajemen-opd/tambah', [ManajemenOpdController::class, 'create'])
        ->name('manajemen-opd.create');
    Route::post('/manajemen-opd/store', [ManajemenOpdController::class, 'store'])
        ->name('manajemen-opd.store');
    Route::get('/manajemen-opd/detail/{slug}', [ManajemenOpdController::class, 'detail'])
        ->name('manajemen-opd.detail');
});

// 2. ROUTES ADMIN - OPD (Penyelarasan Baru)
Route::prefix('admin/opd')->name('opd.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [OpdDashboard::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Pembimbing
    Route::get('/pembimbing', [PembimbingController::class, 'index'])->name('pembimbing.index');
    Route::get('/pembimbing/create', [PembimbingController::class, 'create'])->name('pembimbing.create');
    Route::post('/pembimbing/store', [PembimbingController::class, 'store'])->name('pembimbing.store');

    // Verifikasi (Permohonan Masuk)
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::get('/verifikasi/{id}', [VerifikasiController::class, 'show'])->name('verifikasi.detail');

    // Peserta Aktif
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
    Route::get('/peserta/{id}', [PesertaController::class, 'show'])->name('peserta.show');

    // Surat Magang
    Route::get('/surat-magang', [SuratMagangController::class, 'index'])->name('suratmagang.index');
    Route::get('/surat-magang/{id}', [SuratMagangController::class, 'detail'])->name('suratmagang.detail');

    // Berita Instansi
    Route::get('/berita', [BeritaInstansiController::class, 'index'])->name('beritainstansi.index');
    Route::post('/berita/store', [BeritaInstansiController::class, 'store'])->name('beritainstansi.store');
    Route::put('/berita/update/{id}', [BeritaInstansiController::class, 'update'])->name('beritainstansi.update');
    Route::delete('/berita/delete/{id}', [BeritaInstansiController::class, 'destroy'])->name('beritainstansi.destroy');
});

// Routes Admin - Pembimbing
Route::prefix('admin/pembimbing')->name('pembimbing.')->group(function (){
    // Route Dashboard
    Route::get('/dashboard', [PembimbingDashboard::class, 'index'])
        ->name('dashboard');
    // Route Daftar Peserta
    Route::get('/daftar-peserta', [DaftarPesertaController::class, 'index'])
        ->name('daftar-peserta.index');
    Route::get('/daftar-peserta/detail', [DaftarPesertaController::class, 'detail'])
        ->name('daftar-peserta.detail');
    // Route Presensi
    Route::get('/presensi', [PresensiController::class, 'index'])
        ->name('presensi.index');
    Route::get('/presensi/detail', [PresensiController::class, 'detail'])
        ->name('presensi.detail');
    // Route Progres
    Route::get('/progres', [ProgresController::class, 'index'])
        ->name('progres.index');
    Route::get('/progres/detail', [ProgresController::class, 'detail'])
        ->name('progres.detail');
    // Route Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])
        ->name('penilaian.index');
    Route::get('/penilaian/detail', [PenilaianController::class, 'detail'])
        ->name('penilaian.detail');
    Route::get('/penilaian/edit', [PenilaianController::class, 'edit'])
        ->name('penilaian.edit');
    Route::put('/penilaian/update/{id}', [PenilaianController::class, 'update'])
        ->name('penilaian.update');
});

// Routes Auth Admin
Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])
        ->name('login.process');
    Route::post('/logout', [AdminLoginController::class, 'logout'])
        ->name('logout');
});