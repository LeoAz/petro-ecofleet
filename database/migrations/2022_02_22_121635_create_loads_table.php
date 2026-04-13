<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('code');
            $table->string('num_bordereau');
            $table->dateTime('date');
            $table->integer('load_qty');
            $table->string('unit');

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->onUpdate('cascade');

            $table->foreignId('trip_id')
                ->nullable()
                ->constrained('trips')
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
        Schema::dropIfExists('loads');
    }
}
