<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Sales\SalInvoiceController;
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

        Route::resource('sales', SalInvoiceController::class);
        Route::resource('quotations', SalQuotationController::class);
        Route::get('sales/search/{value?}/{id?}', [SalInvoiceController::class,'search']);
        Route::get('quotations/search/{value?}/{id?}', [SalQuotationController::class,'search']);

    });

});
?>
