<?php

namespace App\Http\Controllers\Fleet\Vehicle;

use App\Enums\Fleet\VehicleStatus;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TravelFleetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('fleet.vehicle.state.travel', [
            'vehicles' => Vehicle::with([
                'brand',
                'pattern',
                'activeTrailer',
                'documents',
                'drivers',
                'activeDriver'
            ])
                ->where('status', VehicleStatus::Travel)
                ->where('is_tier', false)
                ->get()
                ->sortByDesc('created_at')
        ]);
    }
}
