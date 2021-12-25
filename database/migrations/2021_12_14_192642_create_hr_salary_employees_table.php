<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrSalaryEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_salary_employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('generate_id')->unsigned();
            $table->bigInteger('employee_id')->unsigned();
            $table->double('total_salary');
            $table->double('working_hour')->nullable();
            $table->double('working_day')->nullable();
            $table->date('date')->nullable();
            $table->enum('pay_type',[1,2])->default(1)->comment('1 => Cash Payment , 2 => Bank Payment');
            $table->bigInteger('paid_by')->nullable()->unsigned();

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
        Schema::dropIfExists('hr_salary_employees');
    }
}
