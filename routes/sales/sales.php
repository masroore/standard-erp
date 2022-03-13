<?php

use App\Http\Controllers\Backend\Sales\SalDeliverController;
use App\Http\Controllers\Backend\Sales\SalePaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Sales\SalInvoiceController;
use App\Http\Controllers\Backend\Sales\SalOrderedSupplyCustomerController;
use App\Http\Controllers\Backend\Sales\SalQuotationController;
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

    Route::prefix('dashboard')->name('dashboard.')->group(function(){

        // route here

        Route::resource('delivers', SalDeliverController::class);
        Route::get('delivers/search/{value?}/{id?}', [SalDeliverController::class,'search']);

        Route::resource('sales', SalInvoiceController::class);
        Route::get('sales/search/{value?}/{id?}', [SalInvoiceController::class,'search']);
        Route::get('sales/delivers/{customer?}', [SalInvoiceController::class,'getDeliversToCreateInvoice']);
        Route::get('sales/delivers/items/{items?}', [SalInvoiceController::class,'getDeliversItemsToCreateInvoice']);

        Route::resource('quotations', SalQuotationController::class);
        Route::get('quotations/search/{value?}/{id?}', [SalQuotationController::class,'search']);

        Route::resource('customer-order-supply', SalOrderedSupplyCustomerController::class);
        Route::get('customer-order-supply/search/{value?}/{id?}', [SalOrderedSupplyCustomerController::class,'search']);

        Route::resource('sales-payments', SalePaymentController::class);
        Route::get('sales-payments/payments/{id}', [SalePaymentController::class,'show']);
        Route::get('sales-payments/all-payments', [SalePaymentController::class,'data']);

    });

});
?>
