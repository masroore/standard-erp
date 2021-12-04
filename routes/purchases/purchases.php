<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Purchases\SupplierController;
use App\Http\Controllers\Backend\Purchases\PurchaseInvoiceController;
use App\Http\Controllers\Backend\Purchases\PurchaseOrderController;
use App\Http\Controllers\Backend\Purchases\PurchaseRequisitionController;
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

        //invoice purchase routes
        Route::resource('purchases', PurchaseInvoiceController::class);
        Route::get('purchases/search/{value?}/{id?}', [PurchaseInvoiceController::class,'search']);

        //purchase-orders routes
        Route::resource('purchase-orders', PurchaseOrderController::class);
        Route::get('purchase-orders/search/{value?}/{id?}', [PurchaseOrderController::class,'search']);

        //suppliers routes
        Route::resource('suppliers', SupplierController::class);

        //purchase requisition routes
        Route::resource('purchase-requisitions', PurchaseRequisitionController::class);
        Route::get('purchase-requisitions/search/{value?}/{id?}', [PurchaseRequisitionController::class,'search']);
        Route::get('purchase-requisitions/offer-price-request/{id}', [PurchaseRequisitionController::class,'offerPriceRequest'])->name('purchase-requisitions.offer-price-request');
        Route::get('purchase-requisitions/offer-price-request/show/{id}', [PurchaseRequisitionController::class,'showOfferPriceRequest'])->name('purchase-requisitions.offer-price-request.show');
        Route::get('purchase-requisitions/offer-price-request/reply/{id}', [PurchaseRequisitionController::class,'replyOfferPriceRequest'])->name('purchase-requisitions.offer-price-request.reply');




    });

});
?>
