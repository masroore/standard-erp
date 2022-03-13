<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalOrderedSupplyCustomerDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_ordered_supply_customer_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cust_order_suppliy_id');
            $table->bigInteger('item_id');
            $table->bigInteger('unit_id')->nullable();
            $table->integer('qunatity');
            $table->double('unit_price', 15, 3);
            $table->integer('tax_rate')->nullable();
            $table->double('tax_amount', 7, 3)->nullable();
            $table->double('discount', 10, 3)->nullable();
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
        Schema::dropIfExists('sal_ordered_supply_customer_details');
    }
}
