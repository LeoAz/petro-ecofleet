<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->foreignId('trip_id')
                ->nullable()
                ->constrained('trips')
                ->onUpdate('cascade');

            $table->foreignId('provider_id')
                ->nullable()
                ->constrained('providers')
                ->onUpdate('cascade');

            $table->foreignId('supply_id')
                ->nullable()
                ->constrained('supplyings')
                ->onUpdate('cascade');

            $table->string('place')->nullable();
            $table->string('code_order')->unique()->nullable();
            $table->dateTime('date_order')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('unit_price')->nullable();
            $table->integer('total_price')->nullable();
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
        Schema::dropIfExists('fuel_orders');
    }
}
