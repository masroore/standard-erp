<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'contact_person', 'company_name' , 'is_active','photo','phone',
        'fax','email','address','tax_id','tax_file_number','account_id',
        'city','country_code','mobile','cr_id','id_for_orginaztion',
    ];
}
