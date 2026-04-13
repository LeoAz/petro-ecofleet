<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecapIdToOtherExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_expenses', function (Blueprint $table) {
            $table->foreignId('recap_id')
                ->nullable()
                ->constrained('recap_dailies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_expenses', function (Blueprint $table) {
            //
        });
    }
}
