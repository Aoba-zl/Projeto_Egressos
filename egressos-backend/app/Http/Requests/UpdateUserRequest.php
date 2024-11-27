<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação que se aplicam à requisição.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [ 'string', 'max:255', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],  
            'user_token' => [ 'required','string'] 
        ];
    }

    /**
     * Mensagens de erro personalizadas (opcional).
     */
    public function messages()
    {
        return [

            'name.regex' => 'O nome deve conter apenas letras e espaços.',
            'user_token.required' => 'É necessario enviar o token do usuário'
        ];
    }
}
