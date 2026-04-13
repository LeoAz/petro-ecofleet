<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntranceVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrance_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('code');
            $table->dateTime('date');

            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->onUpdate('cascade');

            $table->foreignId('purchase_id')
                ->nullable()
                ->constrained('purchases')
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
        Schema::dropIfExists('entrance_vouchers');
    }
}
