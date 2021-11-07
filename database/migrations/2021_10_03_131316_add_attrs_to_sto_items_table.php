<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrsToStoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sto_items', function (Blueprint $table) {
            $table->string('barcode_symbology')->nullable();
            $table->tinyInteger('is_batch')->default(0);
            $table->tinyInteger('is_variant')->default(0);
            
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
