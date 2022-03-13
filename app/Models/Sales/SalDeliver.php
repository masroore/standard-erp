<?php

namespace App\Models\Sales;

use App\Models\Customer;
use App\Models\Store\StoStore;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalDeliver extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no','store_id','added_by','sal_invoice_id','sal_opretation_id',
                            'date','total_qty', 'status','document','note','items_count','customer_id'];


    // start relation
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function items(){
        return $this->hasMany(SalDeliverDetail::class, 'deliver_id');
    }

    public function store(){
        return $this->belongsTo(StoStore::class, 'store_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    //end relation
}// end of model
