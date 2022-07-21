<?php

namespace App\DTO\Casters;

use App\DTO\StreamPlaylistItemDTO;

class StreamPlaylistItemCaster extends BaseCaster
{
    public function __construct()
    {
        parent::__construct(StreamPlaylistItemDTO::class);
    }
}