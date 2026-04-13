<?php

namespace App\Http\Controllers\Cashbox\Operation;

use App\Enums\Exploitation\ExpenseStatus;
use App\Enums\OpType;
use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Operation;
use App\Models\OtherExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PayOtherController extends Controller
{
    public function __invoke(Request $request, Cashbox $box, OtherExpense $other)
    {
        $attribute = $this->validate($request, [
            'status' => ['required']
        ]);

        throw_if( $other->status === ExpenseStatus::Paid,
            ValidationException::withMessages([
                'error' => 'La dépense est déja payé'
            ])
        );
        $other->update($attribute);
        $operation = new Operation([
            'uuid' => Str::uuid()->toString(),
            'op_type' => OpType::CashOut,
            'vehicle' => $other->vehicle->registration,
            'paid_at' => now()->toDateString(),
            'amount' => $other->amount,
            'motif' => $other->motif,
            'beneficiary' => $other->beneficiary ?? '-',
            'box_id' => $box->id
        ]);
        $operation->save();

        // box update
        $box->total_expenses += $operation->amount;
        $box->solde = ($box->start_solde + $box->total_appros) - $box->total_expenses;
        $box->save();

        // mise a jour de l' other expense
        $other->box_id = $box->id;
        $other->save();

        flash()->success("L'opération de paiement a été enregistré avec succés");
        return redirect()->route('cashbox.operation', $box->uuid);
    }
}
