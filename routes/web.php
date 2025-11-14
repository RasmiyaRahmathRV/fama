<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

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
    Route::resource('user', UserController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('contract', ContractController::class);
    Route::resource('agreement', AgreementController::class);




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

    Route::get('user-list', [UserController::class, 'getUsers'])->name('user.list');
    Route::get('user-createoredit/{id?}', [UserController::class, 'createOrEdit'])->name('user.createoredit');
    Route::get('export-user', [UserController::class, 'exportUsers'])->name('user.export');

    Route::get('company-list', [CompanyController::class, 'getCompanies'])->name('company.list');
    Route::get('export-company', [CompanyController::class, 'exportCompany'])->name('company.export');

    Route::get('contract-list', [ContractController::class, 'getContracts'])->name('contract.list');
    Route::post('contract-approve', [ContractController::class, 'approveContract'])->name('contract.approve');
    Route::post('contract-reject', [ContractController::class, 'rejectContract'])->name('contract.reject');
    Route::get('contract-documents', [ContractController::class, 'contract_documents'])->name('contract.documents');
    Route::post('contract-document-upload', [ContractController::class, 'document_upload'])->name('contract.document_upload');
    Route::get('export-contract', [ContractController::class, 'exportContract'])->name('contract.export');

    Route::delete('contracts/unit-detail/{id}', [ContractController::class, 'deleteUnitDetail'])
        ->name('contracts.unit-detail.delete');
    Route::delete('contracts/payment-detail/{id}', [ContractController::class, 'deletePaymentDetail'])
        ->name('contracts.payment-detail.delete');
    Route::delete('contracts/payment-receivable/{id}', [ContractController::class, 'deletePaymentReceivable'])
        ->name('contracts.payment-receivable.delete');


    Route::get('agreement-list', [AgreementController::class, 'getAgreements'])->name('agreement.list');
    Route::get('export-agreement', [AgreementController::class, 'exportAgreement'])->name('agreement.export');
    Route::get('print-view', [AgreementController::class, 'print_view'])->name('agreement.printview');


    // renewal
    Route::get('renewal-pending-list', [ContractController::class, 'getRenewalPendingContracts'])->name('contract.renewal_pending_list');
    Route::get('renewal-list', [ContractController::class, 'getRenewalContractsList'])->name('contract.renewal_list');
    Route::get('contract/{id}/renew', [ContractController::class, 'renewContracts'])->name('contract.renew');
    Route::post('contract/{id}/reject-renewal', [ContractController::class, 'rejectRenewal'])->name('contract.reject_renew');


    // projectScope
    Route::get('/export-building-summary/{id}', [ContractController::class, 'exportBuildingSummary']);
});
