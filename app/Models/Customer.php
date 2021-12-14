<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $fillable = [
        'name','company_name','is_active','photo','phone','fax','email','longitude','latitude','website','twitter','facbook',
        'tax_id','tax_file_number','parent_id','group_id','account_id','cr_id','tax_office','location_on_map','linkedin',
        'mobile','country_code','city','id_for_orginaztion','address','is_tax_customer','tax_exempt','document','opening_balance'
    ];
}
