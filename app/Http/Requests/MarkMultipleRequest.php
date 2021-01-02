<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkMultipleRequest extends FormRequest
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
            'mark_desc' => 'in:1,1+,2-,2,2+,3-,3,3+,4-,4,4+,5-,5,5+,6-,6',
            'description' => 'required|min:2|max:255',
            'weight' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'mark_desc.in' => 'Wygląd ocen: 1, 1+, 2-, 2, +2, 3-, 3, 3+, 4-, 4, 4+, 5-, 5, 5+, 6-, 6',
            'description.required' => 'Pole opis jest wymagane',
            'description.min' => 'Opis musi być dłuższy niz 2 znaków',
            'weight.required' => 'Pole waga jest wymagane',
        ];
    }
}
