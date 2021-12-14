<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttraddToSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('longitude')->nullable()->after('address');
            $table->string('latitude')->nullable()->after('longitude');
            $table->string('tax_office')->nullable()->after('tax_id');
            $table->tinyInteger('is_tax_supplier')->default(1)->comment('1=> tax supplier , 2 => none tax supplier')->after('tax_office');
            $table->tinyInteger('tax_exempt')->default(1)->comment('1=>  exempt , 2 => none  exempt')->after('is_tax_supplier');
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
