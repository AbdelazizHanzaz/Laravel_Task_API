<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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

//authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::resource("tasks", TaskController::class);
});


//public endpoints
Route::post('register', [AuthController::class, "register"]);
Route::post('login', [AuthController::class, "login"]);