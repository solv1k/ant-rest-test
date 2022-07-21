<?php

namespace App\DTO;

use App\DTO\Casters\StreamPlaylistItemCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class StreamDTO extends DataTransferObject
{
    public string $streamId;

    public string $name;

    public string | null $description;

    public string | null $status;

    public string | null $type;

    public string | null $publishType;

    public string | null $playListStatus;

    #[CastWith(StreamPlaylistItemCaster::class)]
    public array $playListItemList;
}