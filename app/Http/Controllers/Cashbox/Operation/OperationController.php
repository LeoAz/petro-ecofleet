<?php

namespace App\Http\Controllers\Cashbox\Operation;

use App\Exports\OperationExport;
use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Operation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class OperationController extends Controller
{
    public function edit(Cashbox $box, Operation $operation)
    {
        return view('cashbox.operation.edit', [
            'operation' => $operation,
            'box' => $box
        ]);
    }

    public function update(Request $request, Cashbox $box, Operation $operation)
    {
        $attributes = $this->validate($request, [
            'amount' => ['required'],
            'beneficiary' => ['required'],
            'description' => ['nullable'],
        ]);
        $box->total_expenses += ($attributes['amount'] - $operation->amount);
        $box->solde = ($box->start_solde + $box->total_appros) - $box->total_expenses;
        $box->save();

        $operation->update($attributes);

        flash()->success("L'opération d'approvisionnement a été enregistré avec succés");
        return redirect()->route('cashbox.detail', $operation->box->uuid);
    }

    public function printOperation(Cashbox $box)
    {
        return view('cashbox.operation.__printOperation', [
            'box' => $box
        ]);
    }

    public function exportOpExcel(Cashbox $box)
    {
        return (new OperationExport())->forBox($box->id)->download('Liste-des-opérations.xlsx');
    }

    public function printOpByType(Request $request, Cashbox $box)
    {
        if ( $request->expense)
        {
            $operations = Operation::where('box_id', $box->id)
                ->where('type_expense', $request->expense)
                ->get();
        } else {
            $operations = [];
        }

         return view('cashbox.operation.__printOpType', [
             'operations' => $operations
         ]);
    }
}
