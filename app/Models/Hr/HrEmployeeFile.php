<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrEmployeeFile extends Model
{
    protected $fillable = [
        'employee_id','title_en','title_ar','file'
    ];
}
