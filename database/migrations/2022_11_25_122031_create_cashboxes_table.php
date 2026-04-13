<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashboxes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->integer('start_solde')->nullable();
            $table->integer('total_appros')->nullable();
            $table->integer('total_expenses')->nullable();
            $table->integer('solde')->nullable();
            $table->tinyInteger('status')->default(\App\Enums\CashboxStatus::Open);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashboxes');
    }
}
