<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TamuController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\ResetController;

use App\Http\Controllers\InstansiController;

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
    Route::get('/instansi-{slug}', [InstansiController::class, 'homeinstansi'])
        ->name('user.pemohon.instansi.homeinstansi');
});