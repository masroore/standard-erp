<?php

namespace App\Models\Purchase;

use App\Models\Store\StoStore;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyReceive extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no','store_id','added_by','purchase_invoice_id','opration_id',
                            'date','total_qty', 'status','document','note','items_count','supplier_id'];


    // start relation
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function items(){
        return $this->hasMany(BuyReceiveDetail::class, 'receive_id');
    }

    public function store(){
        return $this->belongsTo(StoStore::class, 'store_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    //end relation
}// end of model
