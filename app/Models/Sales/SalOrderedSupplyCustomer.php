<?php

namespace App\Models\Sales;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalOrderedSupplyCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no','customer_id','added_by','date','shipping_cost',
    'total_qty','items_count','grand_total','status','document','note','delivery_date'
    ,'items_count','tax_rate','tax_amount','total_discount','opration_id'];


        public function user()
        {
        return $this->belongsTo(User::class, 'added_by');
        }

        public function items(){
        return $this->hasMany(SalOrderedSupplyCustomerDetail::class, 'cust_order_suppliy_id');
        }

        public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
        }

}
