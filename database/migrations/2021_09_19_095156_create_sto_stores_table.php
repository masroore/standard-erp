<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sto_stores', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 100)->nullable();
            $table->string('title_en', 100)->nullable();
            $table->bigInteger('user_id')->nullable()->comment('Storekeeper');
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
        Schema::dropIfExists('sto_stores');
    }
}
