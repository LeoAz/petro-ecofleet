<?php

namespace App\Http\Controllers\Fleet;

use App\Enums\Fleet\FleetState;
use App\Enums\Fleet\FleetUsage;
use App\Enums\Fleet\TrailerStatus;
use App\Enums\Fleet\TrailerType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fleet\Trailer\TrailerPostRequest;
use App\Http\Requests\Fleet\Trailer\TrailerUpdateRequest;
use App\Models\Brand;
use App\Models\Pattern;
use App\Models\Trailer;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TrailerController extends Controller
{
    public function index()
    {
        return view('fleet.trailer.index', [
            'trailers' => Trailer::with([
                'brand',
                'pattern',
                'activeVehicle'
            ])->get()->sortByDesc('created_at'),
            'types' => TrailerType::asSelectArray(),
            'brands' => Brand::pluck('name', 'id'),
            'patterns' => Pattern::pluck('name', 'id'),
            'usages' => FleetUsage::asSelectArray(),
            'states' => FleetState::asSelectArray(),
            ]);
    }

    public function garage()
    {
        return view('fleet.trailer.garage', [
            'trailers' => Trailer::with([
                'brand',
                'pattern',
                'activeVehicle'
            ])->where('status', TrailerStatus::Garage)->get()
        ]);
    }

    public function reform()
    {
        return view('fleet.trailer.reform', [
            'trailers' => Trailer::with([
                'brand',
                'pattern',
                'activeVehicle'
            ])->where('status', TrailerStatus::Reform)->get()
        ]);
    }

    public function store(TrailerPostRequest $request)
    {
        $attributes = $request->validated();
        if (!is_null($attributes['commissioning_date']))
            Arr::set($attributes, 'commissioning_date', Carbon::createFromFormat('d/m/Y', $attributes['commissioning_date'])->toDateString());

        Arr::set($attributes,'uuid', Str::uuid()->toString());
        Arr::set($attributes, 'status', TrailerStatus::Available);
        Arr::set($attributes, 'state', FleetState::Neuf);

        //dd($attributes);

        $trailer = new Trailer($attributes);
        $trailer->save();

        flash()->success("La remorque a été enregistrée avec succès");
        return redirect()->route('fleet.trailer.show', $trailer->uuid);
    }

    public function show(Trailer $trailer)
    {
        return view('fleet.trailer.details', [
            'trailer' => $trailer
        ]);
    }

    public function edit(Trailer $trailer)
    {
        return view('fleet.trailer.edit', [
            'trailer' => $trailer,
            'types' => TrailerType::asSelectArray(),
            'brands' => Brand::pluck('name', 'id'),
            'patterns' => Pattern::pluck('name', 'id'),
            'usages' => FleetUsage::asSelectArray(),
            'states' => FleetState::asSelectArray(),
        ]);
    }

    public function update(TrailerUpdateRequest $request, Trailer $trailer)
    {
        $attributes = $request->validated();
        if (!is_null($attributes['commissioning_date']))
            Arr::set($attributes, 'commissioning_date', Carbon::createFromFormat('d/m/Y', $attributes['commissioning_date']));

        $trailer->update($attributes);
        flash()->success("La remorque a été modifiée avec succès");
        return redirect()->route('fleet.trailer.show', $trailer->uuid);
    }

}
