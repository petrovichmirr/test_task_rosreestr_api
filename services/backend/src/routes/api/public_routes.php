<?php

use App\Http\Controllers\Auth\AuthController;
use App\Logic\ExternalApi\ApiRosreestr;
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
//    $cadastralNumber = '52:18:0070256:1560';
//    $gknData = ApiRosreestr::getGknObject($cadastralNumber);
//
//    return response()->json($gknData);

    return 'API PUBLIC OK';
});
