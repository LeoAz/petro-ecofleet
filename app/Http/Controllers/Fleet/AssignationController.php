<?php

namespace App\Http\Controllers\Fleet;

use App\Enums\Fleet\AssignationStatus;
use App\Enums\Fleet\DriverStatus;
use App\Http\Controllers\Controller;
use App\Models\Assignation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AssignationController extends Controller
{
    public function index()
    {
        //dd('here');
        return view('fleet.assignation.index', [
            'assignations' => Assignation::with([
                'driver',
                'vehicle'
            ])->get()
        ]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $attributes = $this->validate($request, [
            'uuid' => ['nullable'],
            'vehicle_id' => ['required'],
            'driver_id' => ['required'],
            'date_attribution' => ['nullable'],
            'cancel_date' => ['nullable'],
            'status' => ['nullable'],
        ]);

        if (!is_null($attributes['date_attribution']))
            Arr::set($attributes, 'date_attribution', Carbon::createFromFormat('d/m/Y', $attributes['date_attribution'])->toDateString());

        Arr::set($attributes,'uuid', Str::uuid()->toString());
        Arr::set($attributes, 'status', AssignationStatus::Active);

        $assignation = new Assignation($attributes);

        if($assignation->driver->status == DriverStatus::Assign){
            throw ValidationException::withMessages([
                'error' => 'Ce chauffeur a déja une affectation active, Merci de le désaffacter d\'abord avant toute une nouvelle affection'
            ]);
        }

        if(!is_null($assignation->driver->activeVehicle)){
            $assignation->driver->activeVehicle->update([
                'status' => AssignationStatus::Revoked
            ]);
        }

        $assignation->driver->update([
            'status' => DriverStatus::Assign
        ]);

        $assignation->vehicle->update([
            'has_driver' => true
        ]);

        $assignation->save();

        flash()->success("L'affectation a été faite avec succès");
        return redirect()->back();

    }

    public function edit(Assignation $assignation)
    {
        return response()->json($assignation);
    }

    public function delete(Assignation $assignation)
    {
        $assignation->driver->update([
            'status' => DriverStatus::Unassign
        ]);

        $assignation->vehicle->update([
            'has_driver' => false
        ]);

        $assignation->delete();

        flash()->success("L'affectation a été supprimée avec succès");
        return redirect()->back();
    }
}
