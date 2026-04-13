<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trip_id')
                ->nullable()
                ->constrained('trips')
                ->onUpdate('cascade');

            $table->foreignId('sale_id')
                ->nullable()
                ->constrained('sales')
                ->onUpdate('cascade');

            $table->integer('unit_price')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('tax_amount')->nullable();
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
        Schema::dropIfExists('details');
    }
}
