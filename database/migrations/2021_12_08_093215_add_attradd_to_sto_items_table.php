<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttraddToStoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sto_items', function (Blueprint $table) {
            $table->enum('item_type',['standard', 'service','collection'])->after('barcode');
            $table->string('made_in')->nullable()->after('code');
            $table->string('weight')->nullable()->after('made_in');
            $table->string('height')->nullable()->after('weight');
            $table->string('width')->nullable()->after('height');
            $table->string('lenght')->nullable()->after('width');
            $table->string('discount_group')->nullable()->after('lenght');
            $table->string('qty_list')->nullable()->after('sale_price');
            $table->string('price_list')->nullable()->after('qty_list');
            $table->string('product_list')->nullable()->after('price_list');
            $table->tinyInteger('is_active')->default(1)->after('is_variant');
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
