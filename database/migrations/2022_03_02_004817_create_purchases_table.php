<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->dateTime('date');
            $table->string('code');

            $table->foreignId('provider_id')
                ->nullable()
                ->constrained('providers')
                ->onUpdate('cascade');

            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->onUpdate('cascade');

            $table->unsignedInteger('status');

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
        Schema::dropIfExists('purchases');
    }
}
