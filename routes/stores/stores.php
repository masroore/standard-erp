<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Stores\StoBrandController;
use App\Http\Controllers\Backend\Stores\StoCategoryController;
use App\Http\Controllers\Backend\Stores\StoUnitController;
use App\Http\Controllers\Backend\Stores\StoStoreController;
use App\Http\Controllers\Backend\Stores\StoItemController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web stores Routes
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

        Route::resource('brands', StoBrandController::class);
        Route::resource('categories', StoCategoryController::class);
        Route::resource('units', StoUnitController::class);
        Route::resource('stores', StoStoreController::class);
        Route::resource('items', StoItemController::class);

    });

});
?>
