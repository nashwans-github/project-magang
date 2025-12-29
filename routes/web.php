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