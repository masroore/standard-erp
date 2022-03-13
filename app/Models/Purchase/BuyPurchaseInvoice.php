<?php

namespace App\Models\Purchase;

use App\Models\Store\StoStore;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPurchaseInvoice extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no','supplier_id','money_id','added_by','store_id','date','total_qty','remaining_amount','opration_id',
                            'order_tax_rate','order_tax','shipping_cost','total_discount','total_tax','tax_type','items_count',
                           'paid_amount','grand_total','status','is_paid','is_received','document','note','invoice_payment_type'];

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

    public function items(){
        return $this->hasMany(BuyPurchaseInvoiceDetail::class, 'buy_invoice_id');
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
