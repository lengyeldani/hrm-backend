<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VacationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function (){
    Route::get('index', [UserController::class, 'index']);
    Route::post('store', [UserController::class, 'store']);
    Route::get('show/{id}', [UserController::class, 'show']);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::delete('delete/{id}',[UserController::class, 'destroy']);
});

Route::prefix('vacations')->group(function (){
    Route::get('index', [VacationController::class, 'index']);
    Route::post('store', [VacationController::class, 'store']);
    Route::get('show/{id}', [VacationController::class, 'show']);
    Route::put('update/{id}', [VacationController::class, 'update']);
    Route::get('showByUser/{id}', [VacationController::class, 'showByUser']);
});

