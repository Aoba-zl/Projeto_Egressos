<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8'
                //comentado, pois o frontend está enviando a senha hasheada
                /* 
                'regex:/[A-Z]/',
                'regex:/[0-9]/', 
                'regex:/[@$!%*#?&]/', 
                */
            ],
            'type_account' => 'required|in:0,1,2', // Garante que seja 0, 1 ou 2
        ];
    }

    /**
     * Mensagens de erro personalizadas (opcional).
     */
    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.regex' => 'O nome deve conter apenas letras e espaços.',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'Email já cadastrado',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve conter no mínimo 8 caracteres',
            'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, um número e um caractere especial (@, $, !, %, *, #, ?, &).',
            'type_account.required' => 'O tipo de conta é obrigatório.',
            'type_account.in' => 'O tipo de conta deve ser 0, 1 ou 2.',
        ];
    }
}
