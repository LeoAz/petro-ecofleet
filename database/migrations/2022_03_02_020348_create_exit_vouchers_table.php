<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExitVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exit_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('code');
            $table->dateTime('date');

            $table->foreignId('maintenance_id')
                ->nullable()
                ->constrained('maintenances')
                ->onUpdate('cascade');

            $table->foreignId('repair_id')
                ->nullable()
                ->constrained('repairs')
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
        Schema::dropIfExists('exit_vouchers');
    }
}
