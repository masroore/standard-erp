<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyOrderedSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_ordered_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no', 100);
            $table->bigInteger('supplier_id');
            $table->bigInteger('added_by');
            $table->date('date');
            $table->date('start_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->double('total_qty', 15, 3);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('buy_ordered_supplies');
    }
}
