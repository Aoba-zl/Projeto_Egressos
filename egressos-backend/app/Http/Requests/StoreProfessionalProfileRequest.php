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
            'begin_year'        => ['required', 'date', 'before:01-01-' . now()->year, 'after:01/01/1900'],
            'end_year'          => ['nullable', 'date', 'before:01-01-' . now()->year, 'after:01/01/1900'],
            'phone'             => ['nullable', 'digits:11'],
            'email'             => ['nullable', 'email'],
            'url'               => ['nullable', 'string'],
            'address.cep'       => ['nullable', 'digits:8'],
            'address.num_porta' => ['nullable', 'integer']
        ];
    }
}