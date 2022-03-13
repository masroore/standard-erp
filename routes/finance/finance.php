<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Finance\FinAccountController;
use App\Http\Controllers\Backend\Finance\FinBankController;
use App\Http\Controllers\Backend\Finance\FinJournalController;
use App\Http\Controllers\Backend\Finance\FinSettingController;
use App\Http\Controllers\Backend\Finance\FinTransactionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web finace Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' =>['localeSessionRedirect','localizationRedirect','localeViewPath']], function()
{

    Route::prefix('dashboard/finance')->name('dashboard.finance.')->group(function(){

        // route here

        Route::resource('accounts', FinAccountController::class);
        Route::resource('journals', FinJournalController::class);
        Route::resource('finSettings', FinSettingController::class);
        Route::resource('banks', FinBankController::class);

        /// transactions routes

        Route::get('transactions/payment-to-supplier', [ FinTransactionController::class, 'paymentToSupplier'])->name('transactions.payment-to-supplier');
        Route::post('transactions/payment-to-supplier', [ FinTransactionController::class, 'saveSupplierPayment'])->name('transactions.save.payment-to-supplier');

        Route::get('transactions/customer-payment', [ FinTransactionController::class, 'customerPayment'])->name('transactions.customer-payment');
        Route::post('transactions/customer-payment', [ FinTransactionController::class, 'saveCustomerPayment'])->name('transactions.save.customer-payment');
        Route::get('transactions/checks', [ FinTransactionController::class, 'getAllChecks'])->name('transactions.checks.all');
        Route::post('transactions/checks/change-status', [ FinTransactionController::class, 'changeChekStatus'])->name('transactions.checks.change.status');


    });

});
?>
