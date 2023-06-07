<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KendaraanController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->apiResource('kendaraan', KendaraanController::class);
// Route::apiResource('kendaraan', KendaraanController::class);
Route::get('/kendaraan/error/validation', [KendaraanController::class, 'validationError'])->name('kendaraan.error.validation');
Route::get('/auth/error/unauthorized', [AuthController::class, 'unauthorized'])->name('auth.unauthorized');
