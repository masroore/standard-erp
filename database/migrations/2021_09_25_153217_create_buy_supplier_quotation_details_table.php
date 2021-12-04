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
        Schema::dropIfExists('buy_supplier_quotation_details');
    }
}
