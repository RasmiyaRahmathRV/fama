<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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


Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('do-login', [LoginController::class, 'doLogin'])->name('do.login');
Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot.password');
Route::post('do-forgotpassword', [LoginController::class, 'doForgotPassword'])->name('do.forgot.password');
Route::get('reset-password/{token}', [LoginController::class, 'resetPassword'])->name('reset.password');
Route::post('do-reset-password', [LoginController::class, 'doResetPassword'])->name('do.reset.password');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('area', [AreaController::class, 'index'])->name('area');
    Route::post('store-area', [AreaController::class, 'store'])->name('area.store');
});
