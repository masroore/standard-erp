<?php

namespace App\Models\Sales;

use App\Models\Store\StoItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = ['sal_invoice_id','item_id','store_id','sale_unit_id','unit_price','qunatity',
                            'tax_rate','tax','discount','total','discount_type'];

    /**
    * Get the invoice that owns the BuyPurchaseInvoiceDetail
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function saleInvoice()
    {
    return $this->belongsTo(SalInvoice::class, 'sal_invoice_id');
    }

    public function item()
    {
    return $this->belongsTo(StoItem::class, 'item_id');
    }
}// end of model
