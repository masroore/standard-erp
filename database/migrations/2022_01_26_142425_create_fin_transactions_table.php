<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('belong', ['supplier', 'customer','employee'])->nullable();
            $table->enum('type', ['credit', 'debit'])->nullable();
            $table->enum('paying_method', ['check', 'cash','transfare'])->nullable();
            $table->string('ref')->nullable();
            $table->integer('code')->nullable();
            $table->double('amount');
            $table->float('bank_transfare_fees')->default(0);
            $table->string('transfare_code')->nullable();
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('purch_id')->nullable();
            $table->bigInteger('sale_id')->nullable();
            $table->text('notes');
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
        Schema::dropIfExists('fin_transactions');
    }
}
