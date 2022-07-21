<?php

namespace App\Http\Controllers;

use App\Services\RestApiService;
use App\Services\StreamService;

/**
 * Дефолтный контроллер, который содержит сервис для работы с Rest API.
 */
class RestApiController extends Controller
{
    protected $restApiService;

    protected $streamService;

    public function __construct(RestApiService $restApiService, StreamService $streamService)
    {
        $this->restApiService = $restApiService;
        $this->streamService = $streamService;
    }
}
