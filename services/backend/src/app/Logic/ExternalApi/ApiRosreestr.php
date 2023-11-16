<?php

namespace App\Logic\ExternalApi;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Бизнес - логика: запросы к API статистики сборов
 */
class ApiRosreestr
{
    /**
     * @var string Код ошибки: объект не найден
     */
    public const ERROR_CODE_OBJECT_NOT_FOUND = 'Object not found';

    /**
     * Получение сведений об объекте недвижимости из базы ГКН (Государственный кадастр недвижимости - технические сведения об объекте) по кадастровому номеру
     *
     * @param string $cadastralNumber Кадастровый номер
     * @return mixed
     * @throws GuzzleException
     */
    public static function getGknObject(string $cadastralNumber): mixed
    {
        $url = config('custom_external_api.api_rosreestr_url_gkn_object_get') . '/' . $cadastralNumber;

        return CommonApiClient::getApiJsonResponse(
            $url,
            [],
            'GET',
        );
    }
}
