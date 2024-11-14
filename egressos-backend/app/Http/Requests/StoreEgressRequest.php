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
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10240'],
            'cpf' => ['required', 'cpf', 'digits:11', 'unique:egresses,cpf'],
            'phone' => ['required', 'string','min:10'],
            'birthdate' => ['required', 'date', 'before:01-01-' . (now()->year - 18), 'after:01/01/1900'],
            'contacts'             => ['required', 'array', 'max:3'],
            'academic_formation'   => ['required', 'array', 'max:3'],
            'professional_profile' => ['required', 'array', 'max:3'],
            'feedback' => ['required', 'string']
        ];
    }

    /*
     * Return customizades fail messages
     */
    public function messages()
    {
        return [
            'image.required' => 'A imagem é obrigatória',
            'image.image' => 'A imagem deve ser válida',
            'image.mimes' => 'A imagem deve ser jpeg, png ou jpg',
            'image.max' => 'O tamanho máximo de uma imagem é de 10MB',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.cpf' => 'O CPF deve ser válido.',
            'cpf.digits' => 'O CPF deve conter 11 dígitos.',
            'cpf.unique' => 'CPF já cadastrado.',
            'phone.required' => 'O número de telefone é obrigatório..',
            'phone.digits' => 'O número de telefone deve conter 11 dígitos.',
            'birthdate.required' => 'A data de nascimento é obrigatório..',
            'birthdate.date' => 'A data de nascimento deve ser uma data válida.',
            'birthdate.before' => 'Você deve ter no mínimo 18 anos',
            'birthdate.after' => 'Data de nascimento inválida.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser 0, 1, 2 ou 3.',
            'academic_formation.max' => 'Você só pode cadastrar 3 Experiências Acadêmicas'
        ];
    }
}
