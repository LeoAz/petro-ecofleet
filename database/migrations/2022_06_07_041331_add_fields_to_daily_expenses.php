<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToDailyExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_expenses', function (Blueprint $table) {
            $table->string('expense_type')->nullable();
            $table->string('trajet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_expenses', function (Blueprint $table) {
            $table->dropColumn('expense_type');
            $table->dropColumn('trajet');
        });
    }
}
