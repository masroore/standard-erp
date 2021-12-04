<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $fillable = [
        'name','company_name','is_active','photo','phone','fax','email',
        'tax_id','tax_file_number','parent_id','group_id','account_id','cr_id',
        'mobile','country_code','city','id_for_orginaztion','address'
    ];
}
