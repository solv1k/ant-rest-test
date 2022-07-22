<?php

namespace App\Services;

use App\DTO\StreamDTO;
use App\Http\Requests\StreamStoreRequest;

class StreamService
{
    /**
     * Создаёт и возвращает DTO стрима из данных запроса.
     */
    public function createDtoFromStoreRequest(StreamStoreRequest $request)
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $data = array_merge($request->validated(), [
            'streamId' => md5(time()),
            'type' => 'liveStream',
            'status' => 'created',
            'username' => $user->name,
            'password' => $user->generateStreamPassword()
        ]);

        return new StreamDTO($data);
    }

    /**
     * Создаёт стрим в БД, добавляет данные из Ant Media Server и возвращает модель стрима.
     */
    public function storeWithAntData(StreamStoreRequest $request, array $antStreamData)
    {
        $antStreamDTO = new StreamDTO($antStreamData);

        /** @var \App\Models\User */
        $user = auth()->user();

        // создаем стрим
        $stream = $user->streams()->create(array_merge($request->validated(), [
            'ant_json' => json_encode($antStreamDTO)
        ]));

        // сохраняем превью
        if ($request->hasFile('preview')) {
            $path = $request->file('preview')->store('public/files/previews');
            $stream->setPreviewUrlPath($path);
        }

        $stream->fresh();

        return $stream;
    }
}