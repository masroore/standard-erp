<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sto_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_code', 100);
            $table->string('unit_name', 100);
            $table->integer('base_unit')->default(0);
            $table->string('operator', 100);
            $table->double('operation_value', 15, 3);
            $table->tinyInteger('is_active');
            
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
        Schema::dropIfExists('sto_units');
    }
}
