<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitToStoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sto_items', function (Blueprint $table) {
            $table->bigInteger('purchase_unit_id')->nullable()->unsigned()->after('branch_id');
            $table->bigInteger('sale_unit_id')->nullable()->unsigned()->after('branch_id');
            $table->bigInteger('unit_id')->nullable()->unsigned()->after('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sto_items', function (Blueprint $table) {
            //
        });
    }
}
