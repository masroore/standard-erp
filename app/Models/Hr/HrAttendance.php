<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAttendance extends Model
{
    protected $fillable = [
        'employee_id', 'date','check_in','check_out','note','created_by','status'
    ];
}
