<?php

namespace App\Logic\ExternalApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

/**
 * Бизнес - логика: клиент для запросов к API сторонних сервисов
 */
class CommonApiClient
{
    /**
     * Выполняет запрос к API стороннего сервиса.
     * Если параметр $jsonDecode = true, ответ возвращается в виде объекта, декодированном из json - строки.
     *
     * @param string $url URL API
     * @param array $jsonQuery Тело запроса в виде ассоциативного массива
     * @param string $method Метод запроса
     * @param bool $jsonDecode Применять или нет декодирование json (для API, возвращающих ответ в формате json)
     * @return mixed Ответ запроса
     * @throws GuzzleException
     */
    public static function getApiJsonResponse(string $url, array $jsonQuery = [], string $method = 'POST', bool $jsonDecode = true): mixed
    {
        $client = new Client();
        $config = [
            'allow_redirects' => false,
            'connect_timeout' => config('custom_external_api.external_api_connect_timeout_second'),
            'read_timeout' => config('custom_external_api.external_api_read_timeout_second'),
            RequestOptions::VERIFY => false, // Не проверять SSL сертификаты (в производственной среде применять, если это необходимо на самом деле)
            // 'debug' => true,
        ];

        if (!empty($jsonQuery)) {
            $config['json'] = $jsonQuery;
        }

        $response = $client->request($method, $url, $config);
        $contents = $response->getBody()->getContents();

        return $jsonDecode ? json_decode($contents, false) : $contents;
    }
}
