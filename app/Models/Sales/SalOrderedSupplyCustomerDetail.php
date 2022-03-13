<?php

namespace App\Models\Sales;

use App\Models\Store\StoItem;
use App\Models\Store\StoUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalOrderedSupplyCustomerDetail extends Model
{
    use HasFactory;
    protected $fillable = ['cust_order_suppliy_id','item_id','unit_id','unit_price','qunatity','total','tax_rate','tax_amount','discount'];

    public function osCustomer()
    {
        return $this->belongsTo(SalOrderedSupplyCustomer::class, 'cust_order_suppliy_id');
    }

    public function item()
    {
        return $this->belongsTo(StoItem::class, 'item_id');
    }

    public function unit()
    {
        return $this->belongsTo(StoUnit::class, 'unit_id');
    }
}
