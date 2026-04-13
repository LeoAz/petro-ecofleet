<?php

namespace App\Http\Controllers\Maintenance\Warehouse\Voucher;

use App\Http\Controllers\Controller;
use App\Models\EntranceVoucher;

class EntranceVoucherController extends Controller
{
    public function index()
    {
        return view('maintenance.warehouse.voucher.entranceVoucher.entrance', [
            'entrances' => EntranceVoucher::all()->sortByDesc('created_at')
        ]);
    }

    public function print(EntranceVoucher $entrance)
    {
        return view('maintenance.warehouse.voucher.entranceVoucher.__printEntrance', [
            'entrance' => $entrance
        ]);
    }
}
