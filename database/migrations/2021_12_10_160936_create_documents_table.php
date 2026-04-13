<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('label');
            $table->string('type');
            $table->integer('amount')->nullable();
            $table->dateTime('delivery_date');
            $table->dateTime('exp_date');
            $table->string('provider');

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->onUpdate('cascade');

            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('drivers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('status')->default(\App\Enums\Fleet\DocumentStatus::Active);

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
        Schema::dropIfExists('documents');
    }
}
