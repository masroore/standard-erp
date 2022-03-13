<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_operations', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->date('start_at');
            $table->date('end_at')->nullable();
            $table->tinyInteger('is_created_pr')->default(0);
            $table->tinyInteger('is_created_po')->default(0);
            $table->tinyInteger('is_created_inv')->default(0);
            $table->tinyInteger('is_created_return')->default(0);
            $table->bigInteger('created_by')->unsigned();
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
        Schema::dropIfExists('buy_operations');
    }
}
