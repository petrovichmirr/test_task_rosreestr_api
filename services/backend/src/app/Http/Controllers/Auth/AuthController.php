<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Аутентификация пользователя
     *
     * @param LoginRequest $request
     * @return Response
     * @throws ValidationException
     */
    public function login(LoginRequest $request): Response
    {
        $request->authenticate();
        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Завершение сеанса текущего авторизованного пользователя
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }

    /**
     * Запрос статуса авторизации пользователя
     *
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        return response()->json([
            'data' => Auth::check(),
            'user' => Auth::user(),
        ]);
    }
}
