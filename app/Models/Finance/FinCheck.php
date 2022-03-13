<?php

namespace App\Models\Finance;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinCheck extends Model
{
    use HasFactory;

    protected $fillable = ['bank_id','beneficiary','due_date','notes','release_date',
    'check_number','amount','type','transaction_id','belong_to','status'];

    public function bank()
    {
        return $this->belongsTo(FinBank::class, 'bank_id');
    }

    public function transaction()
    {
        return $this->belongsTo(FinTransaction::class, 'transaction_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'beneficiary');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'beneficiary');
    }


}
