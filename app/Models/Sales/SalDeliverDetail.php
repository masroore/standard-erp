<?php

namespace App\Models\Sales;

use App\Models\Store\StoItem;
use App\Models\Store\StoUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalDeliverDetail extends Model

{
    use HasFactory;

    protected $fillable = ['deliver_id','item_id',
                    'unit_id','store_id','qunatity'];

    public function item()
    {
        return $this->belongsTo(StoItem::class,'item_id');
    }

    public function unit()
    {
        return $this->belongsTo(StoUnit::class, 'unit_id');
    }

}
