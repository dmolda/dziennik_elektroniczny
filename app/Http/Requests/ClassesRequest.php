<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassesRequest extends FormRequest
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
            'description' => 'required|min:20|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa klasy jest wymagane',
            'description.required' => 'Pole opis jest wymagane',
            'description.min' => 'Opis musi być dłuższy niz 20 znaków'
        ];
    }
}
