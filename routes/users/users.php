<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UsersManagment\UserController;
use App\Http\Controllers\Backend\UsersManagment\RoleController;
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

Route::get('/all-users',          [UserController::class, 'index'])->name('users.all');
Route::get('/all-users/a',        [UserController::class, 'allusers'])->name('users.all.a');
Route::get('get-user-by-id/{id}', [UserController::class, 'getUserById'])->name('get.one.user');
Route::post('add-user',           [UserController::class, 'store'])->name('add.user');
Route::post('delete-user/{id}',   [UserController::class, 'destroy'])->name('delete.user');
Route::post('update-user/{id}',   [UserController::class, 'update'])->name('update.user');
Route::post('manage-profile/{id}',[UserController::class, 'manageProfile'])->name('namage.profile');
Route::post('edit-password/{id}', [UserController::class, 'editPassword'])->name('edit.password');
Route::get('users/create',        [UserController::class, 'create'])->name('users.create');
Route::get('users/edit/{id}',     [UserController::class, 'edit'])->name('users.edit');

Route::resource('roles', RoleController::class);



});

});
?>
