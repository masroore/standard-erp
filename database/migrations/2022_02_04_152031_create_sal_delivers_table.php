<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalDeliversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_delivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sal_opretation_id')->nullable();
            $table->bigInteger('sal_invoiiice_id')->nullable();
            $table->bigInteger('added_by')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('store_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->date('date')->nullable();
            $table->integer('items_count')->unsigned()->nullable();
            $table->integer('total_qty')->unsigned()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('document')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('sal_delivers');
    }
}
