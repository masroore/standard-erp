<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_infos', function (Blueprint $table) {
            $table->id();

            $table->string('beneficiary_name');
            $table->string('beneficiary_address');
            $table->string('beneficiary_street');
            $table->string('beneficiary_account_no');
            $table->string('beneficiary_city');

            $table->string('beneficiary_bank_name');
            $table->string('beneficiary_bank_swift_code');
            $table->string('beneficiary_bank_branch');
            $table->string('beneficiary_bank_city');
            $table->string('intermediary_bank_name')->nullable();
            $table->string('beneficiary_bank_code');
            $table->string('iban_code');
            $table->string('beneficiary_bank_address');
            $table->string('beneficiary_bank_street');
            $table->bigInteger('customer_id')->nullable()->unsigned();;
            $table->bigInteger('supplier_id')->nullable()->unsigned();;

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
        Schema::dropIfExists('bankinfos');
    }
}
