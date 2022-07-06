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
    /** Rotas Publicas */

    Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
        Route::post('/auth/login', 'login');
    });

    /** Rotas autenticadas */

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
        Route::get('logged', 'logged');
        Route::post('logout', 'logout');
    });

    Route::prefix('admin')->controller(\App\Http\Controllers\UsersController::class)->group(function () {
        Route::post('users', 'criarUsuario');
    });


});








