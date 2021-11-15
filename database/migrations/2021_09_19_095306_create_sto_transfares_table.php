<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoTransfaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sto_transfares', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('from_store');
            $table->bigInteger('to_store');
            $table->bigInteger('item_id');
            $table->integer('quantity');
            $table->bigInteger('added_by');

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
        Schema::dropIfExists('sto_transfares');
    }
}
