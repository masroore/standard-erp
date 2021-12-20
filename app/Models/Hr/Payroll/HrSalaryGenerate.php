<?php

namespace App\Models\Hr\Payroll;

use Illuminate\Database\Eloquent\Model;

class HrSalaryGenerate extends Model
{
    protected $fillable = [
        'salary_name','date','user_id'
    ];
}
