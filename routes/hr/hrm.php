<?php

use App\Http\Controllers\BackEnd\Hr\HrAttendanceController;
use App\Http\Controllers\BackEnd\Hr\HrDepartmentController;
use App\Http\Controllers\Backend\Hr\HrEmployeeController;
use App\Http\Controllers\BackEnd\Hr\HrEmployeeFileController;
use App\Http\Controllers\BackEnd\Hr\HrHolidayController;
use App\Http\Controllers\BackEnd\Hr\HrMedicalController;
use App\Http\Controllers\BackEnd\Hr\HrRewardController;
use App\Http\Controllers\BackEnd\Hr\HrWorkdayController;
use App\Http\Controllers\BackEnd\Hr\Payroll\HrSalaryEmployeeController;
use App\Http\Controllers\BackEnd\Hr\Payroll\HrSalaryGenerateController;
use App\Http\Controllers\BackEnd\Hr\Payroll\HrSalarySetupController;
use App\Http\Controllers\BackEnd\Hr\Payroll\HrSalaryTypeController;
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


        // Payroll routes
        Route::resource('salaryTypes', HrSalaryTypeController::class);
        Route::resource('salarySetups', HrSalarySetupController::class);
        Route::resource('salaryGenerate', HrSalaryGenerateController::class);
        Route::resource('salaryEmployee', HrSalaryEmployeeController::class);
        Route::get('salaryEmployee/index/{id?}', [HrSalaryEmployeeController::class,'index'])->name('salaryEmployee.index');
        Route::get('salaryEmployee/invoice/{id?}', [HrSalaryEmployeeController::class,'invoice'])->name('salaryEmployee.invoice');

        // Holiday
        Route::resource('workdays', HrWorkdayController::class);
        Route::post('workdays/status/{id?}', [HrWorkdayController::class,'update']);

        Route::resource('holidays', HrHolidayController::class);



    });

});
?>
