<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemProfileController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ListingItem;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\RepairRequestController;
use App\Http\Controllers\ReplaceRequestController;
use App\Http\Controllers\ReturnRequestController;;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/test', function () {
    return view('layouts.layout');
});

Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/item-profiles', [HomeController::class, 'itemList'])->name('item.list');
    Route::get('/process-request', [HomeController::class, 'processRequest'])->name('process.request');
    Route::get('/data-entry', [HomeController::class, 'dataEntry'])->name('data.entry');
    Route::get('/reports', [HomeController::class, 'reports'])->name('reports');
});

Route::group(['middleware' => 'guest', 'prefix' => '/register'], function () {
    Route::get('/badge-number', [EmployeeController::class, 'create'])->name('register.certify-create');
    Route::post('/certify', [EmployeeController::class, 'certify'])->name('register.certify');
    Route::post('/store', [RegisterController::class, 'store'])->name('register.store');
});

// For Replace Request Routes
Route::group(['middleware' => 'auth', 'prefix' => '/replace-request'], function () {
    Route::get('/', [ReplaceRequestController::class, 'index'])->name('replace.request');
    Route::get('/create', [ReplaceRequestController::class, 'create'])->name('replace.create');
    Route::post('/store', [ReplaceRequestController::class, 'store'])->name('replace.store');
    Route::post('/destroy', [ReplaceRequestController::class, 'destroy'])->name('replace.destroy');
});

// For Repair Request Routes
Route::group(['middlware' => 'auth', 'prefix' => '/repair-request'], function () {
    Route::get('/', [RepairRequestController::class, 'index'])->name('repair.request');
    Route::get('/create', [RepairRequestController::class, 'create'])->name('repair.create');
    Route::post('/store', [RepairRequestController::class, 'store'])->name('repair.store');
    Route::post('/destroy', [RepairRequestController::class, 'destroy'])->name('repair.destroy');
});


// For Purchase Request Routes
Route::group(['middleware' => 'auth', 'prefix' => '/purchase-request'], function () {
    Route::get('/', [PurchaseRequestController::class, 'index'])->name('purchase.request');
    Route::get('/create', [PurchaseRequestController::class, 'create'])->name('purchase.create');
    Route::post('/store', [PurchaseRequestController::class, 'store'])->name('purchase.store');
    Route::post('/destroy', [PurchaseRequestController::class, 'destroy'])->name('purchase.destroy');
});

// For return Request Routes
Route::group(['middleware' => 'auth', 'prefix' => '/return-request'], function () {
    Route::get('/', [ReturnRequestController::class, 'index'])->name('return.request');
    Route::get('/create', [ReturnRequestController::class, 'create'])->name('return.create');
    Route::post('/store', [ReturnRequestController::class, 'store'])->name('return.store');
    Route::post('/destroy', [ReturnRequestController::class, 'destroy'])->name('return.destroy');
});


Route::group(['middleware' => 'auth', 'prefix' => '/ProfileItem'], function () {
    Route::get('/', [ItemProfileController::class, 'create'])->name('itemshow');
    Route::post('/store', [ItemProfileController::class, 'store'])->name('itemstore');
    Route::get('/select/{id}', [ItemProfileController::class, 'select'])->name('item.select');
    Route::put('/update', [ItemProfileController::class, 'update'])->name('item.update');
    Route::post('/destroy', [ItemProfileController::class, 'destroy'])->name('item.destroy');
});
// Route::put('/ItemListEdit', [ItemProfileController::class, 'listEdit'])->name('itemstore');

// Route::post('/ProfileItem', [ItemProfileController::class, 'updatenxt'])->name('updatenxt');
