<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('inventory_id')
                ->nullable()
                ->constrained('inventories')
                ->onDelete('cascade');

            $table->foreignId('part_id')
                ->nullable()
                ->constrained('parts')
                ->onDelete('cascade');

            $table->tinyInteger('theoriq_qty');
            $table->tinyInteger('real_qty');
            $table->tinyInteger('ecart');

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
        Schema::dropIfExists('detail_inventories');
    }
}
