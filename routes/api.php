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

    /** AuthController */
    Route::prefix('auth')->controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
        Route::get('logged', 'logged');
        Route::post('logout', 'logout');
    });

    /** UsersController */
    Route::prefix('admin')->controller(\App\Http\Controllers\UsersController::class)->group(function () {
        Route::post('users', 'criarUsuario');
        Route::get('users', 'listarTodosUsuarios');
        Route::get('users/{id}', 'listarUsuarioPorId');
        Route::delete('users/{id}', 'deletarUsuarioPorId');
    });

    /** PartidasController */
    Route::prefix('partida')->controller(\App\Http\Controllers\UsersController::class)->group(function () {
        Route::post('/', 'criarPartida');
        Route::get('/', 'listarTodasPartidas');
        Route::get('/{id}', 'listarPartidaPorId');
        Route::delete('/{id}', 'deletarPartidaPorId');
    });

    /** RodadasController */
    Route::prefix('rodada')->controller(\App\Http\Controllers\UsersController::class)->group(function () {
        Route::post('/', 'criarRodada');
        Route::get('/', 'listarRodadas');
        Route::get('/{id}', 'listarRodadasPorId');
        Route::delete('/{id}', 'deletarRodadasPorId');
    });
});








