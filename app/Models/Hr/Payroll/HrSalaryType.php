<?php

namespace App\Models\Hr\Payroll;

use Illuminate\Database\Eloquent\Model;

class HrSalaryType extends Model
{
    protected $fillable = [
        'benefits', 'type'
    ];
}
