<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotesRequest extends FormRequest
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
            'students_id' => 'required',
            'content' => 'required|min:3|max:255',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'students_id.required' => 'Pole uczeń jest wymagane',
            'content.required' => 'Pole treść jest wymagane',
            'content.max' => 'Treść może posiadać maksymalnie 255 znaków',
            'content.min' => 'Treść musi być dłuższy niz 3 znaki',
            'type.required' => 'Pole rodzaj notatki jest wymagane',

        ];
    }
}
