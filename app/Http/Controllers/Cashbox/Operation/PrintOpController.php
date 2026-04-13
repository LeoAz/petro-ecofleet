<?php

namespace App\Http\Controllers\Cashbox\Operation;

use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Operation;
use Illuminate\Http\Request;

class PrintOpController extends Controller
{
    public function __invoke(Cashbox $box, Operation $operation)
    {
        return view('cashbox.__print', [
            'box' => $box,
            'operation' => $operation
        ]);
    }
}
