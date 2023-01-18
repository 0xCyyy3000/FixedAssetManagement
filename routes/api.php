<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemProfileController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'guest', 'prefix' => '/certify'], function () {
//     Route::get('/', [RegisterController::class, 'createCertification'])->name('register.create');
//     Route::get('/', [EmployeeController::class, 'certify'])->name('register.certify');
// });

Route::group(['prefix' => '/item-list'], function () {
    Route::get('/select/{item_id}', [ItemProfileController::class, 'apiSelect']);
    Route::get('/edit/{item_id}', [ItemProfileController::class, 'apiEdit']);
});
