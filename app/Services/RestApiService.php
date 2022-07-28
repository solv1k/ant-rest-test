<?php

namespace App\Services;

use App\Contracts\RestApiServiceContract;
use Closure;
use Exception;
use Illuminate\Support\Str;

/**
 * Rest API сервис для работы с Ant Media Server.
 */
class RestApiService implements RestApiServiceContract
{
    /** Код успешного ответа */
    const SUCCESS_STATUS_CODE = 200;

    /** @var \GuzzleHttp\ClientInterface */
    protected $client;

    /**
     * Конструктор сервиса Rest API.
     */
    public function __construct(\GuzzleHttp\ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Выполняет запрос по указанным параметрам и возвращает массив с данными ответа.
     * 
     * @return array
     * @throws Exception
     */
    protected function request(
        string $method, 
        string $uri = "", 
        array $params = [], 
        ?Closure $onError = null
    ): array {
        $method = strtoupper($method);

        if (Str::startsWith($uri, '/')) {
            $uri = substr($uri, 1);
        }

        $response = match($method) {
            'GET' => $this->client->request('GET', $uri . '?' . http_build_query($params)),
            'POST' => $this->client->request('POST', $uri, ['json' => $params]),
            default => throw new Exception("Неизвестный метод запроса.")
        };

        $statusCode = $response->getStatusCode();

        if ($statusCode !== self::SUCCESS_STATUS_CODE) {
            if ($onError) {
                $onError($statusCode);
            } else {
                throw new Exception("[$statusCode] Ошибка запроса к Rest API: " . $response->getBody()->getContents());
            }
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Выполняет GET-запрос и возвращает массив с данными ответа.
     * 
     * @return array
     * @throws Exception
     */
    public function get(string $uri = "", array $params = [], ?Closure $onError = null): array
    {
        return $this->request('GET', $uri, $params, $onError);
    }

    /**
     * Выполняет POST-запрос и возвращает массив с данными ответа.
     * 
     * @return array
     * @throws Exception
     */
    public function post(string $uri = "", array $params = [], ?Closure $onError = null): array
    {
        return $this->request('POST', $uri, $params, $onError);
    }
}