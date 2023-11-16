<?php

namespace App\Http\Controllers\RealEstateObjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstateObjects\GetObjectByCadastralNumberRequest;
use App\Logic\RealEstateObjects;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class RealEstateObjectsController extends Controller
{
    /**
     * Получение сведений об объекте недвижимости по кадастровому номеру
     *
     * @param GetObjectByCadastralNumberRequest $request
     * @return JsonResponse
     */
    public function getObjectByCadastralNumber(GetObjectByCadastralNumberRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(RealEstateObjects::getObjectByCadastralNumber($validated['cadastral_number']));
    }

    /**
     * Получение списка объектов недвижимости, запрошенных текущим пользователем
     *
     * @return JsonResponse
     */
    public function getObjects(): JsonResponse
    {
        return response()->json([
            'data' => RealEstateObjects::getObjects(),
        ]);
    }
}
