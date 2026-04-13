<?php

namespace App\Http\Controllers\Cashbox\Operation;

use App\Enums\OpType;
use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CashOutBoxController extends Controller
{
    public function __invoke(Request $request, Cashbox $box)
    {
        $attributes = $this->validate($request, [
            'amount' => ['required'],
            'beneficiary' => ['required'],
            'description' => ['nullable'],
        ]);
        Arr::set($attributes, 'box_id', $box->id);
        Arr::set($attributes, 'paid_at', now()->toDateString());
        Arr::set($attributes, 'op_type', OpType::CashOut);
        Arr::set($attributes, 'uuid', Str::uuid()->toString());

        $out = new Operation($attributes);
        $out->save();

        $box->total_expenses += $out->amount;
        $box->solde = ($box->start_solde + $box->total_appros) - $box->total_expenses;
        $box->save();

        flash()->success("L'opération de retrait a été enregistré avec succés");
        return redirect()->back();
    }
}
