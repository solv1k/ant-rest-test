<?php

namespace App\Services;

use App\DTO\StreamDTO;
use App\Http\Requests\StreamStoreRequest;
use App\Models\Stream;
use Illuminate\Support\Str;

class StreamService
{
    /**
     * Генерирует и возвращает уникальный ID стрима.
     * 
     * @return string
     */
    public function generateStreamId(): string
    {
        return md5(implode('_', [time(), Str::random(32)]));
    }

    /**
     * Создаёт и возвращает DTO стрима из данных запроса.
     * 
     * @return StreamDTO
     */
    public function createDtoFromStoreRequest(StreamStoreRequest $request): StreamDTO
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $data = array_merge($request->validated(), [
            'streamId' => $this->generateStreamId(),
            'type' => 'liveStream',
            'status' => 'created',
            'username' => $user->name,
            'password' => $user->generateStreamPassword()
        ]);

        return new StreamDTO($data);
    }

    /**
     * Создаёт стрим в БД, добавляет данные из Ant Media Server и возвращает модель стрима.
     * 
     * @return Stream
     */
    public function storeWithAntData(StreamStoreRequest $request, array $antStreamData): Stream
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