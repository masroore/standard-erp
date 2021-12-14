<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialattrToSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->double('opening_balance', 15, 3)->nullable()->default(0)->after('latitude');
            $table->string('website')->nullable()->after('opening_balance');
            $table->string('facbook')->nullable()->after('website');
            $table->string('linkedin')->nullable()->after('facbook');
            $table->string('twitter')->nullable()->after('linkedin');
            $table->string('location_on_map')->nullable()->after('twitter');
            $table->string('document')->nullable()->after('photo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            //
        });
    }
}
