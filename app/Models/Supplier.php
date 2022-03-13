<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'contact_person', 'company_name' , 'is_active','photo','phone','longitude','latitude','tax_office','location_on_map',
        'fax','email','address','tax_id','tax_file_number','account_id','is_tax_supplier','tax_exempt','twitter','document',
        'city','country_code','mobile','cr_id','id_for_orginaztion','website','opening_balance','facbook','linkedin'
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_code','country_code');
    }
}
