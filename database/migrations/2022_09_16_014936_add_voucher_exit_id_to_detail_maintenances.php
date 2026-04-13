<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVoucherExitIdToDetailMaintenances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_maintenances', function (Blueprint $table) {
            $table->foreignId('exit_voucher_id')
                ->nullable()
                ->constrained('exit_vouchers')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_maintenances', function (Blueprint $table) {
            //
        });
    }
}
