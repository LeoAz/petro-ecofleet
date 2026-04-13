<?php

namespace App\Http\Controllers\Cashbox\Operation;

use App\Enums\Exploitation\ExpenseStatus;
use App\Enums\OpType;
use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Expense;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PayExpenseController extends Controller
{

    public function __invoke(Request $request, Cashbox $box, Expense $expense)
    {
       $attribute = $this->validate($request, [
            'status' => ['required']
        ]);
        throw_if( $expense->status === ExpenseStatus::Paid,
            ValidationException::withMessages([
                'error' => 'La dépense est déja payé'
            ])
        );
        $expense->update($attribute);
        $operation = new Operation([
            'uuid' => Str::uuid()->toString(),
            'op_type' => OpType::CashOut,
            'vehicle' => $expense->trip->vehicle->registration,
            'driver' => $expense->trip->driver,
            'paid_at' => now()->toString(),
            'type_expense' => $expense->type->description,
            'amount' => $expense->amount,
            'beneficiary' => $expense->trip->driver,
            'box_id' => $box->id
        ]);
        $operation->save();

        // box update
        $box->total_expenses += $operation->amount;
        $box->solde = ($box->start_solde + $box->total_appros) - $box->total_expenses;
        $box->save();

        // mise a jour de l'expense
        $expense->box_id = $box->id;
        $expense->save();

        flash()->success("L'opération de paiement a été enregistré avec succés");
        return redirect()->route('cashbox.operation', $box->uuid);
    }
}
