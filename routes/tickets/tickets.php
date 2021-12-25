<?php

use App\Http\Controllers\Backend\Tickets\TicketController;
use Illuminate\Support\Facades\Route;
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

        Route::resource('tickets', TicketController::class);
        Route::get('tickets/replay/{id?}', [TicketController::class,'getTicketReplay'])->name('tickets.replay');
        Route::post('tickets/replay/store', [TicketController::class,'AddTicketReplay'])->name('tickets.replay.store');
        Route::post('tickets/moveTicket', [TicketController::class,'moveTicket'])->name('tickets.moveTicket');
        Route::post('tickets/updateStatus/', [TicketController::class,'updateStatus'])->name('tickets.updateStatus');
        Route::post('tickets/updatePriority/', [TicketController::class,'updatePriority'])->name('tickets.updatePriority');



    });

});
?>
