<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|url',
            'director_id' => 'required|exists:directors,id',
            'star_ids' => 'required|array',
            'genre_ids' => 'required|array',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Field is required',
            'description.required' => 'Field is required',
            'image_url.required' => 'Field is required',
            'image_url.url' => 'Invalid url format',
            'director_id.required' => 'Field is required',
            'director_id.exists' => 'Director id does not exist',
            'star_ids.required' => 'Field is required',
            'star_ids.array' => 'Field is not array',
            'genre_ids.required' => 'Field is required',
            'genre_ids.array' => 'Field is not array',
        ];
    }
}
