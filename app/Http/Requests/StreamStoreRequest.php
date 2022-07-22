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
            'preview' => 'nullable|file|mimes:png,jpg|dimensions:min_width=400,min_height=200|max:4096'
        ];
    }
}
