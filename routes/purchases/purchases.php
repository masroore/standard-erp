<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Purchases\SupplierController;
use App\Http\Controllers\Backend\Purchases\PurchaseInvoiceController;
use App\Http\Controllers\Backend\Purchases\PurchaseOperationController;
use App\Http\Controllers\Backend\Purchases\PurchaseOrderController;
use App\Http\Controllers\Backend\Purchases\PurchasePaymentController;
use App\Http\Controllers\Backend\Purchases\PurchaseReceiveController;
use App\Http\Controllers\Backend\Purchases\PurchaseRequisitionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' =>['localeSessionRedirect','localizationRedirect','localeViewPath']], function()
{

    Route::prefix('dashboard')->name('dashboard.')->group(function(){

        // purchase operation route
        Route::resource('purchase-operations', PurchaseOperationController::class);

        //invoice purchase routes
        Route::resource('purchases', PurchaseInvoiceController::class);
        Route::get('purchases/search/{value?}/{id?}', [PurchaseInvoiceController::class,'search']);
        Route::get('purchases/receives/{supplier?}', [PurchaseInvoiceController::class,'getReceivesToCreateInvoice']);
        Route::get('purchases/receives/items/{items?}', [PurchaseInvoiceController::class,'getReceivesItemsToCreateInvoice']);

        //purchase-orders routes
        Route::resource('purchase-orders', PurchaseOrderController::class);
        Route::get('purchase-orders/search/{value?}/{id?}', [PurchaseOrderController::class,'search']);

        //suppliers routes
        Route::resource('suppliers', SupplierController::class);
        Route::get('suppliers/supplier-contacts/{id}', [SupplierController::class,'supplierContacts'])->name('supplier.contacts');

        //purchase requisition routes
        Route::resource('purchase-requisitions', PurchaseRequisitionController::class);
        Route::get('purchase-requisitions/search/{value?}/{id?}', [PurchaseRequisitionController::class,'search']);
        Route::get('purchase-requisitions/offer-price-request/{id}', [PurchaseRequisitionController::class,'offerPriceRequest'])->name('purchase-requisitions.offer-price-request');
        Route::get('purchase-requisitions/offer-price-request/show/{id}', [PurchaseRequisitionController::class,'showOfferPriceRequest'])->name('purchase-requisitions.offer-price-request.show');
        Route::get('purchase-requisitions/offer-price-request/reply/{id}', [PurchaseRequisitionController::class,'replyOfferPriceRequest'])->name('purchase-requisitions.offer-price-request.reply');

        // purchases receives
        Route::resource('receives', PurchaseReceiveController::class);
        Route::get('receives/search/{value?}/{id?}', [PurchaseReceiveController::class,'search']);

        // purchase Payments
        Route::resource('purchases-payments', PurchasePaymentController::class);
        Route::get('purchases-payments/payments/{id}', [PurchasePaymentController::class,'show']);
        Route::get('purchases-payments/all-payments', [PurchasePaymentController::class,'data']);

    });

});
?>
