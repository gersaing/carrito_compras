<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->integer('ITEM_ID')->primary();
            $table->integer('PRO_ID');
            $table->integer('VEN_ID')->nullable();
            
            $table->foreign('VEN_ID', 'FK_AGREGA')->references('VEN_ID')->on('venta');
            $table->foreign('PRO_ID', 'FK_TIENE')->references('PRO_ID')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item');
    }
}
