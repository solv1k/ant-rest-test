<?php

namespace App\Services;

use Closure;
use Exception;
use Illuminate\Support\Str;

class RestApiService
{
    const SUCCESS_STATUS_CODE = 200;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * Конструктор сервиса Rest API.
     */
    public function __construct()
    {
        $this->client = app('HttpClient');
    }

    /**
     * Выполняет запрос по указанным параметрам и возвращает массив с данными ответа.
     * 
     * @return array
     * @throws Exception
     */
    public function request(string $method, string $uri = "", array $params = [], Closure $onError = null)
    {
        $method = strtoupper($method);

        if (Str::startsWith($uri, '/')) {
            $uri = substr($uri, 1);
        }

        switch ($method) {
            case 'GET':
                $response = $this->client->request('GET', $uri . '?' . http_build_query($params));
                break;

            case 'POST':
                $response = $this->client->request('POST', $uri, [
                    'json' => $params
                ]);
                break;

            default:
                throw new Exception("Неизвестный метод запроса.");
        }

        $statusCode = $response->getStatusCode();

        if ($statusCode !== self::SUCCESS_STATUS_CODE) {
            if ($onError)
                $onError($statusCode);
            else
                throw new Exception("[$statusCode] Ошибка запроса к Rest API: " . $response->getBody()->getContents());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Выполняет GET-запрос и возвращает массив с данными ответа.
     * 
     * @return array
     */
    public function get(string $uri = "", array $params = [], Closure $onError = null)
    {
        return $this->request('GET', $uri, $params, $onError);
    }

    /**
     * Выполняет POST-запрос и возвращает массив с данными ответа.
     * 
     * @return array
     */
    public function post(string $uri = "", array $params = [], Closure $onError = null)
    {
        return $this->request('POST', $uri, $params, $onError);
    }
}