<?php

namespace App\Models\Hr\Payroll;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class HrSalaryEmployee extends Model
{
    protected $fillable = [
        'generate_id','employee_id', 'total_salary', 'working_hour', 'working_day', 'pay_type','paid_by','date',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'paid_by', 'id');
    }
}
