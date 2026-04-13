<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDailyIdOnOtherExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_expenses', function (Blueprint $table) {
            $table->foreignId('daily_id')
                ->nullable()
                ->constrained('daily_others')
                ->onDelete('cascade');
            $table->tinyInteger('status')->default(\App\Enums\Exploitation\OtherStatus::Unpaid);
            $table->dropColumn('type');
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
            $table->dropConstrainedForeignId('daily_id');
            $table->dropColumn('status');
            $table->string('type');
        });
    }
}
