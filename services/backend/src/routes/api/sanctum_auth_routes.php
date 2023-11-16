<?php

use App\Http\Controllers\RealEstateObjects\RealEstateObjectsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Роуты для пользователей, авторизованных с помощью sanctum
|--------------------------------------------------------------------------
*/

// API получения данных об объектах недвижимости
Route::prefix('real-estate-objects')->group(function () {
    // Получение сведений об объекте недвижимости по кадастровому номеру
    Route::post('/get-object-by-cadastral-number', [RealEstateObjectsController::class, 'getObjectByCadastralNumber']);
});

// Test
Route::get('/auth-test', function () {
    return 'API AUTH OK';
});
