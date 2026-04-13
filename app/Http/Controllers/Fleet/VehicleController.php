<?php

namespace App\Http\Controllers\Fleet;

use App\Enums\Fleet\FleetState;
use App\Enums\Fleet\FleetUsage;
use App\Enums\Fleet\TrailerStatus;
use App\Enums\Fleet\VehicleStatus;
use App\Enums\Fleet\VehicleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fleet\Vehicle\VehiclePostRequest;
use App\Http\Requests\Fleet\Vehicle\VehicleUpdateRequest;
use App\Models\Brand;
use App\Models\Pattern;
use App\Models\Trailer;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index()
    {
        return view('fleet.vehicle.index',[
            'vehicles' => Vehicle::with([
                'brand',
                'pattern',
                'activeTrailer',
                //'trailers',
                'documents',
                'drivers',
                'activeDriver'
            ])
                ->where('is_tier', false)
                ->get()
                ->sortByDesc('created_at'),
            'types' => VehicleType::asSelectArray(),
            'brands' => Brand::pluck('name', 'id'),
            'patterns' => Pattern::pluck('name', 'id'),
            'usages' => FleetUsage::asSelectArray(),
            'states' => FleetState::asSelectArray(),
            'available' => Vehicle::where('status', VehicleStatus::Available)
                ->where('is_tier', false)
                ->count(),
            'travel' => Vehicle::where('status', VehicleStatus::Travel)
                ->where('is_tier', false)
                ->count(),
            'reform' => Vehicle::where('status', VehicleStatus::Reform)
                ->where('is_tier', false)
                ->count(),
            'garage' => Vehicle::where('status', VehicleStatus::Garage)
                ->where('is_tier', false)
                ->count(),
            'vehicle_with_driver' => Vehicle::where('has_driver', true)
                ->where('is_tier', false)
                ->count(),
            'vehicle_without_driver' => Vehicle::where('has_driver', false)
                ->where('is_tier', false)
                ->count(),
            'vehicle_unlinked' => Vehicle::where('is_linked', false)
                ->where('type', VehicleType::Tracteur)
                ->where('is_tier', false)
                ->count(),
            'vehicle_linked' => Vehicle::where('is_linked', true)
                ->where('type', VehicleType::Tracteur)
                ->where('is_tier', false)
                ->count(),

        ]);
    }

    public function store(VehiclePostRequest $request)
    {
        $attributes = $request->validated();

        if (!is_null($attributes['commissioning_date']))
        Arr::set($attributes, 'commissioning_date', Carbon::createFromFormat('d/m/Y', $attributes['commissioning_date'])->toDateString());

        Arr::set($attributes,'uuid', Str::uuid()->toString());

        //dd($attributes);
        $vehicle = new Vehicle($attributes);
        $vehicle->save();
        flash()->success("Le véhicule a été enregistré avec succès");
        return redirect()->route('fleet.vehicle.show', $vehicle->uuid);

    }

    public function show(Vehicle $vehicle)
    {
        $trailers = Trailer::where('is_linked', false)
            ->where('status', TrailerStatus::Available)
            ->pluck('registration', 'id');

        return view('fleet.vehicle.show', [
            'vehicle' => $vehicle,
            'trailers' => $trailers,
        ]);
    }

    public function edit(Vehicle $vehicle)
    {
        return view('fleet.vehicle.edit', [
            'vehicle' => $vehicle,
            'types' => VehicleType::asSelectArray(),
            'brands' => Brand::pluck('name', 'id'),
            'patterns' => Pattern::pluck('name', 'id'),
            'usages' => FleetUsage::asSelectArray(),
            'states' => FleetState::asSelectArray(),
        ]);
    }

    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $attributes = $request->validated();

        if (!is_null($attributes['commissioning_date']))
            Arr::set($attributes, 'commissioning_date', Carbon::createFromFormat('d/m/Y', $attributes['commissioning_date'])->toDateString());

        $vehicle->update($attributes);

        flash()->success("Le véhicule a été modifié avec succès");
        return redirect()->route('fleet.vehicle.show', $vehicle->uuid);
    }

    public function print()
    {
        return view('fleet.vehicle.__print', [
            'vehicles' => Vehicle::with([
                'brand',
                'pattern',
                'activeTrailer',
                //'trailers',
                'documents',
                'drivers',
                'activeDriver'
            ])->get()
        ]);
    }
}




