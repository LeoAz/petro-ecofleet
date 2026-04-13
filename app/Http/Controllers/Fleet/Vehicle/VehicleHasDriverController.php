<?php

namespace App\Http\Controllers\Fleet\Vehicle;

use App\Enums\Fleet\VehicleType;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleHasDriverController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('fleet.vehicle.state.vehiclehasdriver', [
            'vehicles' => Vehicle::with([
                'brand',
                'pattern',
                'activeTrailer',
                'documents',
                'drivers',
                'activeDriver'
            ])
                ->where('has_driver', true)
                ->where('is_tier', false)
                ->get()
                ->sortByDesc('created_at')
        ]);
    }
}
