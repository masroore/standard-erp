<?php

namespace App\Models\Purchase;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuySupplierQuotation extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_request_id','supplier_id','added_by','date','total_qty','item_counts','status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function purchRequest(){
        return $this->belongsTo(BuyPurchaseRequisition::class, 'purchase_request_id');
    }

    public function items(){
        return $this->hasMany(BuySupplierQuotationDetail::class, 'buy_quotation_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

}
