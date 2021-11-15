<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $fillable = [
        'name', 'company_name' , 'is_active','photo','phone','fax','email','address','tax_id','tax_file_number','parent_id','group_id'
    ];
}
