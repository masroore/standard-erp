<?php

namespace App\Models\Sales;

use App\Models\Customer;
use App\Models\Store\StoStore;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class SalInvoice extends Model
{
    use HasFactory ,LogsActivity ;

    protected $fillable = ['reference_no','customer_id','money_id','added_by','store_id','date','total_qty','remaining_amount',
                        'order_tax_rate','order_tax','shipping_cost','total_discount','total_tax','tax_type','items_count',
                        'paid_amount','grand_total','status','is_paid','is_received','document','note','invoice_payment_type',
                        'total_cost'];


                         // activity log
    protected static $logAttributes           = ['reference_no','customer_id','money_id','added_by','store_id','date','total_qty','remaining_amount',
    'order_tax_rate','order_tax','shipping_cost','total_discount','total_tax','tax_type','items_count',
    'paid_amount','grand_total','status','is_paid','is_received','document','note','invoice_payment_type',
    'total_cost'];
    //protected static $ignoreChangedAttributes =  [''];
    protected static $logName                 =  'SalesInvoice';
    protected static $logOnlyDirty            =  true;

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
    return $this->hasMany(SalInvoiceDetail::class, 'sal_invoice_id');
    }


    /**
    * Get the supplier that owns the BuyPurchaseInvoice
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function customer()
    {
    return $this->belongsTo(Customer::class, 'customer_id');
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

}// end of model
