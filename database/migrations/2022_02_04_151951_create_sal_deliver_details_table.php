<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalDeliverDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_deliver_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('deliver_id');
            $table->bigInteger('item_id');
            $table->bigInteger('unit_id')->nullable();
            $table->integer('qunatity');
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
        Schema::dropIfExists('sal_deliver_details');
    }
}
