<?php

namespace App\Models\Purchase;

use App\Models\Store\StoItem;
use App\Models\Store\StoUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPurchaseRequisitionItem extends Model
{
    use HasFactory;

    protected $fillable = ['request_id','item_id','purchase_unit_id','description','qunatity'];

    public function byuRequest()
    {
        return $this->belongsTo(BuyPurchaseRequisition::class, 'request_id');
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
