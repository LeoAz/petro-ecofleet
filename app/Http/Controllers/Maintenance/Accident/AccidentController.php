<?php

namespace App\Http\Controllers\Maintenance\Accident;

use App\Enums\Maintenance\Gravity;
use App\Http\Controllers\Controller;
use App\Models\Accident;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AccidentController extends Controller
{
    public function index()
    {
        return view('maintenance.Accident.index', [
            'accidents' => Accident::with('vehicle')
                ->get()
                ->sortByDesc('created_at')
        ]);
    }

    public function create(Vehicle $vehicle)
    {
        return view('maintenance.Accident.create', [
            'vehicle' => $vehicle,
            'gravities' => Gravity::asSelectArray()
        ]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $attributes = $this->rules($request);

        $vehicle->accidents()->create($attributes);

        flash()->success("La accident a été enregistrée avec succès");
        return redirect()->route('maintenance.accident.index');
    }

    public function edit(Vehicle $vehicle, Accident $accident)
    {
        return view('maintenance.Accident.edit', [
            'vehicle' => $vehicle,
            'accident' => $accident,
            'gravities' => Gravity::asSelectArray()
        ]);
    }

    public function update(Request $request, Accident $accident)
    {
        $attributes = $this->rules($request);
        $accident->updateOrFail($attributes);
        $accident->save();

        flash()->success("La accident a été modifée avec succès");
        return redirect()->route('maintenance.accident.index');
    }

    public function print(Vehicle $vehicle, Accident $accident)
    {
        return view('maintenance.Accident.__print', [
            'accident' => $accident,
        ]);
    }

    public function delete(Accident $accident)
    {
        $accident->delete();
        flash()->success("La accident a été modifée avec succès");
        return redirect()->route('maintenance.accident.index');
    }


    private function rules(Request $request): array
    {
        $attributes = $this->validate($request, [
            'date' => ['required'],
            'place' => ['required'],
            'gravity' => ['required'],
            'amount' => ['required'],
            'description' => ['nullable'],
        ], [
            'date.required' => 'La date de l\'accident est obligatoire',
            'place.required' => 'Le lieu de l\'accident est obligatoire',
            'gravity.required' => 'La gravité de l\'accident est obligatoire',
            'amount.required' => 'Le coût de l\'accident est obligatoire',
        ]);
        if (!is_null($attributes['date']))
            Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());

        return $attributes;
    }
}
