<?php

use App\Http\Controllers\Backend\Settings\TaxController;
use App\Http\Controllers\Backend\Settings\SettingController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
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


Route::resource('tax', TaxController::class);

Route::get('settings/general-settings' , [SettingController::class, 'general'])->name('settings.general');
Route::post('settings' , [SettingController::class, 'store'])->name('settings.store');



});

});
?>
