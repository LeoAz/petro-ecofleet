<?php

namespace App\Http\Requests\Fleet\Driver;

use Illuminate\Foundation\Http\FormRequest;

class DriverPostRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'matricule' => ['nullable', 'unique:drivers'],
            'driver_licence' => ['nullable', 'unique:drivers'],
            'licence_category' => ['nullable'],
            'birth_date' => ['nullable'],
            'exp_date' => ['nullable'],
            'Address' => ['nullable'],
            'tel' => ['nullable', 'unique:drivers'],
            'observation' => ['nullable'],
            'status' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du chauffeur est obligatoire',
            'driver_licence.unique' => 'Le numero du permis du chauffeur est déja utilisé',
            'tel.unique' => 'Le numero de téléphone du chauffeur est déja utilisé',
        ];

    }
}
