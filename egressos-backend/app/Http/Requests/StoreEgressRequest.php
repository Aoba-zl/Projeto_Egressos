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
            'cpf' => ['required', 'cpf', 'digits:11', 'unique:egresses,cpf'],
            'phone' => ['required', 'digits:11'],
            'birthdate' => ['required', 'date', 'before:01-01-' . now()->year, 'after:01/01/1900'],
            'contacts'             => ['required', 'array', 'max:3'],
            'academic_formation'   => ['required', 'array', 'max:3'],
            'professional_profile' => ['required', 'array', 'max:3'],
        ];
    }

    /*
     * Return customizades fail messages
     */
    public function messages()
    {
        return [
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.cpf' => 'O CPF deve ser válido.',
            'cpf.digits' => 'O CPF deve conter 11 dígitos.',
            'cpf.unique' => 'CPF já cadastrado.',
            'phone.required' => 'O número de telefone é obrigatório..',
            'phone.digits' => 'O número de telefone deve conter 11 dígitos.',
            'birthdate.required' => 'A data de nascimento é obrigatório..',
            'birthdate.date' => 'A data de nascimento deve ser uma data válida.',
            'birthdate.before' => 'A data de nascimento .',
            'birthdate.after' => 'Data de nascimento inválida.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser 0, 1, 2 ou 3.',
        ];
    }
}
