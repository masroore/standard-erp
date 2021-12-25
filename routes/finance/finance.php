<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Finance\FinAccountController;
use App\Http\Controllers\Backend\Finance\FinJournalController;
use App\Http\Controllers\Backend\Finance\FinSettingController;
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


    });

});
?>
