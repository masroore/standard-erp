<?php

namespace App\Models\Finance;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class FinTransaction extends Model
{
    use HasFactory ,LogsActivity;

    protected $fillable = [ 'belong','type','paying_method','ref','code','notes','due_date','bank_id',
                            'amount','bank_transfare_fees','transfare_code','created_by','document_code',
                            'supplier_id','customer_id','purch_id','sale_id','check_receive_date'];

                             // activity log
    protected static $logAttributes           =[ 'belong','type','paying_method','ref','code','notes','due_date','bank_id',
    'amount','bank_transfare_fees','transfare_code','created_by','document_code',
    'supplier_id','customer_id','purch_id','sale_id','check_receive_date'];

    //protected static $ignoreChangedAttributes =  [''];
    protected static $logName                 =  'transaction';
    protected static $logOnlyDirty            =  true;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function bank()
    {
        return $this->belongsTo(FinBank::class, 'bank_id');
    }

}
