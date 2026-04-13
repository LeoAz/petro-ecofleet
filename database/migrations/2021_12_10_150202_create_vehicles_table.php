<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->onUpdate('cascade');

            $table->foreignId('pattern_id')
                ->nullable()
                ->constrained('patterns')
                ->onUpdate('cascade');

            $table->tinyInteger('type')->default(\App\Enums\Fleet\VehicleType::Tracteur)->nullable();
            $table->tinyInteger('state')->default(\App\Enums\Fleet\FleetUsage::Transport)->nullable();
            $table->tinyInteger('usage')->default(\App\Enums\Fleet\VehicleType::Tracteur)->nullable();
            $table->string('registration');
            $table->string('chassis')->nullable();
            $table->string('code_vehicle')->nullable();
            $table->string('fuel')->nullable();
            $table->integer('power')->nullable();
            $table->integer('empty_weight')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('unit')->nullable();
            $table->integer('consumption')->nullable();
            $table->integer('number_places')->nullable();
            $table->integer('mileage')->nullable();
            $table->dateTime('commissioning_date')->nullable();
            $table->integer('acquisition_amount')->nullable();
            $table->boolean('has_driver')->default(false);
            $table->boolean('is_linked')->default(false);
            $table->tinyInteger('status')->default(\App\Enums\Fleet\VehicleStatus::Available);

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade');

            $table->string('created_by')->nullable();

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
        Schema::dropIfExists('vehicles');
    }
}
