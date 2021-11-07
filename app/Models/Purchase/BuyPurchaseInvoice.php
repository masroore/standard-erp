<?php

namespace App\Models\Purchase;

use App\Models\Store\StoStore;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPurchaseInvoice extends Model
{ 
    use HasFactory;

    protected $fillable = ['reference_no','supplier_id','money_id','added_by','store_id','date','total_qty',
                            'order_tax_rate','order_tax','shipping_cost','total_cost','total_discount','total_tax',
                            'paid_amount','grand_total','status','is_paid','is_received','document','note'];

    // start relation

    /**
     * Get the user that owns the BuyPurchaseInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }


    /**
     * Get the supplier that owns the BuyPurchaseInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Get the store that owns the BuyPurchaseInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(StoStore::class, 'store_id');
    }



}
