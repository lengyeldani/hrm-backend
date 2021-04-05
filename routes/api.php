<?php

use App\Http\Controllers\API\EducationController;
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
Route::middleware(['auth'])->group(function (){
    Route::prefix('users')->group(function (){
        Route::get('index', [UserController::class, 'index']);
        Route::post('store', [UserController::class, 'store']);
        Route::get('show/{id}', [UserController::class, 'show']);
        Route::put('update/{id}', [UserController::class, 'update']);
        Route::delete('delete/{id}',[UserController::class, 'destroy']);
        Route::get('loggedInUser', [UserController::class, 'getLoggedInUser']);
        Route::get('roles', [UserController::class, 'getUserRoles']);
        Route::get('departments',[UserController::class,'getDepartments']);
    });

    Route::prefix('vacations')->group(function (){
        Route::get('index', [VacationController::class, 'index']);
        Route::post('store', [VacationController::class, 'store']);
        Route::get('show/{id}', [VacationController::class, 'show']);
        Route::put('update/{id}', [VacationController::class, 'update']);
        Route::get('showByUser/{id}', [VacationController::class, 'showByUser']);
    });

    Route::prefix('educations')->group(function (){
        Route::get('index', [EducationController::class, 'index']);
        Route::post('store', [EducationController::class, 'store']);
        Route::get('show/{id}', [EducationController::class, 'show']);
        Route::put('update/{id}', [EducationController::class, 'update']);
        Route::get('showByUser/{id}', [EducationController::class, 'showByUser']);
    });
});

