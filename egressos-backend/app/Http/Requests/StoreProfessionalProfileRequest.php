<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfessionalProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'              => ['required', 'string'],
            'area_activity'     => ['required', 'string'],
            'initial_date'        => ['required', 'date', 'before:' . now(), 'after:01/01/1900'],
            'final_date'          => ['nullable', 'date', 'after:01/01/1900'],
            'phone'             => ['nullable', 'string' ,'min:10'],
            'email'             => ['nullable', 'email'],
            'site'              => ['nullable', 'string'],
            'address.cep'       => ['nullable', 'digits:8'],
            'address.num_porta' => ['nullable', 'integer']
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'O nome da empresa é obrigatório.',
        'name.string' => 'O nome da empresa deve ser um texto.',

        'area_activity.required' => 'A área de atividade é obrigatória.',
        'area_activity.string' => 'A área de atividade deve ser um texto.',

        'initial_date.required' => 'A data de início é obrigatória.',
        'initial_date.date' => 'A data de início deve ser uma data válida.',
        'initial_date.before' => 'A data de início deve ser antes da data atual.',
        'initial_date.after' => 'A data de início deve ser após 01/01/1900.',

        'final_date.date' => 'A data de término deve ser uma data válida.',
        'final_date.after' => 'A data de término deve ser após 01/01/1900.',

        'phone.string' => 'O telefone deve ser um texto.',
        'phone.min' => 'O telefone deve ter pelo menos 10 caracteres.',

        'email.email' => 'O e-mail deve ser um e-mail válido.',

        'site.string' => 'O site deve ser um texto.',

        'address.cep.digits' => 'O CEP deve ter exatamente 8 dígitos.',

        'address.num_porta.integer' => 'O número da porta deve ser um número inteiro.'
    ];
}

}
