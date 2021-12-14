<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoItemStorePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sto_item_store_places', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->nullable()->unsigned();
            $table->bigInteger('store_id')->nullable()->unsigned();
            $table->string('place');
            $table->foreign('item_id')->references('id')->on('sto_items')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('sto_stores')->onDelete('cascade');
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
        Schema::dropIfExists('sto_item_store_places');
    }
}
