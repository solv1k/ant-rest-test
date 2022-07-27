<?php

namespace App\DTO;

use App\DTO\Casters\StreamPlaylistItemCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class StreamDTO extends DataTransferObject
{
    public string $streamId;

    public string $name;

    public ?string $description;

    public ?string $status;

    public ?string $type;

    public ?string $publishType;

    public ?string $playListStatus;

    public ?string $rtmpURL;

    #[CastWith(StreamPlaylistItemCaster::class)]
    public ?array $playListItemList;

    public ?string $username;

    public ?string $password;
}