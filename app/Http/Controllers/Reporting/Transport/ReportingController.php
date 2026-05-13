<?php

namespace App\Http\Controllers\Reporting\Transport;

use App\Enums\Exploitation\TripState;
use App\Enums\Fleet\AssignationStatus;
use App\Exports\FuelReportExport;
use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Driver;
use App\Models\EntranceVoucher;
use App\Models\Expense;
use App\Models\FuelOrder;
use App\Models\Garage;
use App\Models\Maintenance;
use App\Models\OtherExpense;
use App\Models\Repair;
use App\Models\Salary;
use App\Models\Sale;
use App\Models\States;
use App\Models\Trip;
use App\Models\Unload;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportingController extends Controller
{
    public function turnover(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');

        if ( $request->start_date && $request->end_date )
        {
            $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $vehicle = $request->vehicle;
            $folders = Trip::whereBetween('date', [$start, $end])
                ->Where('state', TripState::Billed)
                ->get();
            if ($vehicle)
                $folders = $folders->where('vehicle_id', $vehicle);

        } else {
            $folders = [];
        }

        return view('reporting.turnover', compact(
            'vehicles',
            'folders'
        ));
    }

    public function Unloads(Request $request)
    {
        $unloads = $this->getUnloads($request);

        return view('reporting.unloads', [
            'unloads' => $unloads
        ]);
    }

    public function print_unloads(Request $request)
    {
        $unloads = $this->getUnloads($request);

        return view('reporting.__print_unloads', [
            'unloads' => $unloads
        ]);
    }

    public function maintenance(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');

        if ( $request->start_date && $request->end_date )
        {
            $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $vehicle = $request->vehicle;
            $repairs = Repair::whereBetween('date', [$start, $end])
                ->get();
            if ($vehicle)
                $repairs = $repairs->where('vehicle_id', $vehicle);

        } else {
            $repairs = [];
        }

        return view('reporting.maintenance', compact(
            'vehicles',
            'repairs'
        ));
    }

    public function purchaseParts(Request $request)
    {
        if ( $request->start_date && $request->end_date )
        {
            $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $entrances = EntranceVoucher::whereBetween('date', [$start, $end])
                ->get();
        } else {
            $entrances = [];
        }

        return view('reporting.purchaseParts', compact('entrances'));
    }

    public function tripExpense(Request $request)
    {
        if ( $request->start_date && $request->end_date )
        {
            $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();

            $expenses = Expense::whereBetween('date_expense', [$start, $end])
                ->get();

        } else {
            $expenses = [];
        }
        return view('reporting.tripexpense', compact('expenses'));
    }

    public function missing(Request $request)
    {
        if ( $request->start_date && $request->end_date )
        {
            $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();

            $unloads = Unload::whereBetween('date', [$start, $end])
                ->get();

        } else {
            $unloads = [];
        }
        return view('reporting.missing', compact('unloads'));
    }

    public function salary(Request $request)
    {
        return view('reporting.salary', [
            'states' => $this->getSalary($request)
        ]);
    }

    public function printSalary(Request $request)
    {
        return view('exploitation.salary.print_state', [
            'states' => $this->getSalary($request)
        ]);
    }

    public function exploitation(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');

        if ( $request->month && $request->year)
        {
            $month = Carbon::parse($request->month);
            $year = $request->year;
            $vehicle = $request->vehicle;

            $sales = Sale::whereMonth('date_sale', $month->month)
                ->whereYear('date_sale', $year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereMonth('date_order', $month->month)
                ->whereYear('date_order', $year)
                ->get();

            $expenses = Expense::whereMonth('date_expense', $month->month)
                ->whereYear('date_expense', $year)
                ->get();

            $repairs = Repair::whereMonth('date', $month->month)
                ->whereYear('date', $year)
                ->get();

            $others = OtherExpense::whereMonth('date', $month->month)
                ->whereYear('date', $year)
                ->get();

            $states = $this->getSalary($request);

            if ($vehicle)
            {
               $sales = Sale::join('details','details.sale_id', '=', 'sales.id')
                    ->join('trips', 'trips.id', 'details.trip_id')
                    ->join('vehicles', 'vehicles.id', 'trips.vehicle_id')
                    ->whereMonth('date_sale', $month->month)
                    ->whereYear('date_sale', $year)
                    ->where('vehicle_id', $vehicle)
                    ->get();

                $fuels = FuelOrder::join('trips', 'trips.id', '=', 'fuel_orders.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereMonth('date_order', $month->month)
                    ->whereYear('date_order', $year)
                    ->get();

                //dd($fuels);

                $expenses = Expense::join('trips', 'trips.id', '=', 'expenses.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereMonth('date_expense', $month->month)
                    ->whereYear('date_expense', $year)
                    ->get();

                $repairs = $repairs->where('vehicle_id', $vehicle);

                $others = $others->where('vehicle_id', $vehicle);

                $states = States::join('salaries', 'states.id', 'salaries.state_id')
                    ->join('drivers', 'drivers.id', 'salaries.driver_id')
                    ->join('assignations', 'drivers.id', 'assignations.driver_id')
                    ->join('vehicles', 'assignations.vehicle_id', 'vehicles.id')
                    ->where('vehicle_id', $vehicle)
                    ->where('assignations.status', AssignationStatus::Active)
                    ->where('month', $request->month)
                    ->where('year', $request->year)
                    ->get();
            }

        } else {
            $sales = Sale::whereMonth('date_sale', now()->month)
                ->whereYear('date_sale', now()->year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereMonth('date_order', now()->month)
                ->whereYear('date_order', now()->year)
                ->get();

            //dd($fuels);
            $expenses = Expense::whereMonth('date_expense', now()->month)
                ->whereYear('date_expense', now()->year)
                ->get();

            $repairs = Repair::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->get();

            $others = OtherExpense::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->get();

            $states = States::with('salaries')
                ->where('month', now()->month()->format('F'))
                ->where('year', now()->year)
                ->first();
        }

        return view('reporting.exploitation', compact(
            [
                'vehicles',
                'sales',
                'fuels',
                'expenses',
                'repairs',
                'others',
                'states'
            ]
        ));
    }

    public function printExploitation(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');

        if ( $request->month && $request->year)
        {
            $month = Carbon::parse($request->month);
            $year = $request->year;
            $vehicle = $request->vehicle;

            $sales = Sale::whereMonth('date_sale', $month->month)
                ->whereYear('date_sale', $year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereMonth('date_order', $month->month)
                ->whereYear('date_order', $year)
                ->get();

            $expenses = Expense::whereMonth('date_expense', $month->month)
                ->whereYear('date_expense', $year)
                ->get();

            $repairs = Repair::whereMonth('date', $month->month)
                ->whereYear('date', $year)
                ->get();

            $others = OtherExpense::whereMonth('date', $month->month)
                ->whereYear('date', $year)
                ->get();

            $states = $this->getSalary($request);

            if ($vehicle)
            {
                $sales = Sale::join('details','details.sale_id', '=', 'sales.id')
                    ->join('trips', 'trips.id', 'details.trip_id')
                    ->join('vehicles', 'vehicles.id', 'trips.vehicle_id')
                    ->whereMonth('date_sale', $month->month)
                    ->whereYear('date_sale', $year)
                    ->where('vehicle_id', $vehicle)
                    ->get();

                $fuels = FuelOrder::join('trips', 'trips.id', '=', 'fuel_orders.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereMonth('date_order', $month->month)
                    ->whereYear('date_order', $year)
                    ->get();

                //dd($fuels);

                $expenses = Expense::join('trips', 'trips.id', '=', 'expenses.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereMonth('date_expense', $month->month)
                    ->whereYear('date_expense', $year)
                    ->get();

                $repairs = $repairs->where('vehicle_id', $vehicle);

                $others = $others->where('vehicle_id', $vehicle);

                $states = States::join('salaries', 'states.id', 'salaries.state_id')
                    ->join('drivers', 'drivers.id', 'salaries.driver_id')
                    ->join('assignations', 'drivers.id', 'assignations.driver_id')
                    ->join('vehicles', 'assignations.vehicle_id', 'vehicles.id')
                    ->where('vehicle_id', $vehicle)
                    ->where('assignations.status', AssignationStatus::Active)
                    ->where('month', $request->month)
                    ->where('year', $request->year)
                    ->get();
            }

        } else {
            $sales = Sale::whereMonth('date_sale', now()->month)
                ->whereYear('date_sale', now()->year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereMonth('date_order', now()->month)
                ->whereYear('date_order', now()->year)
                ->get();

            //dd($fuels);
            $expenses = Expense::whereMonth('date_expense', now()->month)
                ->whereYear('date_expense', now()->year)
                ->get();

            $repairs = Repair::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->get();

            $others = OtherExpense::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->get();

            $states = States::with('salaries')
                ->where('month', now()->month()->format('F'))
                ->where('year', now()->year)
                ->first();
        }

        return view('reporting.print_exploitation', compact(
            [
                'vehicles',
                'sales',
                'fuels',
                'expenses',
                'repairs',
                'others',
                'states'
            ]
        ));
    }

    public function annualExploitation(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');

        if ( $request->year)
        {
            $year = $request->year;
            $vehicle = $request->vehicle;

            $sales = Sale::whereYear('date_sale', $year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereYear('date_order', $year)
                ->get();

            $expenses = Expense::whereYear('date_expense', $year)
                ->get();

            $repairs = Repair::whereYear('date', $year)
                ->get();

            $others = OtherExpense::whereYear('date', $year)
                ->get();

            $states = $this->getYearSalary($request);

            if ($vehicle)
            {
                $sales = Sale::join('details','details.sale_id', '=', 'sales.id')
                    ->join('trips', 'trips.id', 'details.trip_id')
                    ->join('vehicles', 'vehicles.id', 'trips.vehicle_id')
                    ->whereYear('date_sale', $year)
                    ->where('vehicle_id', $vehicle)
                    ->get();

                $fuels = FuelOrder::join('trips', 'trips.id', '=', 'fuel_orders.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereYear('date_order', $year)
                    ->get();


                $expenses = Expense::join('trips', 'trips.id', '=', 'expenses.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereYear('date_expense', $year)
                    ->get();

                $repairs = $repairs->where('vehicle_id', $vehicle);

                $others = $others->where('vehicle_id', $vehicle);

                $states = States::join('salaries', 'states.id', 'salaries.state_id')
                    ->join('drivers', 'drivers.id', 'salaries.driver_id')
                    ->join('assignations', 'drivers.id', 'assignations.driver_id')
                    ->join('vehicles', 'assignations.vehicle_id', 'vehicles.id')
                    ->where('vehicle_id', $vehicle)
                    ->where('assignations.status', AssignationStatus::Active)
                    ->where('year', $request->year)
                    ->get();
            }

        } else {
            $sales = Sale::whereYear('date_sale', now()->year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereYear('date_order', now()->year)
                ->get();

            //dd($fuels);
            $expenses = Expense::whereYear('date_expense', now()->year)
                ->get();

            $repairs = Repair::whereYear('date', now()->year)
                ->get();

            $others = OtherExpense::whereYear('date', now()->year)
                ->get();

            $states = Salary::join('states', 'states.id', 'salaries.state_id')
                ->join('drivers', 'drivers.id', 'salaries.driver_id')
                ->where('year', now()->year)
                ->get();
        }

        return view('reporting.year_exploitation', compact(
            [
                'vehicles',
                'sales',
                'fuels',
                'expenses',
                'repairs',
                'others',
                'states'
            ]
        ));
    }

    public function printAnnualExploitation(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');

        if ( $request->year)
        {
            $year = $request->year;
            $vehicle = $request->vehicle;

            $sales = Sale::whereYear('date_sale', $year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereYear('date_order', $year)
                ->get();

            $expenses = Expense::whereYear('date_expense', $year)
                ->get();

            $repairs = Repair::whereYear('date', $year)
                ->get();

            $others = OtherExpense::whereYear('date', $year)
                ->get();

            $states = $this->getYearSalary($request);

            if ($vehicle)
            {
                $sales = Sale::join('details','details.sale_id', '=', 'sales.id')
                    ->join('trips', 'trips.id', 'details.trip_id')
                    ->join('vehicles', 'vehicles.id', 'trips.vehicle_id')
                    ->whereYear('date_sale', $year)
                    ->where('vehicle_id', $vehicle)
                    ->get();

                $fuels = FuelOrder::join('trips', 'trips.id', '=', 'fuel_orders.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereYear('date_order', $year)
                    ->get();

                //dd($fuels);

                $expenses = Expense::join('trips', 'trips.id', '=', 'expenses.trip_id')
                    ->where('vehicle_id', $vehicle)
                    ->whereYear('date_expense', $year)
                    ->get();

                $repairs = $repairs->where('vehicle_id', $vehicle);

                $others = $others->where('vehicle_id', $vehicle);

                $states = States::join('salaries', 'states.id', 'salaries.state_id')
                    ->join('drivers', 'drivers.id', 'salaries.driver_id')
                    ->join('assignations', 'drivers.id', 'assignations.driver_id')
                    ->join('vehicles', 'assignations.vehicle_id', 'vehicles.id')
                    ->where('vehicle_id', $vehicle)
                    ->where('assignations.status', AssignationStatus::Active)
                    ->where('year', $request->year)
                    ->get();
            }

        } else {
            $sales = Sale::whereYear('date_sale', now()->year)
                ->has('details')
                ->get();

            $fuels = FuelOrder::whereYear('date_order', now()->year)
                ->get();

            $expenses = Expense::whereYear('date_expense', now()->year)
                ->get();

            $repairs = Repair::whereYear('date', now()->year)
                ->get();

            $others = OtherExpense::whereYear('date', now()->year)
                ->get();

            $states = Salary::join('states', 'states.id', 'salaries.state_id')
                ->join('drivers', 'drivers.id', 'salaries.driver_id')
                ->where('year', now()->year)
                ->get();
        }

        return view('reporting.print_year-exploitation', compact(
            [
                'vehicles',
                'sales',
                'fuels',
                'expenses',
                'repairs',
                'others',
                'states'
            ]
        ));
    }

    public function getUnloads(Request $request): array| Collection
    {
        if ($request->start_date && $request->end_date) {
            $start = \Illuminate\Support\Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();

            $unloads = Unload::with(['trip.vehicle'])
                ->whereBetween('date', [$start, $end])
                ->get();

        } else {
            $unloads = [];
        }
        return $unloads;
    }

    public function getSalary(Request $request)
    {
        if ( $request->month && $request->year )
        {
            $month = $request->get('month');
            $year = $request->get('year');

            $states = States::with('salaries')
                ->where('month', $month)
                ->where('year', $year)
                ->first();

        } else {
            $states = [];
        }
        return $states;
    }

    public function getYearSalary(Request $request)
    {
        if ( $request->year )
        {
            $year = $request->get('year');

            $states = Salary::join('states', 'states.id', 'salaries.state_id')
                ->join('drivers', 'drivers.id', 'salaries.driver_id')
                ->where('year', $year)
                ->get();

        } else {
            $states = [];
        }
        return $states;
    }

    public function fuels(Request $request)
    {
        $vehicles = Vehicle::pluck('registration', 'id');
        $fuels = $this->getFuels($request);

        return view('reporting.fuels', compact('fuels', 'vehicles'));
    }

    public function print_fuels(Request $request)
    {
        $fuels = $this->getFuels($request);
        return view('reporting.print_fuels', compact('fuels'));
    }

    public function exportFuelExcel(Request $request)
    {
        $fuels = (new FuelReportExport())->for($request);
         return Excel::download($fuels, 'Rapport-de-carburant.xlsx');
    }

    protected function getFuels(Request $request): array|Collection
    {
        $fuels = FuelOrder::with(['trip', 'provider'])
            ->join('trips', 'fuel_orders.trip_id', 'trips.id')
            ->select('fuel_orders.*', 'trips.date as date_trip', 'trips.vehicle_id as vehicle_id')
            ->get();
        if ($request->start_date && $request->end_date) {
            $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
            $fuels = $fuels->whereBetween('date_order', [$start, $end]);
            if ($request->vehicle) {
                $vehicle = $request->vehicle;
                $fuels = $fuels->where('registration', $vehicle);
            }
        } else {
            $fuels = [];
        }
        return $fuels;
    }

}
