<?php

namespace App\Models\Purchase;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPurchaseRequisition extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no','requested_by','added_by','date','total_qty','item_counts','status','document','note'];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function items(){
        return $this->hasMany(BuyPurchaseRequisitionItem::class, 'request_id');
    }


    public function supplierQuotation(){
        return $this->hasMany(BuySupplierQuotation::class, 'purchase_request_id');
    }


}
