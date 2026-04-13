<?php

namespace App\Http\Controllers\Maintenance\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\DetailExitVoucher;
use App\Models\ExitVoucher;
use App\Models\Part;
use App\Models\Unload;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function exitVoucher(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');
        $parts = Part::all();
        $exitVouchers = $this->getExitParts($request);
        return view('maintenance.warehouse.report.exitVoucher', compact('exitVouchers', 'vehicles', 'parts'));
    }

    public function printExitVoucher(Request $request)
    {
        $exitVouchers = $this->getExitParts($request);
        return view('maintenance.warehouse.report.__printExitVoucher', compact('exitVouchers'));
    }


    public function getExitParts(Request $request): Collection | array
    {
        if ($request->start_date && $request->end_date) {
            $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $vehicle = $request->vehicle;
            $part = $request->part;

            $exitVouchers = ExitVoucher::with(['vehicle'])
                ->join('detail_exit_vouchers', 'detail_exit_vouchers.exit_id', 'exit_vouchers.id')
                ->join('parts', 'detail_exit_vouchers.part_id', 'parts.id')
                ->whereBetween('date', [$start, $end])
                ->select('exit_vouchers.*', 'detail_exit_vouchers.*', 'parts.reference', 'parts.name')
                ->when($vehicle, function ($query, $vehicle) {
                    $query->where('vehicle_id', $vehicle);
                })
                ->when($part, function ($query, $part) {
                    $query->where('part_id', $part);
                })
                ->get();

        } else {
            $exitVouchers = [];
        }
        return $exitVouchers;
    }
}
