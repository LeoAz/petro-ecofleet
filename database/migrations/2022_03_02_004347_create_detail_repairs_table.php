<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_repairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('part_id')
                ->nullable()
                ->constrained('parts')
                ->onUpdate('cascade');

            $table->foreignId('repair_id')
                ->nullable()
                ->constrained('repairs')
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
        Schema::dropIfExists('detail_repairs');
    }
}
