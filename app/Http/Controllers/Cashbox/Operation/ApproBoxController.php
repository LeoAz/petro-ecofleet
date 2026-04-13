<?php

namespace App\Http\Controllers\Cashbox\Operation;

use App\Enums\OpType;
use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ApproBoxController extends Controller
{
    public function __invoke(Request $request, Cashbox $box)
    {
        $attributes = $this->validate($request, [
            'amount' => ['required'],
            'motif' => ['nullable'],
            'description' => ['nullable'],
        ]);
        Arr::set($attributes, 'box_id', $box->id);
        Arr::set($attributes, 'paid_at', now()->toDateString());
        Arr::set($attributes, 'op_type', OpType::CashIn);
        Arr::set($attributes, 'uuid', Str::uuid()->toString());

        $appro = new Operation($attributes);
        $appro->save();

        $box->total_appros += $appro->amount;
        $box->solde = ($box->start_solde + $box->total_appros) - $box->total_expenses;
        $box->save();

        flash()->success("L'opération d'approvisionnement a été enregistré avec succés");
        return redirect()->back();
    }
}
