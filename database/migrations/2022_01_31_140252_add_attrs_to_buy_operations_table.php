<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrsToBuyOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_operations', function (Blueprint $table) {
            $table->tinyInteger('is_created_cust_po')->default(0)->after('is_created_inv');
            $table->tinyInteger('is_created_receive')->default(0)->after('is_created_inv');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_operations', function (Blueprint $table) {
            //
        });
    }
}
