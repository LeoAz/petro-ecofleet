<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQuantityType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_inventories', function (Blueprint $table) {
            $table->bigInteger('theoriq_qty')->change();
            $table->bigInteger('real_qty')->change();
            $table->bigInteger('ecart')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_inventories', function (Blueprint $table) {
        });
    }
}
