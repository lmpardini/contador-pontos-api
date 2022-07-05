<?php

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

Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
      Route::post('/auth/login', 'login');
});

Route::prefix('admin')->middleware('auth:sanctum')->controller(\App\Http\Controllers\UsersController::class)->group(function () {
    Route::post('users', 'criarUsuario');
});

Route::prefix('auth')->middleware('auth:sanctum')->controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
    Route::post('logout', 'logout');
});



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
