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
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReturnRequestController;
use App\Http\Controllers\SerialNumberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\ReplaceRequest;
use App\Models\Transaction;;

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
    Route::post('/update', [ReplaceRequestController::class, 'update'])->name('replace.update');
    Route::get('/select/{id}', [ReplaceRequestController::class, 'select'])->name('replace.select');
    Route::get('/replacePdf', [ReplaceRequestController::class, 'viewPdf'])->name('replacePdf');
    Route::get('/downloadreplacePdf', [ReplaceRequestController::class, 'download'])->name('downloadreplacePdf');
});

// For Repair Request Routes
Route::group(['middleware' => 'auth', 'prefix' => '/repair-request'], function () {
    Route::get('/', [RepairRequestController::class, 'index'])->name('repair.request');
    Route::get('/create', [RepairRequestController::class, 'create'])->name('repair.create');
    Route::post('/store', [RepairRequestController::class, 'store'])->name('repair.store');
    Route::post('/destroy', [RepairRequestController::class, 'destroy'])->name('repair.destroy');
    Route::post('/update', [RepairRequestController::class, 'update'])->name('repair.update');
    Route::get('/select/{id}', [RepairRequestController::class, 'select'])->name('repair.select');
    Route::get('/repairPdf', [RepairRequestController::class, 'viewPdf'])->name('repairPdf');
    Route::get('/downloadrepairPdf', [RepairRequestController::class, 'download'])->name('downloadrepairPdf');
});


// For Purchase Request Routes
Route::group(['middleware' => 'auth', 'prefix' => '/purchase-request'], function () {
    Route::get('/', [PurchaseRequestController::class, 'index'])->name('purchase.request');
    Route::get('/create', [PurchaseRequestController::class, 'create'])->name('purchase.create');
    Route::post('/store', [PurchaseRequestController::class, 'store'])->name('purchase.store');
    Route::post('/destroy', [PurchaseRequestController::class, 'destroy'])->name('purchase.destroy');
    Route::post('/update', [PurchaseRequestController::class, 'update'])->name('purchase.update');
    Route::get('/select/{id}', [PurchaseRequestController::class, 'select'])->name('purchase.select');
    Route::get('/purchasePdf', [PurchaseRequestController::class, 'viewPdf'])->name('purchasePdf');
    Route::get('/dlpurchasePdf', [PurchaseRequestController::class, 'download'])->name('dlpurchasePdf');
});


// For return Request Routes
Route::group(['middleware' => 'auth', 'prefix' => '/return-request'], function () {
    Route::get('/', [ReturnRequestController::class, 'index'])->name('return.request');
    Route::get('/create', [ReturnRequestController::class, 'create'])->name('return.create');
    Route::post('/store', [ReturnRequestController::class, 'store'])->name('return.store');
    Route::post('/destroy', [ReturnRequestController::class, 'destroy'])->name('return.destroy');
    Route::post('/update', [ReturnRequestController::class, 'update'])->name('return.update');
    Route::get('/select/{id}', [ReturnRequestController::class, 'select'])->name('return.select');
    Route::get('/viewPdf', [ReturnRequestController::class, 'viewPdf'])->name('viewPdf');
    Route::get('/downloadPdf', [ReturnRequestController::class, 'download'])->name('downloadPdf');
});


Route::group(['middleware' => 'auth', 'prefix' => '/ProfileItem'], function () {
    Route::get('/', [ItemProfileController::class, 'create'])->name('itemshow');
    Route::post('/store', [ItemProfileController::class, 'store'])->name('itemstore');
    Route::get('/select/{id}', [ItemProfileController::class, 'select'])->name('item.select');
    Route::put('/update', [ItemProfileController::class, 'update'])->name('item.update');
    Route::post('/destroy', [ItemProfileController::class, 'destroy'])->name('item.destroy');
    Route::put('/update-thumbnail', [ItemProfileController::class, 'updateThumbnail'])->name('item.thumbnail.update');
    Route::put('/update-media', [ItemProfileController::class, 'updatephoto'])->name('item.media.update');
});

Route::group(['middleware' => 'auth', 'prefix' => '/serial'], function () {
    Route::post('/store', [SerialNumberController::class, 'store'])->name('serial.store');
    Route::put('/update', [SerialNumberController::class, 'update'])->name('serial.update');
    Route::delete('/destroy', [SerialNumberController::class, 'destroy'])->name('serial.destroy');
});
// Route::put('/ItemListEdit', [ItemProfileController::class, 'listEdit'])->name('itemstore');



Route::get('/profile', [UserController::class, 'index'])->name('profile');
Route::put('profile.update', [UserController::class, 'update'])->name('profile.update');
Route::put('profile.updatepass', [UserController::class, 'updatepass'])->name('profile.updatepass');




Route::get('/view', [ReportsController::class, 'download'])->name('view')->middleware('auth');
Route::get('/viewonly', [ReportsController::class, 'view'])->name('viewonly')->middleware('auth');
Route::get('/reports', [ReportsController::class, 'index'])->name('reports.buttons')->middleware('auth');



Route::post('/add', [EmployeeController::class, 'badgeadd'])->name('badge.add');
Route::get('/Accounts', [ReportsController::class, 'show'])->name('viewUser');
Route::put('/users/{id}', [ReportsController::class, 'update'])->name('updateUser');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction');
// Route::post('/ProfileItem', [ItemProfileController::class, 'updatenxt'])->name('updatenxt');
