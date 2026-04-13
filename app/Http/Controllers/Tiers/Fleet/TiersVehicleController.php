<?php

namespace App\Http\Controllers\Tiers\Fleet;

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
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TiersVehicleController extends Controller
{
    public function index()
    {
        return view('tiers.fleet.vehicle.index',[
            'vehicles' => Vehicle::with([
                'brand',
                'pattern',
            ])
                ->where('is_tier', true)
                ->get()
                ->sortByDesc('created_at'),
            'types' => VehicleType::asSelectArray(),
            'brands' => Brand::pluck('name', 'id'),
            'patterns' => Pattern::pluck('name', 'id'),
            'usages' => FleetUsage::asSelectArray(),
        ]);
    }

    public function store(VehiclePostRequest $request)
    {
        $attributes = $request->validated();

        Arr::set($attributes,'uuid', Str::uuid()->toString());
        Arr::set($attributes,'is_tier', true);
        Arr::set($attributes,'unit', 0);


        $vehicle = new Vehicle($attributes);
        $vehicle->save();

        flash()->success("Le véhicule a été enregistré avec succès");

        return redirect()->back();
    }

    public function edit(Vehicle $vehicle)
    {
        return view('tiers.fleet.vehicle.edit', [
            'vehicle' => $vehicle,
            'brands' => Brand::pluck('name', 'id'),
        ]);
    }

    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $attributes = $request->validated();
        $vehicle->update($attributes);

        flash()->success("Le véhicule a été modifié avec succès");
        return redirect()->route('tiers.fleet.vehicle.index');
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
