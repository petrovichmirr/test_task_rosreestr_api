<?php

namespace App\Logic;

use App\Jobs\GetGknObjectJob;
use App\Logic\ExternalApi\ApiRosreestr;
use GuzzleHttp\Exception\GuzzleException;
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
     * @throws GuzzleException
     */
    public static function getObjectByCadastralNumber(string $cadastralNumber): array
    {
        // Отправляем задание в очередь
        GetGknObjectJob::dispatch($cadastralNumber);

        return [
            'status' => true,
            'text_status' => __('messages.real_estate_object_query_sent'),
        ];
    }

    public static function handleGknData(stdClass $gknData)
    {
        // Проверяем данные
//        if (isset($gknData->errorCode)) {
//            // Ошибка запроса
//            $status = false;
//
//            if ($gknData->errorCode == ApiRosreestr::ERROR_CODE_OBJECT_NOT_FOUND) {
//                $textStatus = __('messages.real_estate_object_query_error_not_found');
//            } else {
//                $textStatus = __('messages.real_estate_object_query_error_other');
//            }
//        } else {
//            // Запрос успешный
//            self::handleGknData($gknData);
//
//            $status = true;
//            $textStatus = __('messages.real_estate_object_query_success');
//        }

        info('$gknData' . print_r($gknData, true));
    }
}
