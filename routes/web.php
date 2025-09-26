<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
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
    Route::resource('areas', AreaController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('locality', LocalityController::class);
    Route::resource('property_type', PropertyTypeController::class);
    Route::resource('property', PropertyController::class);


    Route::post('import-area', [AreaController::class, 'import'])->name('import.area');
    Route::get('area-list', [AreaController::class, 'getAreas'])->name('area.list');
    Route::get('export-areas', [AreaController::class, 'export'])->name('area.export');
    Route::get('get-by-company/{company_id?}', [AreaController::class, 'getByCompany'])->name('area.getbycompany');

    Route::get('export-localities', [LocalityController::class, 'export'])->name('locality.export');
    Route::get('locality-list', [LocalityController::class, 'getLocalities'])->name('locality.list');
    Route::post('import-locality', [LocalityController::class, 'import'])->name('import.locality');

    Route::get('propertyType-list', [PropertyTypeController::class, 'getPropertyType'])->name('property_type.list');
    Route::post('import-property-type', [PropertyTypeController::class, 'importPropertyType'])->name('import.propertytype');
    Route::get('export-property-type', [PropertyTypeController::class, 'exportPropertyType'])->name('propertyType.export');

    Route::get('property-list', [propertyController::class, 'getProperties'])->name('property.list');
    Route::get('export-property', [PropertyController::class, 'exportProperty'])->name('property.export');
    Route::post('import-property', [PropertyController::class, 'importProperty'])->name('import.property');
});
