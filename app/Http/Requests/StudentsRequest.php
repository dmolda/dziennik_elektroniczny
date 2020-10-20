<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
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
            'name' => 'required|max:255|min:3',
            'second_name' => 'nullable|min:3|max:255',
            'last_name' => 'required|min:3|max:255',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Imie jest wymagane',
            'name.min' => 'Imię musi być dłuższe niz 3 znaki',
            'second_name.min' => 'Drugie imię musi być dłuższe niż 3 znaki',
            'last_name.required' => 'Imie jest wymagane',
            'last_name.min' => 'Imię musi być dłuższe niz 3 znaki',
        ];
    }
}
