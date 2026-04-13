<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreignId('trailer_id')
                ->nullable()
                ->constrained('trailers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->dateTime('link_date')->nullable();
            $table->dateTime('unlink_date')->nullable();
            $table->tinyInteger('status')->default(\App\Enums\Fleet\LinkStatus::Active);

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
        Schema::dropIfExists('links');
    }
}
