<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerServiceInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_service_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no', 100);
            $table->bigInteger('customer_id');
            $table->bigInteger('money_id');
            $table->bigInteger('added_by');
            $table->date('date');
            $table->double('paid_amount', 15, 3)->default(0);
            $table->double('grand_total', 15, 3);
            $table->tinyInteger('status');
            $table->tinyInteger('is_paid');
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
        Schema::dropIfExists('ser_service_invoices');
    }
}
