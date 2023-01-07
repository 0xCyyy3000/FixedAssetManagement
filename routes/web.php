<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemProfileController;
use App\Http\Controllers\ListingItem;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest', 'prefix' => '/register'], function () {
    Route::get('/badge-number', [EmployeeController::class, 'create'])->name('register.certify-create');
    Route::post('/certify', [EmployeeController::class, 'certify'])->name('register.certify');
    Route::post('/store', [RegisterController::class, 'store'])->name('register.store');
});

Route::get('/ProfileItem', [ItemProfileController::class, 'create'])->name('itemshow');
Route::post('/ProfileItem', [ItemProfileController::class, 'store'])->name('itemstore');

Route::put('/ItemListEdit', [ItemProfileController::class, 'listEdit'])->name('itemstore');
Route::get('/ItemList', [ItemProfileController::class, 'view'])->name('itemlist');


Route::get('/ProfileItem/page2' , [ItemProfileController::class, 'nextview'])->name('itemshownext');
Route::put('/latest' , [ItemProfileController::class, 'update']);
// Route::post('/ProfileItem', [ItemProfileController::class, 'updatenxt'])->name('updatenxt');


