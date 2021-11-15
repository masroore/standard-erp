<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sto_items', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 100)->nullable();
            $table->string('title_en', 100)->nullable();
            $table->string('barcode')->nullable();
            $table->string('photo')->nullable();
            $table->double('sale_price', 15, 3);
            $table->integer('alert_quantity')->default(10);
            $table->bigInteger('cat_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
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
        Schema::dropIfExists('sto_items');
    }
}
