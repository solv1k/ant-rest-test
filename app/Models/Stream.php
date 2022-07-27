<?php

namespace App\Models;

use App\DTO\StreamDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Stream extends Model
{
    protected $fillable = [
        'name',
        'description',
        'preview_url',
        'ant_json'
    ];

    protected $casts = [
        'ant_json' => 'array'
    ];

    protected $appends = [
        'ant_data_online'
    ];

    /** @var StreamDTO */
    protected $cached_ant_data_online;

    /**
     * Пользователь, создавший стрим. Владелец стрима.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Возвращает Ant-объект, который был добавлен во время создания стрима.
     */
    public function getAntDataAttribute()
    {
        return json_decode($this->ant_json);
    }

    /**
     * Возвращает DTO Ant-объекта стрима, актуального на момент загрузки данных.
     */
    public function getAntDataOnlineAttribute()
    {
        if ($this->cached_ant_data_online)
            return $this->cached_ant_data_online;
        
        $restApiService = app('RestApiService');

        $streamDTO = new StreamDTO($restApiService->get("/v2/broadcasts/" . $this->ant_data->streamId));

        $this->cached_ant_data_online = $streamDTO;

        return $streamDTO;
    }

    /**
     * Онлайн ли сейчас стрим.
     */
    public function isOnline()
    {
        return $this->ant_data_online->status === 'broadcasting';
    }

    /**
     * Устанавливает путь к превью стрима.
     */
    public function setPreviewUrlPath(string $path = "")
    {
        $this->preview_url = $path;
        $this->save();
    }

    /**
     * Возвращает превью стрима.
     */
    public function getPreviewUrlPathAttribute()
    {
        if ($this->preview_url) {
            return url(str_replace('public', 'storage', $this->preview_url));
        }

        return 'https://via.placeholder.com/800x400?text=Preview+placeholder';
    }

    /**
     * Возвращает тип стрима.
     */
    public function getTypeAttribute()
    {
        return $this->ant_data_online->type;
    }

    /**
     * Возвращает тип публикации стрима.
     */
    public function getPublishTypeAttribute()
    {
        return $this->ant_data_online->publishType;
    }

    /**
     * Возвращает ссылку для просмотра стрима.
     */
    public function getPlayerSrcAttribute()
    {
        return config('ant.scheme') . '://' . 
                config('ant.server') . ':' . 
                config('ant.port') . '/' . 
                config('ant.app_name') . '/play.html?name=' . 
                $this->ant_data_online->streamId;
    }
}
