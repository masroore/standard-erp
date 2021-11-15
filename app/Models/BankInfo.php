<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    protected $fillable = [
        'beneficiary_bank_name', 'beneficiary_bank_branch' , 'beneficiary_bank_address','beneficiary_bank_street','beneficiary_bank_city',
        'beneficiary_bank_code','intermediary_bank_name','beneficiary_name','beneficiary_address','beneficiary_street', 'beneficiary_city' , 
        'beneficiary_account_no','iban_code','customer_id','supplier_id','beneficiary_bank_swift_code',
        
    ];
} 
