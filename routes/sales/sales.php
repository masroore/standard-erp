<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\sales\SalInvoiceController;
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

        Route::resource('invoices', SalInvoiceController::class);

        Route::get('invoices/search/{value?}', [SalInvoiceController::class,'search']);

    });

});
?>