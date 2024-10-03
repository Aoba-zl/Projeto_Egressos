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
            'id_institution' => 'required|exists:institutions,id',
            'id_course' => 'required|exists:courses,id',
            'begin_year' => 'required|integer',
            'end_year' => 'integer',
            'period' => 'required|string|max:255',
        ];
    }
}
