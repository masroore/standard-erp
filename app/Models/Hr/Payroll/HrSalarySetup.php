<?php

namespace App\Models\Hr\Payroll;

use Illuminate\Database\Eloquent\Model;

class HrSalarySetup extends Model
{
    protected $fillable = [
        'employee_id', 'addition','deduction', 'gross_salary',
    ];
}
