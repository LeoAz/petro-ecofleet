<?php

namespace App\Http\Controllers\Maintenance\Garage;

use App\Enums\Fleet\VehicleStatus;
use App\Enums\Maintenance\GarageStatus;
use App\Http\Controllers\Controller;
use App\Models\Garage;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class GarageController extends Controller
{
    public function index()
    {
        return view('maintenance.garage.index', [
            'garages' => Garage::with(['vehicle', 'maintenances'])
                ->get()
                ->sortByDesc('created_at')
        ]);
    }

    public function create(Vehicle $vehicle)
    {
        return view('maintenance.garage.create', [
            'vehicle' => $vehicle
        ]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $attributes = $this->rules($request);

        throw_if( $vehicle->status == VehicleStatus::Garage,
            ValidationException::withMessages([
                'error' => 'le vehicule est deja au garage. Merci de selectionner un nouveau'])
        );

        throw_if( $vehicle->status == VehicleStatus::Travel,
            ValidationException::withMessages([
                'error' => 'le vehicule que vous avez sélectionner est en voyage, Merci de cloturer le dossier de voyage avant la mise au garage'])
        );

        Arr::set($attributes, 'status', GarageStatus::Pending);

        $vehicle->garages()->create($attributes);
        $vehicle->status = VehicleStatus::Garage;
        $vehicle->save();

        flash()->success("La mise au garage a été enregistrée avec succès");
        return redirect()->route('maintenance.garage.index');
    }

    public function edit(Garage $garage)
    {
        return view('maintenance.garage.edit', [
            'garage' => $garage
        ]);
    }

    public function update(Request $request, Garage $garage)
    {
        throw_if( $garage->status != GarageStatus::Pending ,
            ValidationException::withMessages([
                'error' => 'Ce véhicule est déja pris en charge dans le garage ou est deja sortie, Vous ne pouvez plus modifier les informations'])
        );

        $attributes = $this->rules($request);
        $garage->updateOrFail($attributes);
        $garage->save();

        flash()->success("La mise au garage a été mise à jour avec succès");
        return redirect()->route('maintenance.garage.index');
    }

    public function delete(Garage $garage)
    {
        throw_if( $garage->status != GarageStatus::Pending,
            ValidationException::withMessages([
                'error' => 'Ce véhicule est déja pris en sharge dans le garage ou est deja sortie, Vous ne pouvez plus supprimer les informations'])
        );

        $garage->vehicle->status = VehicleStatus::Available;
        $garage->vehicle->save();
        $garage->delete();

        flash()->success("La mise au garage a été supprimer avec succés avec succès");
        return redirect()->route('maintenance.garage.index');
    }


    private function rules(Request $request): array
    {
        $attributes = $this->validate($request, [
            'date' => ['required'],
            'reason' => ['required'],
            'description' => ['nullable'],
            'status' => ['nullable']
        ], [
            'date.required' => 'La date de la mise au garage est obligatoire',
            'reason.required' => 'La raisoon de la mise au garage est obligatoire',
        ]);

        if (!is_null($attributes['date']))
            Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());

        return $attributes;
    }
}
