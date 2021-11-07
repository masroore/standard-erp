<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuySupplierQuotationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_supplier_quotation_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buy_quotation_id');
            $table->bigInteger('item_id');
            $table->bigInteger('purchase_unit_id')->nullable();
            $table->double('net_unit_cost', 15, 3)->nullable();
            $table->integer('qunatity');
            $table->double('unit_price', 15, 3);
            $table->double('tax_rate', 15, 3);
            $table->double('tax', 15, 3);
            $table->double('discount', 15, 3);
            $table->double('total', 15, 3);
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
        Schema::dropIfExists('buy_supplier_quotation_details');
    }
}