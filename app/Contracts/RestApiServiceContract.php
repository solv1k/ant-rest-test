<?php

namespace App\Contracts;

use Closure;
use Exception;

/**
 * Интерфейс описывающий основные методы для отправки запросов по Rest API.
 */
interface RestApiServiceContract
{
    /**
     * Выполняет GET-запрос и возвращает массив с данными ответа.
     * 
     * @return array
     * @throws Exception
     */
    public function get(string $uri = "", array $params = [], ?Closure $onError = null): array;

    /**
     * Выполняет POST-запрос и возвращает массив с данными ответа.
     * 
     * @return array
     * @throws Exception
     */
    public function post(string $uri = "", array $params = [], ?Closure $onError = null): array;
}