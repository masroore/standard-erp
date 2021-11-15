<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrToSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('phone');
            $table->string('cr_id')->nullable()->after('tax_id');
            $table->string('country_code')->nullable()->after('address');
            $table->string('city')->nullable()->after('country_code');
            $table->string('id_for_orginaztion')->nullable()->after('tax_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            //
        });
    }
}
