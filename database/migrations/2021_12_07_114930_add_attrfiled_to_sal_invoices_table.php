<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrfiledToSalInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sal_invoices', function (Blueprint $table) {
            $table->tinyInteger('tax_type')->after('order_tax')->comment( "1 = for_both ; 2 = for_invoice ; 3 = for_items");
            $table->tinyInteger('invoice_payment_type')->after('tax_type')->comment( "1 = cash_payment ; 2 = fees_payment ; 3 = deferred_payment");
            $table->double('remaining_amount', 15, 3)->after('grand_total')->nullable()->default(0.00);
            $table->integer('items_count')->nullable()->after('total_qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sal_invoices', function (Blueprint $table) {
            //
        });
    }
}
