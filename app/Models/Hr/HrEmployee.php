<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrEmployee extends Model
{
    protected $fillable = [
        'name', 'email','email','phone','address','photo','birthday','gender',
        'date_of_joining', 'department_id','status','user_id'
    ];
}
