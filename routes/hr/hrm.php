<?php

use App\Http\Controllers\Backend\Hr\HrAttendanceController;
use App\Http\Controllers\Backend\Hr\HrDepartmentController;
use App\Http\Controllers\Backend\Hr\HrEmployeeController;
use App\Http\Controllers\Backend\Hr\HrEmployeeFileController;
use App\Http\Controllers\Backend\Hr\HrMedicalController;
use App\Http\Controllers\Backend\Hr\HrRewardController;
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

        Route::resource('employees', HrEmployeeController::class);
        Route::get('employees/profile/{id?}', [HrEmployeeController::class,'profile'])->name('employees.profile');

        Route::resource('departments', HrDepartmentController::class);

        Route::resource('attendances', HrAttendanceController::class);
        Route::post('attendances/search', [HrAttendanceController::class,'search'])->name('attendances.search');

        Route::resource('rewards', HrRewardController::class);
        Route::resource('employeeFiles', HrEmployeeFileController::class);
        Route::resource('medicals', HrMedicalController::class);



    });

});
?>
