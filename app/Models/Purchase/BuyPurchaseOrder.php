<?php

namespace App\Models\Purchase;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no','supplier_id','added_by','date','shipping_cost',
                'total_qty','items_count','grand_total','status','document','note','delivery_date'
                ,'items_count','tax_rate','tax_amount','total_discount','opration_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function items(){
        return $this->hasMany(BuyPurchaseOrderDetail::class, 'po_id');
    }


    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

}
