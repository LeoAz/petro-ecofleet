<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->dateTime('date');
            $table->string('code');
            $table->text('description')->nullable();

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->onUpdate('cascade');

            $table->foreignId('motif_id')
                ->nullable()
                ->constrained('motifs')
                ->onUpdate('cascade');

            $table->integer('amount');
            $table->unsignedInteger('status')->default(\App\Enums\Maintenance\RepairStatus::Pending);
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
        Schema::dropIfExists('repairs');
    }
}
