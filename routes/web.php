<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemProfileController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ListingItem;
use App\Http\Controllers\RepairRequestController;
use App\Http\Controllers\ReplaceRequestController;;

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

Route::get('/', [HomeController::class, 'home']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/item-list', [HomeController::class, 'itemList'])->name('item.list');
Route::get('/process-request', [HomeController::class, 'processRequest'])->name('process.request');
Route::get('/data-entry', [HomeController::class, 'dataEntry'])->name('data.entry');
Route::get('/reports', [HomeController::class, 'reports'])->name('reports');

Route::group(['middleware' => 'guest', 'prefix' => '/register'], function () {
    Route::get('/badge-number', [EmployeeController::class, 'create'])->name('register.certify-create');
    Route::post('/certify', [EmployeeController::class, 'certify'])->name('register.certify');
    Route::post('/store', [RegisterController::class, 'store'])->name('register.store');
});

// For Replace Request Routes
Route::get('/replace-request', [ReplaceRequestController::class, 'index'])->name('replace.request');
Route::get('/replace-request/create', [ReplaceRequestController::class, 'create'])->name('replace.create');
Route::post('/replace-request/store', [ReplaceRequestController::class, 'store'])->name('replace.store');
Route::post('/replace-request/destroy', [ReplaceRequestController::class, 'destroy'])->name('replace.destroy');


Route::get('/ProfileItem', [ItemProfileController::class, 'create'])->name('itemshow');
Route::post('/ProfileItem', [ItemProfileController::class, 'store'])->name('itemstore');

Route::put('/ItemListEdit', [ItemProfileController::class, 'listEdit'])->name('itemstore');


Route::get('/ProfileItem/page2', [ItemProfileController::class, 'nextview'])->name('itemshownext');
Route::put('/latest', [ItemProfileController::class, 'update']);
// Route::post('/ProfileItem', [ItemProfileController::class, 'updatenxt'])->name('updatenxt');


// For Repair Request Routes
Route::get('/repair-request', [RepairRequestController::class, 'index'])->name('repair.request');
Route::get('/repair-request/create', [RepairRequestController::class, 'create'])->name('repair.create');
Route::post('/repair-request/store', [RepairRequestController::class, 'store'])->name('repair.store');
Route::post('/repair-request/destroy', [RepairRequestController::class, 'destroy'])->name('repair.destroy');
