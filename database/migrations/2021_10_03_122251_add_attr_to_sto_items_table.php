<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrToStoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sto_items', function (Blueprint $table) {
            $table->bigInteger('branch_id')->default(1);
            $table->string('code');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('tax_id')->nullable();
            $table->integer('tax_method')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
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
