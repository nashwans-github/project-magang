<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TamuController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\ResetController;

use App\Http\Controllers\InstansiController;

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
    Route::get('/instansi-{slug}', [InstansiController::class, 'homeinstansi'])
    ->name('user.pemohon.instansi.homeinstansi');
});

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

// =================================================================
// 2. ROUTES ADMIN - OPD (Penyelarasan Baru)
// =================================================================
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