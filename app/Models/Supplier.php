<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'contact_person', 'company_name' , 'is_active','photo','phone','fax','email','address','tax_id','tax_file_number'
    ];
}
