<?php

namespace App\Http\Controllers\Maintenance\Inventory\Detail;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Part;
use Illuminate\Http\Request;

class PrintPartController extends Controller
{
    public function __invoke(Inventory $inventory)
    {
        return view('maintenance.inventory.detail.__printPart', [
            'parts' => Part::all()
        ]);
    }
}
