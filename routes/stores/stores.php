<?php

use App\Http\Controllers\Backend\Stores\PriceListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Stores\StoBrandController;
use App\Http\Controllers\Backend\Stores\StoCategoryController;
use App\Http\Controllers\Backend\Stores\StoUnitController;
use App\Http\Controllers\Backend\Stores\StoStoreController;
use App\Http\Controllers\Backend\Stores\StoItemController;
use App\Http\Controllers\Backend\Stores\StoTagController;
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

    Route::prefix('dashboard/stores')->name('dashboard.stores.')->group(function(){

        // route here

        Route::resource('brands', StoBrandController::class);
        Route::resource('categories', StoCategoryController::class);
        Route::resource('units', StoUnitController::class);
        Route::resource('stores', StoStoreController::class);
        Route::resource('items', StoItemController::class);
        Route::get('items/export/excel-sheet', [StoItemController::class, 'export'])->name('export.items.excellsheet');
        Route::post('items/import/excell',[StoItemController::class, 'import'])->name('import.items.excellsheet');
        Route::resource('tags', StoTagController::class);
        Route::resource('priceList', PriceListController::class);
        Route::get('priceList/search/{value?}/{id?}', [PriceListController::class,'search']);

        Route::get('getchaildunit', [StoItemController::class, 'selectUnits'])->name('unitschaild');
        Route::get('items/search/{value?}/{id?}', [StoItemController::class,'search']);


        Route::get('categories/export/excel-sheet', [StoCategoryController::class, 'exportExcell'])->name('export.categories.excellsheet');


    });

});
?>
