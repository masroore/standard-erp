<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'mobile' , 'department','photo','phone','linkedin','email',
        'address','twitter','position','whatsapp','facebook','customer_id',
        'supplier_id','is_our_company'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

}
