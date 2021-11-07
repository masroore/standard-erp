<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cat_id');
            $table->string('title_ar', 100)->nullable();
            $table->string('title_en', 100)->nullable();
            $table->double('start_amount', 15, 3)->default(0);
            $table->bigInteger('parent_id')->nullable()->default(0);
            $table->tinyInteger('level');
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
        Schema::dropIfExists('fin_accounts');
    }
}
