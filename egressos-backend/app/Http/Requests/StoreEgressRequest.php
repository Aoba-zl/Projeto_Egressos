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
            'birthdate' => ['required', 'date'],
            'status' => ['required', 'in:0,1,2,3'],
        ];
    }

    /*
     * Return customizades fail messages
     */
    public function messages()
    {
        // TODO: Customizar mensagens
        return [
            'cpf.required' => 'PLACE',
            'cpf.digits' => 'PLACE',
            'phone.required' => 'PLACE',
            'phone.digits' => 'PLACE',
            'birthdate.required' => 'PLACE',
            'birthdate.date' => 'PLACE',
            'status.required' => 'PLACE',
            'status.in' => 'PLACE',
        ];
    }
}

/*
46927243828
11912341234

*/