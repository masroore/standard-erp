<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UsersManagment\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('dashboard')->name('dashboard.')->group(function(){


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // //role routes
    // Route::get('all-permissions', 'Backend\UsersManagment\RoleController@getAllPermissions');
    // Route::get('all-roles', 'Backend\UsersManagment\RoleController@index');
    // Route::post('save-role', 'Backend\UsersManagment\RoleController@store');
    // Route::post('update-role/{id}', 'Backend\UsersManagment\RoleController@update');
    // Route::post('delete-role/{id}', 'Backend\UsersManagment\RoleController@destroy');

    // // users routes


    // //include  app_path('routes/users/users.php');



    // // parent company routes
    // Route::get('all-parent-companies', 'Backend\Customers\ParentCompanyController@index');
    // Route::post('add-parent-company', 'Backend\Customers\ParentCompanyController@store');
    // Route::post('delete-parent-company/{id}', 'Backend\Customers\ParentCompanyController@destroy');
    // Route::post('update-parent-company/{id}', 'Backend\Customers\ParentCompanyController@update');

    // // Customer Group routes
    // Route::get('all-customer-groups', 'Backend\Customers\CustomerGroupController@index');
    // Route::post('add-customer-group', 'Backend\Customers\CustomerGroupController@store');
    // Route::post('delete-customer-group/{id}', 'Backend\Customers\CustomerGroupController@destroy');
    // Route::post('update-customer-group/{id}', 'Backend\Customers\CustomerGroupController@update');

    // // Customers  routes
    // Route::get('all-customers', 'Backend\Customers\CustomerController@index');
    // Route::get('get-customer-by-id/{id}', 'Backend\Customers\CustomerController@getById');
    // Route::post('add-customer', 'Backend\Customers\CustomerController@store');
    // Route::post('delete-customer/{id}', 'Backend\Customers\CustomerController@destroy');
    // Route::post('update-customer/{id}', 'Backend\Customers\CustomerController@update');

    // // Suppliers  routes
    // Route::get('all-suppliers', 'Backend\Customers\SupplierController@index');
    // Route::get('get-supplier-by-id/{id}', 'Backend\Customers\SupplierController@getById');
    // Route::post('add-supplier', 'Backend\Customers\SupplierController@store');
    // Route::post('delete-supplier/{id}', 'Backend\Customers\SupplierController@destroy');
    // Route::post('update-supplier/{id}', 'Backend\Customers\SupplierController@update');

    // // Contacts  routes
    // Route::get('all-contacts', 'Backend\Customers\ContactController@index');
    // Route::get('get-contact-by-id/{id}', 'Backend\Customers\ContactController@getById');
    // Route::post('add-contact', 'Backend\Customers\ContactController@store');
    // Route::post('delete-contact/{id}', 'Backend\Customers\ContactController@destroy');
    // Route::post('update-contact/{id}', 'Backend\Customers\ContactController@update');

    // // Bank info   routes
    // Route::get('all-bank-info', 'Backend\Customers\BankInfoController@index');
    // Route::get('get-bank-info-by-id/{id}', 'Backend\Customers\BankInfoController@getById');
    // Route::post('add-bank-info', 'Backend\Customers\BankInfoController@store');
    // Route::post('delete-bank-info/{id}', 'Backend\Customers\BankInfoController@destroy');
    // Route::post('update-bank-info/{id}', 'Backend\Customers\BankInfoController@update');

    // // Departments routes
    // Route::get('all-departments', 'Backend\Hr\DepartmentController@index');
    // Route::get('get-department-by-id/{id}', 'Backend\Hr\DepartmentController@getById');
    // Route::post('add-department', 'Backend\Hr\DepartmentController@store');
    // Route::post('update-department', 'Backend\Hr\DepartmentController@update');
    // Route::post('delete-department', 'Backend\Hr\DepartmentController@destroy');


    // // Tickets routes
    // Route::get('all-tickets', 'Backend\Tickets\TicketController@index');
    // Route::get('get-ticket-detailes/{id}', 'Backend\Tickets\TicketController@show');
    // Route::post('add-ticket', 'Backend\Tickets\TicketController@store');
    // Route::post('update-ticket', 'Backend\Tickets\TicketController@update');
    // Route::post('delete-ticket', 'Backend\Tickets\TicketController@destroy');
    // Route::post('move-ticket', 'Backend\Tickets\TicketController@moveTicket');
    // Route::post('update-priority', 'Backend\Tickets\TicketController@updatePriority');
    // Route::post('update-status', 'Backend\Tickets\TicketController@updateStatus');


    // // Ticket Reply
    // Route::post('add-ticket-reply', 'Backend\Tickets\TicketController@AddTicketReplay');
    // Route::get('get-ticket-replies/{id}', 'Backend\Tickets\TicketController@getTicketReplay');
    // Route::get('get-ticket-attachments/{id}', 'Backend\Tickets\TicketController@getTicketAttachment');

});

});
