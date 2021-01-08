<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessagesRequest extends FormRequest
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
            'recipient' => 'required',
            'message_subject' => 'required|min:3|max:255',
            'message' => 'required|min:3|max:255'
        ];
    }

    public function messages()
    {
        return [
            'recipient.required' => 'Pole odbiorca jest wymagane',
            'message_subject.required' => 'Pole temat jest wymagane',
            'message_subject.max' => 'Temat może posiadać maksymalnie 255 znaków',
            'message_subject.min' => 'Temat musi być dłuższy niz 3 znaki',
            'message.required' => 'Pole wiadomość jest wymagane',
            'message.max' => 'Wiadomość może posiadać maksymalnie 255 znaków',
            'message.min' => 'Wiadmość musi być dłuższa niz 3 znaki',

        ];
    }
}
