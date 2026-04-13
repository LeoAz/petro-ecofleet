<?php

namespace App\Exports;

use App\Models\FuelOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FuelReportExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    public function query()
    {
        $fuels = FuelOrder::with(['trip', 'provider'])
            ->join('trips', 'fuel_orders.trip_id', 'trips.id')
            ->select('fuel_orders.*', 'trips.trip_date as date_trip', 'trips.vehicle_id as vehicle_id')
            ->get();
        if ($this->request->start_date && $this->request->end_date) {
            $start = Carbon::createFromFormat('d/m/Y', $this->request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $this->request->end_date)->toDateString();
            $fuels = $fuels->whereBetween('date_order', [$start, $end]);
            if ($this->request->vehicle) {
                $vehicle = $this->request->vehicle;
                $fuels = $fuels->where('registration', $vehicle);
            }

        } else {
            $fuels = [];
        }
        return $fuels;
    }

    public function for(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function headings(): array
    {
        return [
            'N° Bon',
            'VEHICULE',
            'PLACE',
            'DATE',
            'QUANTITE',
            'PRIX UNITAIRE',
            'PRIX TOTAL',
            'FOURNISSEUR'
        ];
    }

    public function map($fuel): array
    {
        return [
            $fuel->code_order,
            $fuel->registration,
            $fuel->place,
            Carbon::parse($fuel->date_order)->format('d/m/Y'),
            $$fuel->quantity,
            $fuel->unit_price,
            $fuel->total_price,
            $fuel->provider->name ?? '-',
        ];
    }
}
