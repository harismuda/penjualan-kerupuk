<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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
        Route::get('/activity', [AdminController::class, 'history']);
        Route::get('/kerupuk', [AdminController::class, 'kerupuk']);
        Route::get('/sell', [AdminController::class, 'sell']);
    }
);