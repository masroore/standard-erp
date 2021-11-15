<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
             $table->string('subject');
            $table->string('status');
            $table->string('priority');
            $table->dateTime('start_at');
            $table->text('description');
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->tinyInteger('is_moved')->default(0)->comment('0 => not moved , 1 => moved');
            $table->tinyInteger('move_type')->default(0)->comment('0 => not moved , 1 => internal , 2 => external');
            $table->text('move_description');
            $table->bigInteger('closed_by')->unsigned()->nullable();
            $table->dateTime('closed_at');
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
        Schema::dropIfExists('tickets');
    }
}
