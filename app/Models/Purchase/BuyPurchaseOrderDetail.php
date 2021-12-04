<?php

namespace App\Models\Purchase;

use App\Models\Store\StoItem;
use App\Models\Store\StoUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['po_id','item_id','purchase_unit_id','net_unit_cost','qunatity','unit_price','total'];

    public function po()
    {
        return $this->belongsTo(BuyPurchaseOrder::class, 'po_id');
    }

    public function item()
    {
        return $this->belongsTo(StoItem::class, 'item_id');
    }

    public function unit()
    {
        return $this->belongsTo(StoUnit::class, 'purchase_unit_id');
    }

}
