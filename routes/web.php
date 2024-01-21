<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboar', [AdminController::class, 'index']);

        //Activity
        Route::get('/activity', [AdminController::class, 'history']);

        //Kerupuk
        Route::get('/kerupuk', [AdminController::class, 'kerupuk']);
        Route::post('/store_kerupuk', [AdminController::class, 'store']);
        Route::put('/update_kerupuk', [AdminController::class, 'update']);
        Route::get('/kerupuk/delete/{id}', [AdminController::class, 'destroy']);

        //transaksi
        Route::get('/get_transaksi', [TransaksiController::class, 'get_transaksi']);
        Route::get('/transaksi', [TransaksiController::class, 'transaksi']);
        Route::post('/store_transaksi', [TransaksiController::class, 'store_transaksi']);
        Route::put('/update_transaksi', [TransaksiController::class, 'update_transaksi']);
    }
);