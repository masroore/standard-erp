<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrsToBuySupplierQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_supplier_quotations', function (Blueprint $table) {
            $table->bigInteger('purchase_request_id')->nullable()->unsigned()->after('id');
            $table->integer('item_counts')->unsigned()->nullable()->after('total_qty');
            $table->date('date')->after('item_counts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_supplier_quotations', function (Blueprint $table) {
            //
        });
    }
}
