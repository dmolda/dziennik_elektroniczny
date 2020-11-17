<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectsRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'required|min:10|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa przedmiotu jest wymagane',
            'description.required' => 'Pole opis jest wymagane',
            'description.min' => 'Opis musi być dłuższy niz 10 znaków'
        ];
    }
}
