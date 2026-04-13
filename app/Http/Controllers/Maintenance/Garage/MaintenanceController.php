<?php

namespace App\Http\Controllers\Maintenance\Garage;

use App\Enums\Fleet\VehicleStatus;
use App\Enums\Maintenance\ExitVoucherState;
use App\Enums\Maintenance\ExitVoucherStatus;
use App\Enums\Maintenance\GarageStatus;
use App\Enums\Maintenance\PartState;
use App\Http\Controllers\Controller;
use App\Models\ExitVoucher;
use App\Models\Garage;
use App\Models\Maintenance;
use App\Models\Part;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class MaintenanceController extends Controller
{
    public function store(Request $request, Garage $garage)
    {
        $attributes = $this->rules($request);

        $garage->maintenances()->create($attributes);
        $garage->status = GarageStatus::Ongoing;
        $garage->save();

        flash()->info("La maintenance a été enregistré avec succés, Merci de rajotuté des piéces de rechange si elle ont été utiliser lors de la maintenance.");

        return redirect()->route('maintenance.entretien.detail', [$garage->id, $garage->maintenances->uuid]);
    }

    public function detail(Garage $garage, Maintenance $maintenance)
    {
       return view('maintenance.entretien.detail', [
           'maintenance' => $maintenance,
           'garage' => $garage,
           'parts' => Part::where('state', PartState::InStock)->get()
       ]);
    }

    public function edit(Maintenance $maintenance)
    {
        return view('maintenance.entretien.edit', [
            'maintenance' => $maintenance
        ]);
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        throw_if( $maintenance->garage->status == GarageStatus::Finished,
            ValidationException::withMessages([
                'error' => 'La maintenance est déja clôturer, Vous ne pouvez plus modifier les informations'])
        );

        $attributes = $this->rules($request);

        $maintenance->updateOrFail($attributes);
        $maintenance->save();

        flash()->info("La maintenance a été modifier avec succés, Merci de rajotuté des piéces de rechange si elle ont été utiliser lors de la maintenance.");

        return redirect()->route('maintenance.entretien.detail', $maintenance->uuid);
    }

    public function closed(Request $request, Garage $garage)
    {
        $attribute = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $garage->status === GarageStatus::Finished,
            ValidationException::withMessages([
                'error' => 'La maintenance est déja clôturée. le véhicule est de nouveau disponible'])
        );

        /*foreach ( $garage->maintenances->parts as $part)
        {
            // fails always
            $exit = ExitVoucher::findOrFail($part->exit_voucher_id);
            if ( $exit->state_voucher === ExitVoucherState::Unused)
            {
                $exit->update([
                    'state_voucher' => ExitVoucherState::Used
                ]);
            }
        }*/

      $garage->updateOrFail($attribute);


        //on sort le véhicule du garage
        $garage->vehicle->update([
            'status' => VehicleStatus::Available
        ]);

        flash()->success("La maintenance a été clôturer avec succès");
        return redirect()->back();
    }

    public function opened(Request $request, Garage $garage)
    {
        $attributes = $this->validate($request, [
            'status' => 'required'
        ]);

        throw_if( $garage->status != GarageStatus::Finished,
            ValidationException::withMessages([
                'error' => 'La maintenance est déja ouverte et en cours.'])
        );

        $garage->updateOrFail($attributes);

        //on remet le vehicule au garage
        $garage->vehicle->update([
            'status' => VehicleStatus::Garage
        ]);

        flash()->info("La maintenance a été reouvert avec succès, la quantités des pieces séléctionnées sont retourné en stock. Clôturer la mainenance pour la mise a jour du stock");
        return redirect()->back();
    }

    public function print(Garage $garage, Maintenance $maintenance)
    {
        return view('maintenance.entretien.__print', [
            'garage' => $garage,
            'maintenance' => $maintenance
        ]);
    }

    private function rules(Request $request): array
    {
        $attributes = $this->validate($request, [
            'date' => ['required'],
            'mileage' => ['nullable', 'numeric'],
            'treshold' => ['nullable', 'numeric'],
            'amount' => ['required', 'numeric'],
            'unit' => ['required'],
            'description' => ['nullable'],
            'next_mileage' => ['nullable'],
            'next_date' => ['nullable'],
        ], [
            'date.required' => 'La date de la maintenance est obligatoire',
            'amount.required' => 'Le coute de la main d\'oeuvre de la maintenance est obligatoire',
            'amount.numeric' => 'Le coute de la main d\'oeuvre de la maintenance doit etre en chiffre',
            // 'mileage.required' => 'Le kilométrage du véhicule est obligatoire',
            //'treshold.numeric' => 'Le seuil pour la prochaine maintenance doit etre en chiffre',
            'mileage.numeric' => 'Le kilométrage du véhicule doit etre en chiffre',
            'treshold.required' => 'Le seuil pour la prochaine maintenance est obligatoire',
            'unit.required' => 'L\'unité pour déterminer le seuil est obligatoire',
        ]);

        if ($attributes['unit'] == 'kilometre') {
            Arr::set($attributes, 'next_mileage',
                $attributes['mileage'] + $attributes['treshold']
            );
        }

        if (!is_null($attributes['date']))
        Arr::set($attributes, 'date', Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString());

        if ($attributes['unit'] == 'mois') {
            $date = $attributes['date'];
            Arr::set($attributes, 'next_date',
                Carbon::createFromDate($date)->addMonths($attributes['treshold'])->toDateString()
            );
        }
        return $attributes;
    }
}
