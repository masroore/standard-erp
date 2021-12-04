<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_purchase_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no', 100);
            $table->bigInteger('added_by');
            $table->bigInteger('requested_by')->nullable();
            $table->date('date');
            $table->integer('total_qty');
            $table->integer('item_counts');
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
        Schema::dropIfExists('buy_purchase_requisitions');
    }
}
