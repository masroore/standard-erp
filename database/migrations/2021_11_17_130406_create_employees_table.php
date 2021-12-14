<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();;
            $table->string('phone');
            $table->string('address');
            $table->string('photo');
            $table->date('birthday');
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_joining');
            $table->integer('department_id');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('employees');
    }
}
