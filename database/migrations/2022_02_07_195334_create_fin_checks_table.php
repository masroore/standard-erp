<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_checks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bank_id')->nullable();
            $table->bigInteger('beneficiary')->nullable();
            $table->date('due_date');
            $table->string('check_number')->nullable();
            $table->double('amount');
            $table->enum('type', ['due', 'beneft'])->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('fin_checks');
    }
}
