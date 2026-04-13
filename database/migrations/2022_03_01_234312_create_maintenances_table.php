<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('code');
            $table->dateTime('date');
            $table->integer('mileage');
            $table->integer('next_mileage')->nullable();
            $table->dateTime('next_date')->nullable();
            $table->text('description');
            $table->integer('amount');
            $table->integer('total_amount')->default(0);
            $table->integer('treshold');
            $table->string('unit');

            $table->foreignId('garage_id')
                ->nullable()
                ->constrained('garages')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('maintenances');
    }
}
