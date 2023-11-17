<?php

namespace App\Logic;

use App\Jobs\GetGknObjectJob;
use App\Logic\ExternalApi\ApiRosreestr;
use App\Models\RealEstateObject;
use App\Models\RealEstateObjectQuery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use stdClass;

/**
 * Бизнес - логика: работа с данными об объектах недвижимости
 */
class RealEstateObjects
{
    /**
     * Получение сведений об объекте недвижимости по кадастровому номеру
     *
     * @param string $cadastralNumber
     * @return array
     */
    public static function getObjectByCadastralNumber(string $cadastralNumber): array
    {
        $currentUser = Auth::user();

        // Отправляем задание в очередь
        GetGknObjectJob::dispatch($cadastralNumber, $currentUser->id);

        return [
            'status' => true,
            'text_status' => __('messages.real_estate_object_query_sent'),
        ];
    }

    /**
     * Получение сведений об объекте недвижимости по кадастровому номеру
     *
     * @return Collection
     */
    public static function getObjects(): Collection
    {
        $currentUser = Auth::user();

        return RealEstateObjectQuery::query()
            ->where('user_id', '=', $currentUser->id)
            ->with('realEstateObject')
            ->get();
    }

    public static function handleGknData(stdClass $gknData, int $userId)
    {
        // Проверяем данные
        if (isset($gknData->errorCode)) {
            // Ошибка запроса
            $status = false;

            if ($gknData->errorCode == ApiRosreestr::ERROR_CODE_OBJECT_NOT_FOUND) {
                $textStatus = __('messages.real_estate_object_query_error_not_found');
            } else {
                $textStatus = __('messages.real_estate_object_query_error_other');
            }
        } else {
            // Запрос успешный
            $status = true;
            $textStatus = __('messages.real_estate_object_query_success');
        }

        self::saveRealEstateObjectData($gknData, $status, $textStatus, $userId);
    }

    private static function saveRealEstateObjectData(stdClass $gknData, bool $status, string $textStatus, int $userId)
    {
        // Используем транзакцию
        DB::transaction(function () use ($gknData, $status, $textStatus, $userId) {
            // Если запрос успешный - сохраняем данные объекта
            $realEstateObject = null;
            if ($status) {
                $realEstateObject = RealEstateObject::query()->create([
                    'cadastral_number' => $gknData->objectData->objectCn,
                    'address' => $gknData->objectData->addressNote,
                    'full_data' => $gknData,
                ]);
            }

            RealEstateObjectQuery::query()->create([
                'user_id' => $userId,
                'real_estate_object_id' => $realEstateObject ? $realEstateObject->id : null,
                'status' => $status,
                'text_status' => $textStatus,
            ]);
        });
    }
}
