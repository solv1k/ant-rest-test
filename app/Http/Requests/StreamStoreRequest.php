<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StreamStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:250',
            'description' => 'max:1000',
            'preview_url' => 'url'
        ];
    }
}
