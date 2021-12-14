<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttraddToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('longitude')->nullable()->after('address');
            $table->string('latitude')->nullable()->after('longitude');
            $table->string('tax_office')->nullable()->after('tax_id');
            $table->tinyInteger('is_tax_customer')->default(1)->comment('1=> tax customer , 2 => none tax customer')->after('tax_office');
            $table->tinyInteger('tax_exempt')->default(1)->comment('1=>  exempt , 2 => none  exempt')->after('is_tax_customer');
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
