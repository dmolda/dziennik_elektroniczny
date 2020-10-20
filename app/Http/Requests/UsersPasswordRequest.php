<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersPasswordRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'nullable|min:8|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa użytkownika jest wymagane',
            'email.required' => 'Pole email jest wymagane',
            'password.min' => 'Hasło musi być dłuższe niz 8 znaków'
        ];
    }
}
