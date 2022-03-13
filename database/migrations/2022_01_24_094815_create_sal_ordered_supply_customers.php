<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalOrderedSupplyCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_ordered_supply_customers', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no', 100);
            $table->bigInteger('customer_id');
            $table->bigInteger('added_by');
            $table->date('date');
            $table->double('total_qty', 15, 3);
            $table->double('grand_total', 15, 3);
            $table->tinyInteger('status');
            $table->date('delivery_date')->nullable();
            $table->double('shipping_cost', 15, 3)->nullable();
            $table->integer('items_count')->nullable();
            $table->integer('tax_rate')->nullable();
            $table->double('tax_amount', 7, 3)->nullable();
            $table->double('total_discount', 10, 3)->nullable();
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
        Schema::dropIfExists('sal_ordered_supply_customers');
    }
}
