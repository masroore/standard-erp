<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttsrToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->string('id_for_orginaztion')->nullable();
            $table->string('mobile')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            $table->string('cr_id')->nullable();
            $table->foreign('account_id')->references('id')->on('fin_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
