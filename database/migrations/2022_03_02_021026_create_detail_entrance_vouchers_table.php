<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailEntranceVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_entrance_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrance_id')
                ->nullable()
                ->constrained('entrance_vouchers')
                ->onUpdate('cascade');

            $table->foreignId('part_id')
                ->nullable()
                ->constrained('parts')
                ->onUpdate('cascade');

            $table->integer('qty');
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
        Schema::dropIfExists('detail_entrance_vouchers');
    }
}
