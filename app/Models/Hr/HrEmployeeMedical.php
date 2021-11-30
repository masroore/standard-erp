<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrEmployeeMedical extends Model
{
    protected $fillable = [
        'employee_id', 'date','title_en','title_ar','image'
    ];
}
