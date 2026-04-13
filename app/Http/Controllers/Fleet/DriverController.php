<?php

namespace App\Http\Controllers\Fleet;

use App\Enums\Fleet\DriverStatus;
use App\Enums\Fleet\VehicleStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fleet\Driver\DriverPostRequest;
use App\Http\Requests\Fleet\Driver\DriverUpdateRequest;
use App\Models\Driver;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    public function index()
    {
        return view('fleet.driver.index', [
            'drivers' => Driver::all()->sortByDesc('created_at')

        ]);
    }

    public function store(DriverPostRequest $request)
    {
        $attributes = $request->validated();

        if (!is_null($attributes['birth_date']))
            Arr::set($attributes, 'birth_date', Carbon::createFromFormat('d/m/Y', $attributes['birth_date'])->toDateString());

        if (!is_null($attributes['exp_date']))
            Arr::set($attributes, 'exp_date', Carbon::createFromFormat('d/m/Y', $attributes['exp_date'])->toDateString());

        Arr::set($attributes,'uuid', Str::uuid()->toString());
        Arr::set($attributes, 'status', DriverStatus::Unassign);

        //dd($attributes);

        $driver = new Driver($attributes);
        $driver->save();

        flash()->success("Le chauffeur a été enregistré avec succès");
        return redirect()->route('fleet.driver.show', $driver->uuid);
    }

    public function show(Driver $driver)
    {
        $vehicles = Vehicle::with([
            'brand',
            'pattern',
            'activeTrailer',
            'trailers',
            'documents',
            'drivers',
            'activeDriver'
        ])
            ->where('has_driver', false)
            ->where('status', VehicleStatus::Available)
            ->pluck('registration', 'id');

        return view('fleet.driver.details', [
            'driver' => $driver,
            'vehicles' => $vehicles
        ]);
    }

    public function edit(Driver $driver)
    {
        return view('fleet.driver.edit', [
            'driver' => $driver
        ]);
    }

    public function update(DriverUpdateRequest $request, Driver $driver)
    {
        $attributes = $request->validated();

        if (!is_null($attributes['birth_date']))
            Arr::set($attributes, 'birth_date', Carbon::createFromFormat('d/m/Y', $attributes['birth_date'])->toDateString());

        if (!is_null($attributes['exp_date']))
            Arr::set($attributes, 'exp_date', Carbon::createFromFormat('d/m/Y', $attributes['exp_date'])->toDateString());

        $driver->update($attributes);

        flash()->success("Le chauffeur a été modifié avec succès");
        return redirect()->route('fleet.driver.show', $driver->uuid);
    }
}
