<?php

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
    /*
    |--------------------------------------------------------------------------
    | Роуты для пользователей, авторизованных с помощью sanctum
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum'])->group(function () {
        require __DIR__ . '/api/sanctum_auth_routes.php';
    });

    /*
    |--------------------------------------------------------------------------
    | Роуты без аутентификации
    |--------------------------------------------------------------------------
    */
    require_once __DIR__ . '/api/public_routes.php';
});
