<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PhpInfoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\EmployeeListingController;


// LOGIN/LOGOUT/REGISTER
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
Route::post('/logout', [ AuthController::class, 'logout' ])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    
    // HOME
    Route::get('/', [ HomeController::class, 'home' ])->name('home');

    // SERVICES
    Route::get('/service', [ ServiceController::class, 'index' ])->name('service');
    Route::post('/service/store', [ ServiceController::class, 'store' ])->name('service.store');
    Route::put('/service/update', [ ServiceController::class, 'update' ])->name('service.update');
    Route::delete('/service/destroy', [ ServiceController::class, 'destroy' ])->name('service.destroy');

    // PRODUCT
    Route::get('/product',[ ProductController::class, 'index' ])->name('product');
    Route::post('/product/store', [ ProductController::class, 'store' ])->name('product.store');
    Route::put('/product/update', [ ProductController::class, 'update' ])->name('product.update');
    Route::delete('/product/destroy', [ ProductController::class, 'destroy' ])->name('product.destroy');

    // CUSTOMER
    Route::get('/customer',[ CustomerController::class, 'index' ])->name('customer');
    Route::post('/customer/store', [ CustomerController::class, 'store' ])->name('customer.store');
    Route::put('/customer/update', [ CustomerController::class, 'update' ])->name('customer.update');
    Route::delete('/customer/destroy', [ CustomerController::class, 'destroy' ])->name('customer.destroy');

    // LISTINGS
    Route::get('/total', [ TransactionController::class, 'index' ])->name('total');
    Route::get('/employeeListing', [ EmployeeListingController::class,'index' ])->name('employeeListing');

    // ACCOUNT SETTINGS
    Route::get('/accountSettings', [ AccountSettingsController::class, 'index' ])->name('accountSettings');
    Route::put('/accountSettings/update', [ AccountSettingsController::class, 'update' ])->name('accountSettings.update');

    // GENERAL SETTINGS
    Route::get('/generalSettings', [ AccountSettingsController::class,'generalSettings'])->name('generalSettings');
    Route::delete('/generalSettings', [ AccountSettingsController::class,'destroy' ])->name('generalSettings.destroy');

    // RESOURCES
    Route::get('/resources', [ ResourceController::class, 'index' ])->name('resources.index');
        // Tools
    Route::post('/resources/storeTool', [ ResourceController::class, 'storeTool' ])->name('resources.storeTool');
    Route::put('/resources/updateTool', [ ResourceController::class, 'updateTool' ])->name('resources.updateTool');
    Route::delete('/resources/destroyTool', [ ResourceController::class, 'destroyTool' ])->name('resources.destroyTool');
        // Rooms
    Route::post('/resources/storeRoom', [ ResourceController::class, 'storeRoom' ])->name('resources.storeRoom');
    Route::put('/resources/updateRoom', [ ResourceController::class, 'updateRoom' ])->name('resources.updateRoom');
    Route::delete('/resources/destroyRoom', [ ResourceController::class, 'destroyRoom' ])->name('resources.destroyRoom');

    // USER ACCOUNTS
    Route::get('/userAccounts', [ UserController::class, 'index' ])->name('userAccounts');
    Route::post('/userAccounts/store', [ UserController::class,'store' ])->name('userAccounts.store');
    Route::put('/userAccounts/update', [ UserController::class,'update' ])->name('userAccounts.update');
    Route::delete('/userAccounts/destory', [ UserController::class,'destroy' ])->name('userAccounts.destroy');

    // COMPANIES
    Route::get('/companyInfo', [CompanyController::class, 'index'])->name('companyInfo');
    Route::put('/companyInfo/update', [CompanyController::class, 'update'])->name('companyInfo.update');

    //CALENDAR
    Route::get('/calendar', [CalendarController::class,'index'])->name('calendar');
    Route::post('/calendar/storeEvent', [TransactionController::class, 'newAppointment'])->name('calendar.storeEvent');

    //GROUPS
    Route::get('/group', [GroupsController::class, 'index'])->name('group');
    Route::post('/group/store', [GroupsController::class, 'store'])->name('group.store');
    Route::put('/group/{group}/update', [GroupsController::class, 'update'])->name('group.update');
    Route::delete('/group/delete', [GroupsController::class, 'destroy'])->name('group.destroy');
});



