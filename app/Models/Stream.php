<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
        'name',
        'description',
        'preview_url',
        'ant_json'
    ];

    protected $casts = [
        'ant_json' => 'json'
    ];
}
