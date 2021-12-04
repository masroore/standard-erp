<?php

namespace App\Models\Sales;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalQuotation extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no','customer_id','start_date','added_by','expired_date','total_qty',
    'order_tax_rate','order_tax','shipping_cost','total_cost','total_discount','total_tax',
    'grand_total','status','document','note'];

    /**
     * Get all of the comments for the SalQuotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotationItem()
    {
        return $this->hasMany(SalQuotationDetail::class, 'sal_quotation_id');
    }

    /**
     * Get the user that owns the SalQuotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
