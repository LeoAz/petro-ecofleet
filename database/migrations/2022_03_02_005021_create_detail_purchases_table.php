<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')
                ->nullable()
                ->constrained('purchases')
                ->onUpdate('cascade');

            $table->foreignId('part_id')
                ->nullable()
                ->constrained('parts')
                ->onUpdate('cascade');

            $table->integer('qty');
            $table->integer('unit_price');
            $table->integer('amount');

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
        Schema::dropIfExists('detail_purchases');
    }
}
