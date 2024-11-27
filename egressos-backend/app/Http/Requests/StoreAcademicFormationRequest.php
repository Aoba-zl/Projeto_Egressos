<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicFormationRequest extends FormRequest
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
            'begin_year' => 'required|integer',
            'end_year' => 'integer',
            'period' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'begin_year.required' => 'Ano inicial da formação acadêmica deve ser informado',
            'begin_year.integer' => 'Ano inicial deve ser no formato de número inteiro',
            'end_year.integer' => 'Ano final deve ser em formato de número inteiro',
            'period.required' => 'Período deve ser informado'
        ];
    }

}
