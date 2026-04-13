<?php

namespace App\Http\Requests\Fleet\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdateRequest extends FormRequest
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
            'uuid' => ['nullable'],
            'registration' => ['required'],
            'chassis' => ['nullable'],
            'code_vehicle' => ['nullable'],
            'brand_id' => ['required'],
            'number_places' => ['nullable'],
            'type' => ['nullable'],
            'pattern_id' => ['nullable'],
            'usage' => ['nullable'],
            'state' => ['nullable'],
            'fuel' => ['nullable'],
            'empty_weight' => ['nullable','numeric'] ,
            'power' => ['nullable','numeric'],
            'capacity' => ['nullable','numeric'],
            'unit' => ['required'],
            'mileage' => ['nullable','numeric'],
            'liters_100' => ['nullable','numeric'],
            'driver' => ['nullable'],
            'trailer' => ['nullable'],
            'commissioning_date' => ['nullable'],
            'acquisition_amount' => ['nullable', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'registration.required' => 'La plaque d\'immatriculation du véhicule est obligatoire',
            'chassis.required' => 'Le chassis du véhicule est obligatoire',
            'code.required' => 'Le code du véhicule est obligatoire',
            'brand.required' => 'La marque du véhicule est obligatoire',
            'pattern_id.required' => 'Le model du vehicule est obligatoire',
            'unit.required' => 'L\'unité de mesure de la capacité est obligatoire',
            'capacity.numeric' => 'La capacité du vehicule doit etre une valeur numérique'
        ];
    }
}
