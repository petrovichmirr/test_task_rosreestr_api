<?php

namespace App\Logic;

use App\Logic\ExternalApi\ApiRosreestr;

/**
 * Бизнес - логика: работа с данными об объектах недвижимости
 */
class RealEstateObjects
{

    public static function getObjectByCadastralNumber(string $cadastralNumber)
    {
//        $gknData = ApiRosreestr::getGknObject($cadastralNumber);
//
//        clock('$gknData', $gknData);

        return [
            'status' => true,
            // 'text_status' => __('messages.real_estate_object_not_found'),
            'text_status' => __('messages.real_estate_object_query_success'),
        ];
    }
}
