<?php

use App\Http\Controllers\Auth\AuthController;
use App\Logic\ExternalApi\ApiRosreestr;
use App\Models\RealEstateObject;
use App\Models\RealEstateObjectQuery;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Роуты без аутентификации
|--------------------------------------------------------------------------
*/

// Вход
Route::post('/auth/login', [AuthController::class, 'login']);
// Выход
Route::post('/auth/logout', [AuthController::class, 'logout']);
// Запрос статуса авторизации пользователя
Route::post('/auth/check', [AuthController::class, 'check']);

// Test
Route::get('/test', function () {
    return 'API PUBLIC OK';
});
