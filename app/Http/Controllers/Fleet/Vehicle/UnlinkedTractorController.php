<?php

namespace App\Http\Controllers\Fleet\Vehicle;

use App\Enums\Fleet\VehicleStatus;
use App\Enums\Fleet\VehicleType;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class UnlinkedTractorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('fleet.vehicle.state.unlinkedtractor', [
            'vehicles' => Vehicle::with([
                'brand',
                'pattern',
                'activeTrailer',
                'documents',
                'drivers',
                'activeDriver'
            ])
                ->where('is_linked', false)
                ->where('type', VehicleType::Tracteur)
                ->where('is_tier', false)
                ->get()
                ->sortByDesc('created_at')
        ]);
    }
}
