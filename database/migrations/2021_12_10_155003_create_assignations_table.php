<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('drivers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->dateTime('date_attribution')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->string('status')->default(\App\Enums\Fleet\AssignationStatus::Active);

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade');


            $table->string('created_by')->nullable();

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
        Schema::dropIfExists('assignations');
    }
}
