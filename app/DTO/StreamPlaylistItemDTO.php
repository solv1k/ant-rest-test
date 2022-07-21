<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class StreamPlaylistItemDTO extends DataTransferObject
{
    public string $streamUrl;

    public string $type;
}