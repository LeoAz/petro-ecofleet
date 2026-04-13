<?php

namespace App\Http\Requests\Fleet\Trailer;

use Illuminate\Foundation\Http\FormRequest;

class TrailerPostRequest extends FormRequest
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
    public function rules()
    {
        return [
            'uuid' => ['nullable'],
            'registration' => ['required', 'unique:trailers,registration'],
            'code_trailer' => ['nullable', 'unique:trailers,code_trailer'],
            'fuel' => ['nullable'],
            'capacity' => ['nullable','numeric'],
            'empty_weight' => ['nullable','numeric'],
            'commissioning_date' => ['nullable','date_format:d/m/Y'],
            'acquisition_amount' => ['nullable', 'numeric'],
            'status' => ['nullable'],
            'brand_id' => ['required'],
            'pattern_id' => ['nullable'],
            'type' => ['required'],
            'usage' => ['nullable'],
            'state' => ['nullable'],
            'unit' => ['nullable'],
            'axels' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'registration.required' => 'La plaque d\'immatriculation de la remorque est obligatoire',
            'registration.unique' => 'La plaque d\'immatriculation de la remorque est déja utilisée',
            'code_trailer.unique' => 'Le code de la remorque est déja utilisée',
            'brand_id.required' => 'La marque de la remorque est obligatoire',
            'type.required' => 'Le model de la remorque est obligatoire'
        ];
    }
}
