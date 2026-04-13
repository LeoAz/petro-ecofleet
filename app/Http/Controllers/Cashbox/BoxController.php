<?php

namespace App\Http\Controllers\Cashbox;

use App\Enums\CashboxStatus;
use App\Enums\Exploitation\ExpenseStatus;
use App\Enums\OpType;
use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Expense;
use App\Models\Operation;
use App\Models\OtherExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BoxController extends Controller
{
    public function index()
    {
        $box = Cashbox::latest()->get();
        return view('cashbox.index', [
            'latest_box' => $box,
            'boxes' => Cashbox::all()->sortByDesc('created_at')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'start_solde' => ['required']
        ]);
        Arr::set($attributes, 'uuid', Str::uuid()->toString());
        Arr::set($attributes, 'start_at', now()->toDateString());
        Arr::set($attributes, 'status', CashboxStatus::Open);

        $box = new Cashbox($attributes);
        $box->save();

        flash()->success("La caisse du jour à été ouvert avec succés");
        return redirect()->route('cashbox.detail', $box->uuid);
    }

    public function details(Cashbox $box)
    {
        $types = $box->operations->pluck('type_expense', 'id')
            ->unique()
            ->filter();

        return view('cashbox.details', [
            'box' => $box,
            'types' => $types
        ]);
    }

    public function operation(Cashbox $box)

    {
        $firstBox = Cashbox::first();
        //  dd($firstBox);
        $expenses = Expense::where('status', ExpenseStatus::Unpaid)
            ->whereDate( 'date_expense', '>=', $firstBox->start_at)
            ->get();

        $others = OtherExpense::where('status', ExpenseStatus::Unpaid)
            ->where('date', '>=', $firstBox->start_at)
            ->get();

        return view('cashbox.operations', [
            'box' => $box,
            'expenses' => $expenses,
            'others' => $others
        ]);
    }
    public function closed(Request $request, Cashbox $box)
    {
        $box->update([
            'end_at' => now()->toDateString(),
            'status' => CashboxStatus::Closed
        ]);

        $newbox = new Cashbox([
            'uuid' => Str::uuid()->toString(),
            'start_at' => now()->toDateString(),
            'start_solde' => $box->solde,
            'total_appros' => 0,
            'total_expenses' => 0
        ]);
        $newbox->save();
        flash()->success("La caisse du jour à été ouvert avec succés");
        return redirect()->route('cashbox.detail', $newbox->uuid);
    }

    public function delete(Cashbox $box)
    {

    }
}
