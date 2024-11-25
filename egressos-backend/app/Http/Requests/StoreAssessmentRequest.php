<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
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
            'assessment.id_moderator_admi' => ['required', 'exists:users,id'],
            'assessment.id_egress' => ['required', 'exists:egresses,id'],
            'assessment.comment' => [ 'nullable','string'],
            'user_token' => [ 'required','string']
        ];
    }

    /*
     * Return customizades fail messages
     */
    public function messages()
    {
        return [
            'id_moderator_admi.required' => 'O id do moderador é obrigatório.',
            'id_moderator_admi.exists' => 'Moderador não encontrado',
            'id_egress.required' => 'O id do egresso é obrigatório.',
            'id_egress.exists' => 'Egresso não encontrado.',
            'comment.string' => 'O comentário deve estar no formato de texto.',
            'user_token.required' => 'É necessario enviar o token do usuário'
        ];
    }
}
