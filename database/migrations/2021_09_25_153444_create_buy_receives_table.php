<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_receives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_invoice_id');
            $table->string('reference_no', 100);
            $table->bigInteger('added_by');
            $table->bigInteger('store_id');
            $table->date('date');
            $table->double('total_qty', 15, 3);
            $table->double('order_tax_rate', 15, 3);
            $table->double('order_tax', 15, 3);
            $table->double('shipping_cost', 15, 3);
            $table->double('total_cost', 15, 3);
            $table->double('total_discount', 15, 3)->default(0);
            $table->double('total_tax', 15, 3)->default(0);
            $table->double('paid_amount', 15, 3)->default(0);
            $table->double('grand_total', 15, 3);
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
        Schema::dropIfExists('buy_receives');
    }
}
