<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinJournalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_journal_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('journal_id');
            $table->bigInteger('account_id');
            $table->double('debit', 15, 3)->nullable();
            $table->double('credit', 15, 3)->nullable();
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
        Schema::dropIfExists('fin_journal_details');
    }
}
