<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoItemCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sto_item_collections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('belongs_product')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->double('price', 15, 3)->nullable();
            $table->integer('qty')->nullable();
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
        Schema::dropIfExists('sto_item_collections');
    }
}
