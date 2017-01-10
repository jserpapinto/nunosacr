<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "site" => "nullable",
            "email" => "nullable|email",
            "bio" => "nullable",
            "cv" => "file|nullable",
            "gallery" => "boolean",
            "img" => "image|nullable",
            "imgBanner" => "image|nullable"
        ];
    }
}
