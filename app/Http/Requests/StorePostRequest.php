<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|longText',
            'image_url' => 'nullable|string',
            'type' => 'required|in:Real estate events,Classroom courses,Webinars,Legal updates,News Mundoinmobilario.tv,Promotions,Publicity',
            'active_from' => 'nullable|date_format:Y-m-d H:i:s',
            'active_to' => 'nullable|date_format:Y-m-d H:i:s'
        ];
    }
}
