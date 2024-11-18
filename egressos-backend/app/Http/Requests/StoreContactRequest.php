<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'id_profile'  => ['required'],
            'id_platform' => ['required'],
            'contact'     => ['required','unique:contacts'],
        ];

    }

    /**
     * Mensagens de erro personalizadas (opcional).
     */
    public function messages()
    {
        return [
            'id_profile.required' => 'Necessário informar o perfil que será adicionado o contato',
            'id_platform.required' => 'Necessário informar a plataforma que será adicionado o contato',
            'contact.required' => 'Informe o campo do contato',
            'contact.unique' => 'O contato informado já foi cadastrado, informe um novo.'
        ];
    }
}
