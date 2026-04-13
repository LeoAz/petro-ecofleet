<?php

namespace App\Http\Controllers\Maintenance\Reform;

use App\Enums\Fleet\VehicleStatus;
use App\Enums\Maintenance\Gravity;
use App\Http\Controllers\Controller;
use App\Models\Reform;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class ReformController extends Controller
{
    public function index()
    {
        return view('maintenance.reform.index', [
            'reforms' => Reform::with('vehicle')
                ->get()
                ->sortByDesc('created_at')
        ]);
    }

    public function create(Vehicle $vehicle)
    {
        return view('maintenance.reform.create', [
            'vehicle' => $vehicle,
        ]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $attributes = $this->rules($request);

        throw_if( $vehicle->status == VehicleStatus::Reform,
            ValidationException::withMessages([
                'error' => 'Le vehicule sélectioné est déja en reforme'
            ])
        );

        throw_if( $vehicle->status == VehicleStatus::Travel,
            ValidationException::withMessages([
                'error' => 'Le vehicule est en voyage, Merci de clôturer le voyage avant la mise en réforme'
            ])
        );

        throw_if( $vehicle->activeDriver != null,
            ValidationException::withMessages([
                'error' => 'Le vehicle est affecté à un chauffeur, Merci de retirer le chauffeur avant la mise en reforme'
            ])
        );

        throw_if( $vehicle->activeDriver != null,
            ValidationException::withMessages([
                'error' => 'Le vehicle est attélé à une remorque, Merci de retirer la remorque avant la mise en reforme'
            ])
        );
        $vehicle->reforms()->create($attributes);

        $vehicle->update([
            'status' => VehicleStatus::Reform
        ]);

        $vehicle->save();

        flash()->success("Le vehicle à été mise en reforme avec succès");
        return redirect()->route('maintenance.reform.index');
    }

    public function delete(Reform $reform)
    {
        $reform->delete();
        $reform->vehicle()->update([
            'status' => VehicleStatus::Available
        ]);
        flash()->success("La reform a été supprimer avec success");
        return redirect()->route('maintenance.reform.index');
    }


    private function rules(Request $request): array
    {
        $attributes = $this->validate($request, [
            'date' => ['required'],
            'reason' => ['required'],
        ], [
            'date.required' => 'La date est obligatoire',
            'reason.required' => 'La raison de la mise en reforme est obligatoire',
        ]);
        if (!is_null($attributes['date']))
            Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());
        return $attributes;
    }
}
