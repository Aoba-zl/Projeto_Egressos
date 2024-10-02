<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEgressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'cpf' => ['required', 'digits:11'],
            'phone' => ['required', 'digits:11'],
            'birthdate' => ['required', 'date', 'before:today', 'after:01/01/1900'],
            'status' => ['required', 'in:0,1,2,3'],
        ];
    }

    /*
     * Return customizades fail messages
     */
    public function messages()
    {
        return [
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.digits' => 'O CPF deve conter 11 dígitos',
            'phone.required' => 'O número de telefone é obrigatório.',
            'phone.digits' => 'O número de telefone deve conter 11 dígitos',
            'birthdate.required' => 'A data de nascimento é obrigatório.',
            'birthdate.date' => 'A data de nascimento deve ser uma data válida',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser 0, 1, 2 ou 3',
        ];
    }
}
