<?php

namespace App\Models\Purchase;

use App\Models\Store\StoItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPurchaseInvoiceDetail extends Model
{

    use HasFactory;

    protected $fillable = ['buy_invoice_id','item_id','store_id','purchase_unit_id','net_unit_cost','qunatity','unit_price',
                            'tax_rate','tax','discount','total','discount_type',];

    /**
     * Get the invoice that owns the BuyPurchaseInvoiceDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function byuInvoice()
    {
        return $this->belongsTo(BuyPurchaseInvoice::class, 'buy_invoice_id');
    }

    public function item()
    {
        return $this->belongsTo(StoItem::class, 'item_id');
    }

}
