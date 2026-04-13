<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trailers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->onUpdate('cascade');

            $table->foreignId('pattern_id')
                ->nullable()
                ->constrained('patterns')
                ->onUpdate('cascade');

            $table->tinyInteger('state')->default(\App\Enums\Fleet\FleetState::Neuf);
            $table->tinyInteger('usage')->default(\App\Enums\Fleet\FleetUsage::Transport);
            $table->tinyInteger('type')->default(\App\Enums\Fleet\TrailerType::Citerne);
            $table->string('registration')->unique();
            $table->string('code_trailer')->unique();
            $table->unsignedTinyInteger('axels')->nullable();
            $table->integer('empty_weight')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('unit')->nullable();
            $table->integer('acquisition_amount')->nullable();
            $table->dateTime('commissioning_date')->nullable();
            $table->tinyInteger('status')->default(\App\Enums\Fleet\TrailerStatus::Available);
            $table->boolean('is_linked')->default(false);

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
        Schema::dropIfExists('trailers');
    }
}
