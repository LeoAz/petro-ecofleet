<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndChangeFieldsToSupplyings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplyings', function (Blueprint $table) {
            $table->renameColumn('trajet', 'start_point');
        });
        Schema::table('supplyings', function (Blueprint $table) {
            $table->string('end_point');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplyings', function (Blueprint $table) {
            //
        });
    }
}
