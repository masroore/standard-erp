<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerServiceInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_service_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ser_invoice_id');
            $table->bigInteger('service_id');
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
        Schema::dropIfExists('ser_service_invoice_details');
    }
}
