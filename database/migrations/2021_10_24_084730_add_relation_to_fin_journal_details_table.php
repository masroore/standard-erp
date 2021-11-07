<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToFinJournalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fin_journal_details', function (Blueprint $table) {
            $table->foreign('journal_id')->references('id')->on('fin_journals')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('fin_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fin_journal_details', function (Blueprint $table) {
            //
        });
    }
}
