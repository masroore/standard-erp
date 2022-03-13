<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrsToBuyPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_purchase_orders', function (Blueprint $table) {
            //
           
            $table->double('shipping_cost', 15, 3)->nullable()->after('total_cost');
            $table->integer('items_count')->nullable()->after('total_qty');
            $table->integer('tax_rate')->nullable()->after('shipping_cost');
            $table->double('tax_amount', 15, 3)->nullable()->after('tax_rate');
            $table->double('total_discount', 15, 3)->nullable()->after('tax_amount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_purchase_orders', function (Blueprint $table) {
            //
        });
    }
}
