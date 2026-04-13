<?php

namespace App\Http\Controllers\Dashbord\Transport;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Expense;
use App\Models\FuelOrder;
use App\Models\Garage;
use App\Models\Repair;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index(Request $request)
    {
        if ($request->date_filter) {
            $month = Carbon::createFromFormat('d/m/Y', $request->date_filter)->month;
            $year = Carbon::createFromFormat('d/m/Y', $request->date_filter)->year;

            $fuelOrders = FuelOrder::whereMonth('date_order', $month)
                ->whereYear('date_order', $year)
                ->get();

            $expenses = Expense::whereMonth('date_expense', $month)
                ->whereYear('date_expense', $year)
                ->get();

            $repairs = Repair::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->get();

            $sales = Sale::whereMonth('date_sale', $month)
                ->whereYear('date_sale', $year)
                ->get();

            $docs = Document::whereMonth('exp_date', $month)
                ->whereYear('exp_date', $year)
                ->get();

            $garages = Garage::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->get();
        } else {
            $fuelOrders = FuelOrder::whereMonth('date_order', now()->month)
                ->whereYear('date_order', now()->year)
                ->get();

            $expenses = Expense::whereMonth('date_expense', now()->month)
                ->whereYear('date_expense', now()->year)
                ->get();

            $repairs = Repair::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->get();

            $sales = Sale::whereMonth('date_sale', now()->month)
                ->whereYear('date_sale', now()->year)
                ->get();

            $docs = Document::whereMonth('exp_date', now()->month)
                ->whereYear('exp_date', now()->year)
                ->get();

            $garages = Garage::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->get();
        }

        return view('dashbord.index', compact(
            'fuelOrders',
            'expenses',
            'repairs',
            'docs',
            'garages',
            'sales'
        ));
    }
}
