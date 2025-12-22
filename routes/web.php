<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TamuController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\ResetController;

use App\Http\Controllers\InstansiController;

use App\Http\Controllers\Admin\Pusat\DashboardController;
use App\Http\Controllers\Admin\Pusat\ManajemenOpdController;
use App\Http\Controllers\Admin\Pusat\PendaftarController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])
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