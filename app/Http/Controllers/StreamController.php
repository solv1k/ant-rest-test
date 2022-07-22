<?php

namespace App\Http\Controllers;

use App\DTO\StreamDTO;
use App\Http\Requests\StreamStoreRequest;
use App\Models\Stream;

class StreamController extends RestApiController
{
    // список стримов, загруженных из Ant.
    public function fromAnt()
    {
        // загружаем список стримов из Ant
        $streams = $this->restApiService->get("/v2/broadcasts/list/0/50");

        // преобразуем в DTO
        $streams = collect($streams)->map(fn($stream) => new StreamDTO($stream));

        // возвращаем вьюшку с данными стримов
        return view('streams.list-from-ant', compact('streams', 'debug'));
    }

    // форма создания стрима
    public function create()
    {
        return view('streams.forms.create');
    }

    // логика создания стрима
    public function store(StreamStoreRequest $request)
    {
        // получаем DTO из сырых данных запроса
        $streamDTO = $this->streamService->createDtoFromStoreRequest($request);

        // создаём новый стрим через API и получаем данные созданного стрима
        $antStreamData = $this->restApiService->post("/v2/broadcasts/create", $streamDTO->toArray());

        // сохраняем стрим в БД (добавляем данные из API)
        $stream = $this->streamService->storeWithAntData($request, $antStreamData);

        // редиректим на главную
        return redirect(route('stream-show', compact('stream')));
    }

    // страница просмотра стрима
    public function show(Stream $stream)
    {
        return view('streams.single', compact('stream'));
    }
}
