<?php

use App\Http\Controllers\Api\V1\AssignmentsController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TasksCotroller;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class,'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tasks', TasksCotroller::class);
        Route::apiResource('users', UserController::class)->only(['index','show','destroy'])->middleware('abilities:tasks.manager');
        Route::apiResource('assigned', AssignmentsController::class);

        Route::get('logout', [AuthController::class,'logout']);
    });
});
