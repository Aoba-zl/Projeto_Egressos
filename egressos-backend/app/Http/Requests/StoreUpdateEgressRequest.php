<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEgressRequest extends FormRequest
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
            'id' => ['required','exists:egresses,id'],
            'cpf' => [ 'cpf', 'digits:11'],
            'phone' => [ 'string','min:10'],
            'isPhonePublic' => ['boolean'],
            'birthdate' => [ 'date', 'before:01-01-' . (now()->year)-18, 'after:01/01/1900'],
            'contacts'             => [ 'array', 'min:1','max:3'],
            'academic_formation'   => [ 'array', 'min:1','max:3'],
            'professional_profile' => [ 'array', 'min:1','max:3'],
            'feedback' => [ 'string']
        ];
    }

    /*
     * Return customizades fail messages
     */
    public function messages()
    {
        return [
            'id.exists' => 'Egresso deve estar cadastrado',
            'cpf.cpf' => 'O CPF deve ser válido.',
            'cpf.digits' => 'O CPF deve conter 11 dígitos.',
            'phone.min' => 'O número de telefone deve conter 10 dígitos.',
            'isPhonePublic.boolean' => 'Se o telefone for publico deve informar em true ou false',
            'birthdate.date' => 'A data de nascimento deve ser uma data válida.',
            'birthdate.before' => 'Egresso deve ter mais de 18 anos.',
            'birthdate.after' => 'Data de nascimento inválida.',
            'contacts.min' => 'Deve haver ao menos um contato',
            'academic_formation.min'=>'Deve haver ao menos uma formação',
            'professional_profile.min'=>'Deve haver ao menos uma experiência profissional'
        ];
    }
}
