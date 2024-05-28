<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'content' => 'required|string|max:4294967295',
            'image_url' => 'nullable|string',
            'type' => 'required|in:Real estate events,Classroom courses,Webinars,Legal updates,News Mundoinmobilario.tv,Promotions,Publicity',
            'active_from' => 'nullable|date_format:Y-m-d H:i:s',
            'active_to' => 'nullable|date_format:Y-m-d H:i:s'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser una cadena de caracteres.',
            'title.max' => 'El título no puede exceder los :max caracteres.',
            'description.string' => 'La descripción debe ser una cadena de caracteres.',
            'content.string' => 'El contenido debe ser una cadena de caracteres.',
            'image_url.string' => 'La URL de la imagen debe ser una cadena de caracteres.',
            'type.required' => 'El tipo es obligatorio.',
            'type.in' => 'El tipo seleccionado no es válido.',
            'active_from.date_format' => 'El formato de fecha y hora de inicio debe ser YYYY-MM-DD HH:MM:SS.',
            'active_to.date_format' => 'El formato de fecha y hora de fin debe ser YYYY-MM-DD HH:MM:SS.'
        ];
    }
}
