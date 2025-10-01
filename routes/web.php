<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\VendorController;
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
    Route::resource('vendors', VendorController::class);
    Route::resource('bank', BankController::class);
    Route::resource('installment', InstallmentController::class);
    Route::resource('payment_mode', PaymentModeController::class);
    Route::resource('nationality', NationalityController::class);


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

    Route::get('vendor-list', [VendorController::class, 'getVendors'])->name('vendor.list');
    Route::post('import-vendor', [VendorController::class, 'importVendor'])->name('import.vendor');
    Route::get('export-vendor', [VendorController::class, 'exportVendor'])->name('vendor.export');

    Route::get('bank-list', [BankController::class, 'getBanks'])->name('bank.list');
    Route::get('export-bank', [BankController::class, 'exportBanks'])->name('bank.export');
    Route::post('import-bank', [BankController::class, 'importBank'])->name('import.bank');

    Route::get('installment-list', [InstallmentController::class, 'getInstallments'])->name('installment.list');
    Route::get('export-installment', [InstallmentController::class, 'exportInstallments'])->name('installment.export');
    Route::post('import-installment', [InstallmentController::class, 'importInstallment'])->name('import.installment');

    Route::get('payment-mode-list', [PaymentModeController::class, 'getPaymentModes'])->name('paymentMode.list');
    Route::get('export-payment-mode', [PaymentModeController::class, 'exportPaymentModes'])->name('paymentMode.export');
    Route::post('import-payment-mode', [PaymentModeController::class, 'importPaymentMode'])->name('import.paymentMode');

    Route::get('nationality-list', [NationalityController::class, 'getNationalities'])->name('nationality.list');
    Route::get('export-nationality', [NationalityController::class, 'exportNationalities'])->name('nationality.export');
    Route::post('import-nationality', [NationalityController::class, 'importNationality'])->name('import.nationality');
});
