<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('code_trip')->unique()->nullable();

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->onUpdate('cascade');

            $table->string('start_point')->nullable();
            $table->string('end_point')->nullable();

            $table->foreignId('road_id')
                ->nullable()
                ->constrained('roads')
                ->onUpdate('cascade');

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->onUpdate('cascade');

            $table->foreignId('plan_id')
                ->nullable()
                ->constrained('plans')
                ->onUpdate('cascade');

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->onUpdate('cascade');

            $table->dateTime('load_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->text('observation')->nullable();
            $table->tinyInteger('state')->default(\App\Enums\Exploitation\TripState::Unbilled);
            $table->tinyInteger('status')->default(\App\Enums\Exploitation\TripStatus::Ongoing);
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
        Schema::dropIfExists('trips');
    }
}
