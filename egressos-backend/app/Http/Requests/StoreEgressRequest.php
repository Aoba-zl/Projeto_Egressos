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
            'contacts.required' => 'Deve ser fornecido ao menos 1 contato.',
            'contacts.max' => 'Deve ser cadastrado no máximo 3 contatos por Egresso',
            'academic_formation.required' => 'Deve ser fornecida ao menos 1 experiência acadêmica',
            'academic_formation.max' => 'Deve ser cadastrado no máximo 3 experiências acadêmicas por Egresso',
            'professional_profile.required' => 'Deve ser fornecido ao menos 1 experiência profissional',
            'professional_profile.max' => 'Deve ser cadastrado no máximo 3 experiências profissionais',
            'feedback.required' => 'Necessário cadastrar um feedback',
            'feedback.string' => 'Feedback deve estar no formato string.',
            'birthdate.before' => 'Você deve ter no mínimo 18 anos',
            'birthdate.after' => 'Data de nascimento inválida.',
            'academic_formation.max' => 'Você só pode cadastrar 3 Experiências Acadêmicas'

        ];
    }
}
