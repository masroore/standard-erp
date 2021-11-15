<?php

use App\Http\Controllers\BackEnd\Customers\CustomerController;
use App\Http\Controllers\BackEnd\Customers\CustomerGroupController;
use App\Http\Controllers\BackEnd\Customers\ParentCompanyController;
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


Route::resource('customers', CustomerController::class);
Route::resource('customerGroup', CustomerGroupController::class);
Route::resource('parentCompany', ParentCompanyController::class);



});

});
?>
