<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->tinyInteger('op_type');
            $table->dateTime('paid_at')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('driver')->nullable();
            $table->string('type_expense')->nullable();
            $table->string('motif')->nullable();
            $table->integer('amount')->nullable();
            $table->string('beneficiary')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('box_id')
                ->nullable()
                ->constrained('cashboxes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('operations');
    }
}
