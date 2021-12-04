<?php

namespace App\Models\Sales;

use App\Models\Store\StoItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalQuotationDetail extends Model
{
    use HasFactory;

    protected $fillable = ['sal_quotation_id','item_id','sale_unit_id','qunatity','unit_price',
                            'tax_rate','tax','discount','total'];

    /**
     * Get the items that owns the SalQuotationDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salQuotation()
    {
        return $this->belongsTo(SalQuotation::class, 'sal_quotation_id');
    }

    /**
     * Get the user that owns the SalQuotationDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function items()
    {
        return $this->belongsTo(StoItem::class, 'item_id');
    }


}//end of model
