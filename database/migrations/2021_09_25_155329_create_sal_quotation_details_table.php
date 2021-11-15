<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalQuotationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_quotation_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sal_quotation_id');
            $table->bigInteger('item_id');
            $table->bigInteger('sale_unit_id')->nullable();
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
        Schema::dropIfExists('sal_quotation_details');
    }
}
