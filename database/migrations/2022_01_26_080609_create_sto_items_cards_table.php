<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoItemsCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sto_item_cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purch_id')->nullable();
            $table->bigInteger('sale_id')->nullable();
            $table->bigInteger('receive_id')->nullable();
            $table->bigInteger('delivery_id')->nullable();
            $table->bigInteger('store_id')->nullable();
            $table->bigInteger('item_id')->nullable()->after('type');
            $table->enum('type', ['purch', 'sale','receive','delivery'])->nullable();
            $table->integer('quantity_in')->unsigned()->nullable();
            $table->double('price_in')->unsigned()->nullable();
            $table->double('value_in')->unsigned()->nullable();
            $table->integer('quantity_out')->unsigned()->nullable();
            $table->double('price_out')->unsigned()->nullable();
            $table->double('value_out')->unsigned()->nullable();
            $table->integer('quantity_balance')->unsigned()->nullable();
            $table->double('price_balance')->unsigned()->nullable();
            $table->double('value_balance')->unsigned()->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('sto_item_cards');
    }
}
