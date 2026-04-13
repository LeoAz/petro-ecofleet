<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateExitVoucher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exit_vouchers', function (Blueprint $table) {
            $table->tinyInteger('state_voucher')->default(\App\Enums\Maintenance\ExitVoucherState::Unused);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exit_vouchers', function (Blueprint $table) {
            //
        });
    }
}
