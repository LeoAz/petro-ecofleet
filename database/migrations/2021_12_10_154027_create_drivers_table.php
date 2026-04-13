<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name');
            $table->string('matricule')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('driver_licence')->nullable();
            $table->string('licence_category')->nullable();
            $table->dateTime('exp_date')->nullable();
            $table->string('tel')->nullable();
            $table->integer('salary')->default(0);
            $table->text('observation')->nullable();
            $table->tinyInteger('status')->default(\App\Enums\Fleet\DriverStatus::Unassign);

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
        Schema::dropIfExists('drivers');
    }
}
