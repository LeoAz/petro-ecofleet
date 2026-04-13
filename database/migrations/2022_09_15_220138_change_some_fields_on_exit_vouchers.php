<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeFieldsOnExitVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exit_vouchers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('maintenance_id');
            $table->dropConstrainedForeignId('repair_id');
            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->cascadeOnUpdate();
            $table->tinyInteger('status_exit')->default(\App\Enums\Maintenance\ExitVoucherStatus::Opened);
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
