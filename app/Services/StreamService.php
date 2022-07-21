<?php

namespace App\Services;

use App\DTO\StreamDTO;
use App\Http\Requests\StreamStoreRequest;
use App\Models\Stream;

class StreamService
{
    /**
     * Создаёт и возвращает DTO стрима из данных запроса.
     */
    public function createDtoFromStoreRequest(StreamStoreRequest $request)
    {
        $data = array_merge($request->validated(), [
            'streamId' => md5(time()),
            'type' => 'liveStream',
            'status' => 'created',
            'playListItemList' => [[
                'streamUrl' => $request->preview_url,
                'type' => 'VoD'
            ]]
        ]);

        return new StreamDTO($data);
    }

    /**
     * Создаёт стрим в БД, добавляет данные из Ant Media Server и возвращает модель стрима.
     */
    public function storeWithAntData(StreamStoreRequest $request, array $antStreamData)
    {
        $antStreamDTO = new StreamDTO($antStreamData);

        $stream = Stream::create(array_merge($request->validated(), [
            'ant_json' => json_encode($antStreamDTO)
        ]));

        return $stream;
    }
}