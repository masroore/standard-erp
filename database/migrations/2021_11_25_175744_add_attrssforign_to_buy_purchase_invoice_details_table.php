<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrssforignToBuyPurchaseInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_purchase_invoice_details', function (Blueprint $table) {
            $table->tinyInteger('discount_type')->nullable()->after('discount');
            $table->foreign('buy_invoice_id')->references('id')->on('buy_purchase_invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_purchase_invoice_details', function (Blueprint $table) {
            //
        });
    }
}
