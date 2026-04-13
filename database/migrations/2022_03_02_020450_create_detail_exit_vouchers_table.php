<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailExitVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_exit_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exit_id')
                ->nullable()
                ->constrained('exit_vouchers')
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
        Schema::dropIfExists('detail_exit_vouchers');
    }
}
